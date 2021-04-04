<?php
    include 'connect.php';

    $json = file_get_contents('php://input');
    $obj  = json_decode($json, true);

    $query = "SELECT * FROM Policy";
    $run = mysqli_query($conn, $query);
    $get = mysqli_fetch_assoc($run);

    if($get){
        echo json_encode($get);
    }else{
        echo json_encode('Error');
    }

    mysqli_close($conn);
?>































































































































