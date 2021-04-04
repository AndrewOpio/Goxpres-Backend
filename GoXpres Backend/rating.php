<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['contact'];
$rating = $obj['rating'];

$query = "SELECT * FROM Transporters WHERE Contact = '$contact'";
$run = mysqli_query($conn, $query);
$get = mysqli_fetch_assoc($run);

$rate = $get['Rating'] + $rating; 

$sql = "SELECT * FROM RidesInfo WHERE RContact = '$contact' AND TStatus = 'finished'";
$execute = mysqli_query($conn, $sql);

$count = 0;

while($el = mysqli_fetch_assoc($execute)){
  $count ++;
}

$final = $rate / $count;

$update = "UPDATE Transporters SET Rating = $rate, avRating = $final WHERE Contact = '$contact'";
$run = mysqli_query($conn, $update);

if($run){
    echo json_encode("Done");
}else{
    echo json_encode('Failed');
}

mysqli_close($conn);
?>

























































