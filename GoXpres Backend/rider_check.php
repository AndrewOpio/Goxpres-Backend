<?php
    include 'connect.php';

    $json = file_get_contents('php://input');
    $obj  = json_decode($json, true);

    $contact = $obj['contact'];

    $chek = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND (TStatus = 'schedule' || TStatus = 'started' || TStatus = 'ended' || TStatus = 'confirmed')";
    $run = mysqli_query($conn, $chek);
    $rider = mysqli_fetch_assoc($run);

    if($rider){
        echo json_encode($rider, true);
    }else if (!$rider){
        echo json_encode("None");
    }
    
    mysqli_close($conn);

?>



















































