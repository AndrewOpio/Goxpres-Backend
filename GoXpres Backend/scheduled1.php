<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$ridercontact = $obj['rcontact'];
$cancel = $obj['cancel'];
$start = $obj['start'];

//get user data to display in user profile
if($cancel != ""){
    $customercontact = $obj['ccontact'];
    $sql = "UPDATE RidesInfo SET TStatus = 'cancelled',  WCancelled = '$ridercontact'  WHERE CContact = '$customercontact' AND RContact = '$ridercontact'";
    $execute = mysqli_query($conn, $sql);

    $scheduled = array();
    $i = 0;

    $query = "SELECT * FROM RidesInfo WHERE RContact = '$ridercontact' AND TStatus ='scheduled'";
    $run = mysqli_query($conn, $query);

    if($run){
        while($result = mysqli_fetch_assoc($run)){

           $qry = "SELECT * FROM Users WHERE Contact = '$result[CContact]'";
           $rn = mysqli_query($conn, $qry);
           $profile = mysqli_fetch_assoc($rn);

           $qry1 = "SELECT * FROM Transporters WHERE Contact = '$result[RContact]'";
           $rn1 = mysqli_query($conn, $qry1);
           $profile1 = mysqli_fetch_assoc($rn1);
   
           $result['fname'] = $profile['FirstName'];
           $result['lname'] = $profile['LastName'];
           $get['vehicle'] = $profile1['Vehicle'];
           $scheduled[$i] = $result;
           $i++;
        }

        echo json_encode($scheduled, true);
    }else if (!$run){
        echo json_encode('Error');
    }

    
}else if($start != ""){
    $customercontact = $obj['ccontact'];

    $update = "UPDATE RidesInfo SET TStatus = 'confirmed' WHERE RContact = '$ridercontact' AND CContact = '$customercontact' AND TStatus = 'scheduled'";
    $exe = mysqli_query($conn, $update);

    $scheduled = array();
    $i = 0;

    $check = "SELECT * FROM RidesInfo WHERE  RContact = '$ridercontact' AND TStatus = 'scheduled'";
    $send = mysqli_query($conn, $check);

    if($send){

        while($get = mysqli_fetch_assoc($send)){

           $qry = "SELECT * FROM Users WHERE Contact = '$get[CContact]'";
           $rn = mysqli_query($conn, $qry);
           $profile = mysqli_fetch_assoc($rn);

           $get['fname'] = $profile['FirstName'];
           $get['lname'] = $profile['LastName'];

            $scheduled[$i] = $get;
            $i++;
         }
         
        echo json_encode($scheduled, true);
        
    }else if (!$send){
        echo json_encode('Error');
    }
}else{
    $scheduled = array();
    $i = 0;

    $check = "SELECT * FROM RidesInfo WHERE  RContact = '$ridercontact' AND TStatus = 'scheduled'";
    $send = mysqli_query($conn, $check);

    if($send){

        while($get = mysqli_fetch_assoc($send)){

           $qry = "SELECT * FROM Users WHERE Contact = '$get[CContact]'";
           $rn = mysqli_query($conn, $qry);
           $profile = mysqli_fetch_assoc($rn);

           $qry1 = "SELECT * FROM Transporters WHERE Contact = '$get[RContact]'";
           $rn1 = mysqli_query($conn, $qry1);
           $profile1 = mysqli_fetch_assoc($rn1);

           $get['fname'] = $profile['FirstName'];
           $get['lname'] = $profile['LastName'];
           $get['vehicle'] = $profile1['Vehicle'];

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