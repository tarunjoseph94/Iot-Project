<?php
include ('includes/db-connect.php');
  date_default_timezone_set('Asia/Kolkata');
   $d = date("Y-m-d");
   //echo " Date:".$d."<BR>";
   $t = date("H:i:s");

   if(!empty($_GET['humid']) && !empty($_GET['temp']) && !empty($_GET['moisture']) && !empty($_GET['light'])) {
     $humid = $_GET['humid'];
     $temp = $_GET['temp'];
     $moist = $_GET['moisture'];
     $light = $_GET['light'];

     $sql = "INSERT INTO log (humid, temp,moist,light, Date, Time) VALUES ('".$humid."', '".$temp."','".$moist."', '".$light."', '".$d."', '".$t."')";

   if (mysqli_query($conn,$sql)) {
       echo "OK";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }



 $conn->close();
}

?>
