<?php 

// enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to database
$connection = mysqli_connect("localhost", "root", "", "jomlahbazardb");

//run the store proc
$result = mysqli_query($connection, "CALL products");

//loop the result set
while ($row = mysqli_fetch_array($result)){     
  echo $row[0] . "-" .$row[1] . "-" . $row[2].  "-" .$row[3]. "-" . $row[4]. "-" . $row[5] . "\r\n"; 
}