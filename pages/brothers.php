<?php

include 'v4jgtxri3jvluw4djwzt.php';
$con=mysqli_connect($srv,$ur,$ps,$db);
$sql = "SELECT brothersView.ID,brothersView.roll,brothersView.firstName,brothersView.middleName,brothersView.lastName,brothersView.chapter,brothersView.active, brothersView.hometown,\n"
    . " tblClasses.class,tblFamilies.longFamily,bigView.bigFirst,bigView.bigMiddle,bigView.bigLast,bigView.bigID,tblMajors.major\n"
    . "FROM brothersView\n"
    . "LEFT JOIN tblClasses\n"
    . "ON brothersView.class=tblClasses.ID\n"
    . "LEFT JOIN tblFamilies\n"
    . "ON brothersView.family=tblFamilies.shortFamily\n"
    . "LEFT JOIN tblMajors\n"
    . "ON brothersView.major=tblMajors.ID\n"
    . "LEFT JOIN bigView\n"
    . "ON brothersView.big=bigView.bigID 
    WHERE brothersView.roll != 8";
$result = mysqli_query($con, $sql);
?>

  <div class="genericSection section-BROTHERS">
        
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
                <h2 class="textColor01">Brothers<span class="textColor02"> // Our Family</span></h2>
                <ul class="isotopeMenu">
                    <li><a class="iconAll" id="all">All</a></li>
                    <li><a class="wheel" id="act">Active</a></li>
                    <li><a class="wheel" id="alum">Alumni</a></li>
                </ul>
                <div class="horizontalLine backgroundColor02"></div>
                <div class="clear-fx"></div>
            </div>
        </div>
        <!--/Section title H2-->
        
        <!--full width text-->
        <div class="row">
            <div class="sixteen columns">
  
 <?php
  while($row = mysqli_fetch_array($result))
  {
  	$new = $row['class'];
  	if ($new!=$old) {
  		echo '</table><table class="table textColor01" id="'.$row['class'].'">
			<tr>
			<td colspan="6"><h3 class="textColor01" style="margin:0"><br />'.$row['class'].'</h3></td></tr>
  		<tr>
  			<th style="width:5%">Roll</th>
  			<th style="width:35%">Name</th>
  			<th style="width:25%">Family</th>
  			<th style="width:35%">Big</th>
  		</tr>';
  	}
  		echo "<tr class='";
		if($row['active']==1||$row['active']==2){ echo "act"; } else { echo "alum"; }
		echo "'>";
  		echo "<td><a id='".$row['ID']."'>";
  		if ($row['chapter']!="OG"){
  			echo $row['roll'].$row['chapter']."</a></td>";
  		} else {
  			echo $row['roll']."</a></td>";
  		}
  		echo "<td>".$row['firstName']." ".$row['middleName']." ".$row['lastName'];
      if($row['active']==2){
        echo "<em> (Inactive)</em></td>";
      } else{
        echo "</td>";
      }
  		echo "<td>".$row['longFamily']."</td>";
  		echo "<td>".$row['bigFirst']." ".$row['bigMiddle']." ".$row['bigLast']."</td>";
  		echo "</tr>";

		  echo "
		    <tr id='".$row['ID']."info' class='info'><td colspan='6'>
				<div class='textColor01'style='width:95%; margin:auto;'>
        ";
        $picture = $_SERVER['DOCUMENT_ROOT']."/images/bropics/".$row['ID'].".jpg";
        if(file_exists($picture)){
          echo "<img src='/images/bropics/".$row['ID'].".jpg' style='float:left; padding:3px 5px; width:200px; height:200px; border:none;'/>";
        } else {
          echo "<img src='/images/bropics/default.jpg' style='float:left; padding:3px 5px; width:200px; height:200px; border:none;'/>";
        }
        echo "
		    	Major: ".$row['major']."<br />
		    	Hometown: ".$row['hometown']."<br />
		    		</div>
		    </td></tr>";
  	  $old = $row['class'];
  }
mysqli_close($con);
?>
          	</table>
           </div>         
        </div>
        <!--/full width text-->
        
    <!--/skeleton container-->
 
    
         
</div>