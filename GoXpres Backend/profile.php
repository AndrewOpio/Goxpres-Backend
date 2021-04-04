<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['contact'];
$user = $obj['user'];

//get user data to display in user profile
if($user == "user"){
    $check = "SELECT * FROM Users WHERE Contact = '$contact'";
}else if($user == "rider"){
    $check = "SELECT * FROM Transporters WHERE Contact = '$contact'";
}else if($user == "business"){
    $check = "SELECT * FROM Businesses WHERE Contact = '$contact'";
}

$send = mysqli_query($conn, $check);

if($send){
    $get = mysqli_fetch_assoc($send);
    echo json_encode($get, true);
    
}else if (!$send){
    echo json_encode($get.mysqli_error($conn));
}

mysqli_close($conn);

?>