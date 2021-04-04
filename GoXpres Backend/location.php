<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['contact'];
$lat = $obj['lat'];
$lng = $obj['lng'];

$update = "UPDATE Transporters SET CLat = '$lat', CLng = '$lng' WHERE Contact = '$contact'";
$run = mysqli_query($conn, $update);
if($run){
    echo json_encode("Success");
}else{
    echo json_encode("Failed");
}

mysqli_close($conn);
?>













































