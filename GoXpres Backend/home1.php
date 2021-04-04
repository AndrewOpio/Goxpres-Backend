<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['rcontact'];
$data = array();

//get user data to display in user profile
$check = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND TStatus = 'scheduled'";
$send = mysqli_query($conn, $check);

if($send){
    $s = 0;
    while($get = mysqli_fetch_assoc($send)){
      $s++;
    }
    $data[0] = $s;
}else if (!$send){
    echo json_encode($send.mysqli_error($conn));
}




$check1 = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND TStatus = 'finished'";
$send1 = mysqli_query($conn, $check1);

if($send1){
    $f = 0;
    while($get1 = mysqli_fetch_assoc($send1)){
      $f++;
    }
    $data[1] = $f;
}else if (!$send1){
    echo json_encode($send1.mysqli_error($conn));
}



$check2 = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND (TStatus = 'missed' OR TStatus = 'cancelled')";
$send2 = mysqli_query($conn, $check2);

if($send2){
    $c = 0;
    while($get2 = mysqli_fetch_assoc($send2)){
      $c++;
    }
    $data[2] = $c;
}else if (!$send2){
    echo json_encode($send2.mysqli_error($conn));
}

$check3 = "SELECT * FROM Payments WHERE  Contact = '$contact'";
$send3 = mysqli_query($conn, $check3);
$get3 = mysqli_fetch_assoc($send3);

$data[3] = $get3['AMount'];
$data[4] = $get3['Commission'];
$data[5] = $get3['Net'];

echo json_encode($data, true);

mysqli_close($conn);
?>