<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$transporter = $obj['transporter'];
$customer = $obj['customer'];
$status = $obj['status'];
$user = $obj['user'];


if($status == "finished" || $status == "cancelled" || $status == "missed"){
   $sql = "UPDATE Transporters SET Status = 'available' WHERE Contact = '$transporter'";
   $exe = mysqli_query($conn, $sql);

} else if($status == "confirmed"){
   $sql = "UPDATE Transporters SET Status = 'unavailable' WHERE Contact = '$transporter'";
   $exe = mysqli_query($conn, $sql);

} 

if($status == "cancelled"){
    $query = "UPDATE RidesInfo SET TStatus = '$status', wcancelled = '$user'  WHERE RContact = '$transporter' AND  CContact = '$customer' AND (TStatus = 'request' OR TStatus = 'confirmed')";

}else if($status == "missed"){
    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer' AND TStatus = 'request'";

}else if($status == "confirmed"){
    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer' AND TStatus = 'request'";

}else if($status == "request"){
    $sql = "UPDATE Transporters SET Status = 'unavailable' WHERE Contact = '$transporter'";
    $exe = mysqli_query($conn, $sql); 

}else if($status == "started"){
    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer' AND TStatus = 'confirmed'";

}else if($status == "ended"){
    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer' AND TStatus = 'started'";

}else if($status == "finished"){
    //Getting cost of the entire journey
    $sql1 = "SELECT * FROM RidesInfo WHERE RContact = '$transporter' AND TStatus ='ended'";
    $exe1 = mysqli_query($conn, $sql1);
    $initial = mysqli_fetch_assoc($exe1);

    //Get the type of vehicle for the rider to calculate commission
    $sql2 = "SELECT * FROM Transporters WHERE Contact = '$transporter'";
    $exe2 = mysqli_query($conn, $sql2);
    $vehicle = mysqli_fetch_assoc($exe2);

    $am = $initial['Cost'];

    if($vehicle['Vehicle'] == "motorcycle"){
      $com = 0.2*$am;
      $nt = $am - $com;

    }else if($vehicle['Vehicle'] == ""){

    }

    //Getting values from Payments to add more amounts
    $sql3 = "SELECT * FROM Payments WHERE Contact = '$transporter'";
    $exe3 = mysqli_query($conn, $sql3);
    $finance = mysqli_fetch_assoc($exe3);

    $amount = $finance['AMount'] + $am;

    $commission = $finance['Commission'] + $com;
    $net = $finance['Net'] + $nt;

    //Updating Payments
    $sql4 = "UPDATE Payments SET Amount = '$amount', Commission = '$commission', Net = '$net' WHERE Contact = '$transporter'";
    $exe4 = mysqli_query($conn, $sql4); 

    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer'AND TStatus = 'ended'";

}else if($status == "scheduled"){
    $query = "UPDATE RidesInfo SET TStatus = '$status'  WHERE RContact = '$transporter' AND  CContact = '$customer'AND TStatus = 'request'";
    $sql = "UPDATE Transporters SET Status = 'available' WHERE Contact = '$transporter'";
    $exe = mysqli_query($conn, $sql);
}


$run = mysqli_query($conn, $query);

if($run){
    echo json_encode("Changed");
}else{
    echo json_encode('Failed'.mysqli_error($conn));
}

mysqli_close($conn);
?>

























































