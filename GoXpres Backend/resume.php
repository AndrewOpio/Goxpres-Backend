<?php
    include 'connect.php';

    $json = file_get_contents('php://input');
    $obj  = json_decode($json, true);

    $contact = $obj['contact'];
    $code = $obj['code'];

    if($code != ""){
        $chek = "SELECT * FROM RidesInfo WHERE  CContact = '$contact' AND TStatus = 'started' AND TCode = '$code'";
    }else{
        $chek = "SELECT * FROM RidesInfo WHERE  CContact = '$contact' AND TStatus = 'started'";
    }
    $run = mysqli_query($conn, $chek);
    $rider = mysqli_fetch_assoc($run);

    $check = "SELECT * FROM Transporters WHERE Contact = '$rider[RContact]'";
    $query = mysqli_query($conn, $check);
    $profile = mysqli_fetch_assoc($query);
    $profile['code'] = $rider['TCode'];
    $profile['plat'] = $rider['PLat'];
    $profile['plng'] = $rider['PLng'];
    $profile['dlat'] = $rider['DLat'];
    $profile['dlng'] = $rider['DLng'];


    $idQuery = "SELECT lpad(Id,5,'0') FROM Transporters WHERE Contact = '$profile[Contact]'";
    $runQuery = mysqli_query($conn, $idQuery);
    $getQuery = mysqli_fetch_assoc($runQuery);
    
    $profile['realId'] = $getQuery["lpad(Id,5,'0')"];

    $arr = array();
    $arr[0] = $profile;
    if($profile){
        echo json_encode($arr, true);
        
    }else if (!$profile){
        echo json_encode("Error");
    }
    
    mysqli_close($conn);

?>



















































