<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['contact'];

//get user data to display in user profile
$check = "SELECT * FROM RidesInfo WHERE  CContact = '$contact' AND TStatus = 'finished'";
$send = mysqli_query($conn, $check);

if($send){
    $previous = array();
    $i = 0;

    while($get = mysqli_fetch_assoc($send)){
        $qry = "SELECT * FROM Transporters WHERE Contact = '$get[RContact]'";
        $rn = mysqli_query($conn, $qry);
        $profile = mysqli_fetch_assoc($rn);

        $get['fname'] = $profile['FirstName'];
        $get['lname'] = $profile['LastName'];
        $get['vehicle'] = $profile['Vehicle'];
        $previous[$i] = $get;
        $i++;
    }

    echo json_encode($previous, true);
}else if (!$send){
    echo json_encode($send.mysqli_error($conn));
}

mysqli_close($conn);
?>