<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$customercontact = $obj['ccontact'];
$cancel = $obj['cancel'];

//get user data to display in user profile
if($cancel != ""){
    $ridercontact = $obj['rcontact'];
    $sql = "UPDATE RidesInfo SET TStatus = 'cancelled',  WCancelled = '$customercontact'  WHERE CContact = '$customercontact' AND RContact = '$ridercontact' AND TStatus = 'scheduled'";
    $execute = mysqli_query($conn, $sql);

    $scheduled = array();
    $i = 0;

    $query = "SELECT * FROM RidesInfo WHERE CContact = '$customercontact' AND TStatus ='scheduled'";
    $run = mysqli_query($conn, $query);

    if($run){
        while($result = mysqli_fetch_assoc($run)){

           $qry = "SELECT * FROM Transporters WHERE Contact = '$result[RContact]'";
           $rn = mysqli_query($conn, $qry);
           $profile = mysqli_fetch_assoc($rn);

           $result['fname'] = $profile['FirstName'];
           $result['lname'] = $profile['LastName'];

           $scheduled[$i] = $result;
           $i++;
        }

        echo json_encode($scheduled, true);
    }else if (!$run){
        echo json_encode('Error');
    }
}else{

    $scheduled = array();
    $i = 0;

    $check = "SELECT * FROM RidesInfo WHERE  CContact = '$customercontact' AND TStatus = 'scheduled'";
    $send = mysqli_query($conn, $check);

    if($send){

        while($get = mysqli_fetch_assoc($send)){

           $qry = "SELECT * FROM Transporters WHERE Contact = '$get[RContact]'";
           $rn = mysqli_query($conn, $qry);
           $profile = mysqli_fetch_assoc($rn);

           $get['fname'] = $profile['FirstName'];
           $get['lname'] = $profile['LastName'];
           $get['vehicle'] = $profile['Vehicle'];
            $scheduled[$i] = $get;
            $i++;
         }
         
        echo json_encode($scheduled, true);
        
    }else if (!$send){
        echo json_encode('Error');
    }
}

mysqli_close($conn);
?>