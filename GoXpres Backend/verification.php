<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$code = $obj['code'];
$contact = $obj['contact'];

$query = "SELECT * FROM Codes WHERE contact = '$contact' AND code = '$code'";
$run = mysqli_query($conn, $check);
$get = mysqli_fetch_assoc($send);

if($get){
    $sql = "DELETE FROM Codes WHERE email = '$email'";
    $execute = mysqli_query($conn, $sql);

    echo json_encode('Success');
}else{
    echo json_encode('Failed');
}

mysqli_close($conn);
?>

























































