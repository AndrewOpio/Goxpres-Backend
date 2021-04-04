<?php
    include 'connect.php';

    $json = file_get_contents('php://input');
    $obj  = json_decode($json, true);

    //get user data to display in user profile
    if($obj['user'] == "user"){

      if($obj['fname'] != ''){
        $update = "UPDATE Users SET FirstName = '$obj[fname]' WHERE Contact ='$obj[initcontact]'";
        $go = mysqli_query($conn, $update);
      }
      if($obj['lname'] != ''){
        $update1 = "UPDATE Users SET LastName = '$obj[lname]' WHERE Contact ='$obj[initcontact]'";
        $go1 = mysqli_query($conn, $update1);
      }
      if($obj['email'] != ''){
        $update2 = "UPDATE Users SET Email = '$obj[email]' WHERE Contact ='$obj[initcontact]'";
        $go2 = mysqli_query($conn, $update2);
      }
      if($obj['gender'] != ''){
        $update3 = "UPDATE Users SET Gender = '$obj[gender]' WHERE Contact ='$obj[initcontact]'";
        $go3 = mysqli_query($conn, $update3);
      }
      if($obj['contact'] != ''){
        $update4 = "UPDATE Users SET Contact = '$obj[contact]' WHERE Contact ='$obj[initcontact]'";
        $go4 = mysqli_query($conn, $update4);
      }


    }else if($obj['user'] == "business"){
      if($obj['businessname'] != ''){
        $update = "UPDATE Businesses SET BusinessName = '$obj[bussinessname]' WHERE Contact ='$obj[initcontact]'";
        $go = mysqli_query($conn, $update);
      }
      if($obj['contact'] != ''){
        $update1 = "UPDATE Businesses SET Contact = '$obj[contact]' WHERE Contact ='$obj[initcontact]'";
        $go1 = mysqli_query($conn, $update1);
      }
      if($obj['email'] != ''){
        $update2 = "UPDATE Businesses SET Email = '$obj[email]' WHERE Contact ='$obj[initcontact]'";
        $go2 = mysqli_query($conn, $update2);
        
      }
      if($obj['address'] != ''){
        $update3 = "UPDATE Businesses SET Address = '$obj[address]' WHERE Contact ='$obj[initcontact]'";
        $go3 = mysqli_query($conn, $update3);
      }
      if($obj['location'] != ''){
        $update4 = "UPDATE Businesses SET Location = '$obj[location]' WHERE Contact ='$obj[initcontact]'";
        $go4 = mysqli_query($conn, $update4);
      }


    }if($obj['user'] == "transporter"){
      if($obj['fname'] != ''){
        $update = "UPDATE Transporters SET FirstName = '$obj[fname]' WHERE Contact ='$obj[initcontact]'";
        $go = mysqli_query($conn, $update);
      }
      if($obj['lname'] != ''){
        $update1 = "UPDATE Transporters SET LastName = '$obj[lname]' WHERE Contact ='$obj[initcontact]'";
        $go1 = mysqli_query($conn, $update1);
      }
      if($obj['email'] != ''){
        $update2 = "UPDATE Transporters SET Email = '$obj[email]' WHERE Contact ='$obj[initcontact]'";
        $go2 = mysqli_query($conn, $update2);
      }
      if($obj['gender'] != ''){
        $update3 = "UPDATE Transporters SET Gender = '$obj[gender]' WHERE Contact ='$obj[initcontact]'";
        $go3 = mysqli_query($conn, $update3);
      }
      if($obj['contact'] != ''){
        $update4 = "UPDATE Transporters SET Contact = '$obj[contact]' WHERE Contact ='$obj[initcontact]'";
        $go4 = mysqli_query($conn, $update4);
      }
      if($obj['means'] != ''){
        $update4 = "UPDATE Transporters SET Vehicle = '$obj[means]' WHERE Contact ='$obj[initcontact]'";
        $go4 = mysqli_query($conn, $update4);
      }

    }else{
      echo json_decode("Failed");

    }

  if($obj['user'] == "user"){
     $check = "SELECT * FROM Users WHERE Contact = '$obj[initcontact]'";
  }else if($obj['user'] == "transporter"){
     $check = "SELECT * FROM Transporters WHERE Contact = '$obj[initcontact]'";
  }else if($obj['user'] == "business"){
     $check = "SELECT * FROM Businesses WHERE Contact = '$obj[initcontact]'";
  }
  
  $send = mysqli_query($conn, $check);
  
  if($send){
      $get = mysqli_fetch_assoc($send);
      echo json_encode($get, true);
      
  }else if (!$send){
      echo json_encode($get.mysqli_error($conn));
  }

  mysqli_close($conn);
  
?>


























































































