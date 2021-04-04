<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$ccontact = $obj['ccontact'];
$rcontact = $obj['rcontact'];
$scheduled = $obj['scheduled'];

//getting trip information

if($scheduled == ""){
    $check = "SELECT * FROM RidesInfo WHERE  TStatus = 'request' AND CContact = '$ccontact' AND RContact = '$rcontact'";
}else{
    $check = "SELECT * FROM RidesInfo WHERE  TStatus = 'confirmed' AND RContact = '$rcontact' AND CContact = '$ccontact'";
}
$send = mysqli_query($conn, $check);
$get = mysqli_fetch_assoc($send);

if($send){
    echo json_encode($get, true);
}else if (!$send){
    echo json_encode("Error");
}

mysqli_close($conn);

?>





















































































































































