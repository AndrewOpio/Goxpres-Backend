<?php
    include 'connect.php';

    $json = file_get_contents('php://input');
    $obj  = json_decode($json, true);

    $sql1 = "SELECT * FROM Boda";
    $send1 = mysqli_query($conn, $sql1);
    $get1 = mysqli_fetch_assoc($send1);

    $sql2 = "SELECT * FROM Small";
    $send2 = mysqli_query($conn, $sql2);
    $get2 = mysqli_fetch_assoc($send2);

    $sql3 = "SELECT * FROM Medium";
    $send3 = mysqli_query($conn, $sql3);
    $get3 = mysqli_fetch_assoc($send3);

    $prices = array();
    $prices['boda'] = $get1; 
    $prices['small'] = $get2; 
    $prices['medium'] = $get3;

    echo json_encode($prices, true);
        
    mysqli_close($conn);

?>












































