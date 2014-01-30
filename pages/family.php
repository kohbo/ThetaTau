  <div class="genericSection section-FAMILY">
        
    <!--add here url for this section background image-->
    <img class="sectionBackgroundImage" src="pages/backgrounds/background_redgear.jpg" />
    <!--/section background image-->
   
    
    <!--skeleton container-->
    <div class="container">
        <!--Website logo-->
        <div class="row">
            <div class="sixteen columns">
                <img class="brand" src="images/logo.png" alt="logo" />
            </div>
        </div>
        <!--/Website logo-->
        
        
        <!--Section title H2-->
        <div class="row">
            <div class="sixteen columns">
                <div class="h2square backgroundColor02"></div>
                <h2 class="textColor01">Family Lines<span class="textColor02"> // Our Tree</span></h2>
                <div class="horizontalLine backgroundColor02"></div>
                <div class="clear-fx"></div>
            </div>
        </div>
        <!--/Section title H2-->
        
        <!--full width text-->
        <div class="row">
            <div class="sixteen columns">
              <?php
  require "v4jgtxri3jvluw4djwzt.php";
  $mysqli = new mysqli($srv, $ur, $ps, $db);

  $result = $mysqli->query("SELECT ID,firstName, middleName, lastName, big, tblFamilies.longFamily
                FROM tblBrothers 
                LEFT JOIN tblFamilies
                ON tblBrothers.family = tblFamilies.shortFamily
                WHERE (big = 0)");
  echo '<div class="accordion family">';
  while($data = $result->fetch_array(MYSQLI_ASSOC)){
    echo '<h3>'.$data['longFamily'].' - '.getName($data).'</h3><div>';
    getTree($data, 1);
    echo '</div>';
  }
  echo '</div>';
  
  
  function getTree($person, $depth){
    global $mysqli;
    $result2 = $mysqli->query("SELECT ID, firstName, middleName, lastName, big FROM tblBrothers WHERE big=".$person['ID']);
    echo '<ul>';
    while($subject = $result2->fetch_array(MYSQLI_ASSOC)){
      $result3 = $mysqli->query("SELECT ID, firstName, middleName, lastName, big FROM tblBrothers WHERE big=".$subject['ID']);
      echo '<li>'.getName($subject).'</li>';
      if($result3->num_rows > 0){
        getTree($subject, $depth+1);
      }
    }
    echo '</ul>';
    
  }

  function getName($array){
    return implode(" ", array_slice($array, 1, 3));
  }
?>

           </div>         
        </div>
        <!--/full width text-->
        
    <!--/skeleton container-->
 
    
         
</div>