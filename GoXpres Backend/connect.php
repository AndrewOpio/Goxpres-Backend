<?php
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "goxpres";
  
  $conn = mysqli_connect($server,$username,$password,$dbname);
  if(!$conn){
    echo "Didnt connect: " .mysqli_error($conn);
   }
?>