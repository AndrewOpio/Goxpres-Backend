<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['initcontact'];

//Changing password
  $old = $obj['old'];
  $new = $obj['new'];

  $check = "SELECT * FROM Users WHERE Contact = '$contact' AND Password = '$old'";
  $send = mysqli_query($conn, $check);
  $get = mysqli_fetch_assoc($send);

  if($get){
    $update = "UPDATE Users SET Password = '$new' WHERE Contact = '$contact'";
    $run = mysqli_query($conn, $update);
    if($run){
      echo json_encode("Success");
    }
  }else{
      echo json_encode('Error');
  }
  
  mysqli_close($conn);
?>













































