<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$code = $obj['code'];
$contact = $obj['contact'];

//get user data to display in user profile
$check = "SELECT * FROM RidesInfo WHERE  CContact = '$contact' AND TCode = '$code' AND (TStatus = 'started' OR TStatus = 'ended')";
$send = mysqli_query($conn, $check);
$get = mysqli_fetch_assoc($send);

if($get){
    echo json_encode($get, true);
}else if (!$get){
    echo json_encode("Error");
}

mysqli_close($conn);

?>



















































