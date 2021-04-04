<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$vehicle = $obj['vehicle'];

//get user data to display in user profile
$check = "SELECT * FROM Transporters WHERE  Status = 'available' AND Vehicle = '$vehicle'";
$send = mysqli_query($conn, $check);

if($send){
    $riders = array();
    $i = 0;

    while($get = mysqli_fetch_assoc($send)){
        $idQuery = "SELECT lpad(Id,5,'0') FROM Transporters WHERE Contact = '$get[Contact]'";
        $runQuery = mysqli_query($conn, $idQuery);
        $getQuery = mysqli_fetch_assoc($runQuery);
        
        $get['realId'] = $getQuery["lpad(Id,5,'0')"];
        $get['plat'] = "";
        $get['plng'] = "";
        $get['dlat'] = "";
        $get['dlng'] = "";
        $get['code'] = "";

        
        $riders[$i] = $get;
        $i++;
    }

    echo json_encode($riders, true);
}else if (!$send){
    echo json_encode("Error");
}

mysqli_close($conn);

?>














































































