<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$means = $obj['means'];

$riders = array();
$i = 0;

$query = "SELECT * FROM Transporters WHERE status = 'available' AND means = '$means'";
$run = mysqli_query($conn, $check);

while($get = mysqli_fetch_assoc($send)){
  $idQuery = "SELECT lpad(Id,5,'0') FROM Transporters WHERE Contact = '$get[Contact]'";
  $runQuery = mysqli_query($conn, $idQuery);
  $getQuery = mysqli_fetch_assoc($runQuery);
  
  $get['realId'] = $getQuery[lpad(Id,5,'0')];
  $riders[$i] = $get;
}

if($get){
    echo json_encode($riders, true);
}else{
    echo json_encode('Failed');
}
?>

























































