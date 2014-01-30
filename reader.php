<?php 

  //CONFIGURATION

  $imgTypes           = array('jpeg', 'jpg', 'png', 'gif'); // The extensions of Images that the plugin will read
  $imagesOrder        = $_GET['imagesOrder']; //byDate, byDateReverse, byName, byNameReverse, random
  $folderCoverRandom  = $_GET['folderCoverRandom'];

  function getList ($directory) {
    global $imgTypes;
    global $imagesOrder;

    if( !is_dir($directory)){
      return array();
    }

    $results = array();

    $handler = opendir($directory);

    while ($file = readdir($handler)) {
      if ($file != "." && $file != ".." && $file != ".DS_Store" && $file != "@eaDir") {
         $extension = preg_split('/\./',$file);
         $extension = strtolower($extension[count($extension)-1]);
         
         if( (array_search($extension,$imgTypes) !== FALSE || is_dir($directory.'/'.$file)) && $file != "thumbnails" ){
            $ctime = filemtime($directory .'/'. $file) . ',' . $file; //BRING THE DATE OF THE IMAGE
            if($imagesOrder == 'byName' || $imagesOrder == 'byNameReverse'){
                $ctime = $file;
            }
            $results[$ctime] = $file;
         }   
            
      }
    }

    closedir($handler);
    if($imagesOrder == 'byDate' || $imagesOrder == 'byNameReverse'){
        krsort($results);
    }else if($imagesOrder == 'byDateReverse' || $imagesOrder == 'byName'){
        ksort($results);
    }else if($imagesOrder == 'random'){
        shuffle($results);
    }
    return $results;

  }

  function fixArray($list, $directory){
      global $folderCoverRandom;

      $return = array();

      foreach ($list as $key => $value) {
            $val = "";

            if( is_dir($directory.'/'.$value) ){
                $val = "folder";

                $arr = getList($directory.'/'.$value); 
                $folderImg      = "";
                $folderImgCover = "";
                $thumb = 'no';

                $numImg = 0;
                $numFolders = 0;
                foreach ($arr as $key2 => $value2) {
                    if( is_dir( $directory.'/'.$value.'/'.$value2) ){//IF IT IS A FOLDER
                        $numFolders++;
                    }else{//IF IT IS AN IMAGE

                        //PICK THE FIRST IMAGES FROM THE FOLDER TO USE IT AS COVER IMAGE
                        if( $folderImg == "" ){
                            $folderImg = $value2;
                            if( file_exists( $directory.'/'.$value.'/thumbnails'.'/'.$value2 ) ){//VERIFY IF THERE IS ANY THUMBNAIL FOR THE IMAGE
                              $thumb = 'yes';
                            } 
                        }

                        //VERIFY IF THERE IS ANY "folderCover" IMAGE IN THE FOLDER SO WE CAN USE IT AS COVER IMAGE 
                        $arrName = preg_split('/\.(?=[^.]*$)/',$value2);
                        $imgName = $arrName[0];

                        if( $folderImgCover == "" && $imgName == "folderCover" ){
                            $folderImgCover = $value2;
                        }

                        if($imgName != "folderCover"){
                            $numImg++;
                        }
                    }
                }


                //PICK A RANDOM IMAGES FROM THE FOLDER TO USE IT AS RANDOM IMAGE
                if($folderCoverRandom == 'true'){
                    $rand = rand(0,$numImg-1);
                    $cont = 0;
                    foreach ($arr as $key2 => $value2) {
                        if( is_dir( $directory.'/'.$value.'/'.$value2) ){//IF IT IS A FOLDER
                            // DO NOTHING
                        }else{//IF IT IS AN IMAGE
                            if($cont == $rand){
                                $folderImg = $value2;
                                if( file_exists( $directory.'/'.$value.'/thumbnails'.'/'.$value2 ) ){//VERIFY IF THERE IS ANY THUMBNAIL FOR THE IMAGE
                                  $thumb = 'yes';
                                } 
                            }

                            $cont++;
                        }
                    }
                }

                //IF THERE IS A COVER IMAGE INSIDE THE FOLDER THEN USE IT!
                if( $folderImgCover != "" ){
                    $folderImg = $folderImgCover;
                    $thumb = "no";
                }

                $val = array('numImages' => $numImg, 'numFolders' => $numFolders, 'image' => $folderImg, 'thumb' => $thumb);
            }else{
                $thumb = 'no';
                if( file_exists( $directory.'/thumbnails'.'/'.$value ) ){//VERIFY IF THERE IS ANY THUMBNAIL FOR THE IMAGE
                  $thumb = 'yes';
                } 

                $val = $thumb;
            }

            $return[$value] = $val;
      }

      return $return;
  }

  $directory = $_GET['directory'];

  //THE RESULT OF THE JSON CALL
  $output = array();
  
  //GET LIST OF IMAGES AND FOLDERS
  $list = getList($directory);

  $output = fixArray($list, $directory);

  //print_r($output);
  
  //echo json_encode($output, JSON_FORCE_OBJECT); // if you are using PHP 5.3 plase use this line instead of the one below

  echo json_encode($output); 



