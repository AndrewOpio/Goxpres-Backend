<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$type =$obj['type'];
$contact = $obj['contact']; 
$email = $obj['email'];
$password = $obj['password'];

if($type != "B"){
   $fname = $obj['fname'];
   $lname = $obj['lname'];
   $gender = $obj['gender'];
   if($type == "R"){
    $means = $obj['means'];
   }   
}else if($type == "B"){
   $name = $obj['bname'];
   $location = $obj['location'];
   $address = $obj['address'];
}

//User sign up
$query = "SELECT * FROM Users WHERE Contact = '$contact'";
$run = mysqli_query($conn, $query);
$get = mysqli_fetch_assoc($run);

if($get){
    echo json_encode('Exists');
}else{
    $query1 = "SELECT * FROM Businesses WHERE Contact = '$contact'";
    $run1 = mysqli_query($conn, $query1);
    $get1 = mysqli_fetch_assoc($run1);  
    
    if($get1){
        echo json_encode('Exists');
    }else{
        $query2 = "SELECT * FROM Transporters WHERE Contact = '$contact'";
        $run2 = mysqli_query($conn, $query2);
        $get2 = mysqli_fetch_assoc($run2);   
        
        if($get2){
            echo json_encode('Exists');
        }else{    

            if($type == "P"){
                $query1 = "INSERT INTO Users VALUES ('$fname', '$lname', '$email' ,'$contact' , '$type', '$gender', '$password', '', 'active')";
            }else if($type == "B"){
                $query1 = "INSERT INTO Businesses VALUES ( '$name', '$email', '$contact', '$type' ,'$address' ,'$location', '$password', '', 'active')";
            }else if($type == "R"){
                $query1 = "INSERT INTO Transporters (FirstName, LastName, Email, Contact, AccType, Gender, Vehicle, Status, Password, CLat, CLng, Propic, Rating, avRating, Activity, Permission)
                VALUES ('$fname', '$lname', '$email' ,'$contact' , '$type', '$gender', '$means', 'available', '$password',  0.0, 0.0, '', 0.0, 0.0, 'active', 'unavailable')";
                $query2 = "INSERT INTO Payments VALUES ('$contact', 0.0, 0.0, 0.0)";
                $payments = mysqli_query($conn, $query2);
            }
        
            $insert = mysqli_query($conn, $query1);
            if(!$insert){
                echo json_encode($insert.mysqli_error($conn));
            }else{
                //$random = rand(10000, 99999);
                //$query2 = "INSERT INTO Code VALUES('$contact', '$random')";
                //$run1 = mysqli_query($conn, $insert);
                echo json_encode("Successful");
            }
        }        
        
    }
    
}

mysqli_close($conn);
?>       