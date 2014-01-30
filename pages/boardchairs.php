<?php

include 'v4jgtxri3jvluw4djwzt.php';
$con=mysqli_connect($srv,$ur,$ps,$db);
$sql = "SELECT tblEboard.position, tblBrothers.firstName, tblBrothers.middleName, tblBrothers.lastName, tblBrothers.ID
FROM tblEboard
LEFT JOIN tblBrothers
ON tblEboard.boardBro = tblBrothers.ID";
$sql2 = "SELECT tblChairs.chair, tblBrothers.firstName, tblBrothers.middleName, tblBrothers.lastName, tblBrothers.ID
FROM tblChairs
LEFT JOIN tblBrothers
ON tblChairs.chairBro = tblBrothers.ID
ORDER BY chair";
$result = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql2);

?>

<div class="genericSection section-SINGLE_PROJECT">
        
    <!--add here url for this section background image-->
    <img class="sectionBackgroundImage" src="pages/backgrounds/background_gears2.jpg" />
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
                <h2 class="textColor01">Eboard and Chairs<span class="textColor02"> // Our Leadership</span></h2>
                <div class="horizontalLine backgroundColor02"></div>
                <div class="clear-fx"></div>
            </div>
        </div>
        <!--/Section title H2-->
        
        <!--full width text-->
        <div class="row">
            <div class="eight columns">
                <table class="table textColor01">
                <tr><td colspan="6"><h3 class="textColor01" style="margin:0"><br />E-Board</h3></td></tr>
    <tr>
    <th style="width:50%">Position</th>
    <th style="width:50%">Name</th>
    </tr>
<?php
 while($row = mysqli_fetch_array($result)){
 	if (!is_null($row['firstName'])){
    echo "<tr>";
    echo "<td>".$row['position']."</td>";
    echo "<td>";
 		echo $row['firstName']." ".$row['middleName']." ".$row['lastName']."</td>";
    echo "</tr>";
 	}
}
?>
                </table>
            </div> 
            <!--/column-->
        <div class="eight columns">
        <table class="table textColor01">
            <tr><td colspan="6"><h3 class="textColor01" style="margin:0"><br />Chairs</h3></td></tr>
            <tr>
            <th style="width:50%">Chair</th>
            <th style="width:50%">Name</th>
        </tr>

<?php
 while($row = mysqli_fetch_array($result2)){
  if (!is_null($row['firstName'])){
    echo "<tr>";
    echo "<td>".$row['chair']."</td>";
    echo "<td>";
    echo $row['firstName']." ".$row['middleName']." ".$row['lastName']."</td>";
    echo "</tr>";
  }
}
 mysqli_close($con);
?>

      </table>
      </div>
      <!--/column-->        
    </div>
        
    <!--/skeleton container-->
</div>