<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['rcontact'];
$page = $obj['page'];

//get user data to display in user profile
if($page == "total"){
    $check = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND TStatus = 'finished'";
    $send = mysqli_query($conn, $check);

}else if($page == "missed"){
    $check = "SELECT * FROM RidesInfo WHERE  RContact = '$contact' AND (TStatus = 'cancelled' OR TStatus = 'missed')";
    $send = mysqli_query($conn, $check);    
}

if($send){
    $scheduled = array();
    $i = 0;

    while($result = mysqli_fetch_assoc($send)){

        $qry = "SELECT * FROM Users WHERE Contact = '$result[CContact]'";
        $rn = mysqli_query($conn, $qry);
        $profile = mysqli_fetch_assoc($rn);

        $qry1 = "SELECT * FROM Transporters WHERE Contact = '$result[RContact]'";
        $rn1 = mysqli_query($conn, $qry1);
        $profile1 = mysqli_fetch_assoc($rn1);

        $result['fname'] = $profile['FirstName'];
        $result['lname'] = $profile['LastName'];
        $result['vehicle'] = $profile1['Vehicle'];
        $scheduled[$i] = $result;
        $i++;
     }

    echo json_encode($scheduled, true);
    
}else if (!$send){
    echo json_encode($send.mysqli_error($conn));
}

mysqli_close($conn);

?>












































