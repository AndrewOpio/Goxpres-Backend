<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$contact = $obj['contact'];

$query1 = "SELECT * FROM Users WHERE Contact = '$contact'";
$run1 = mysqli_query($conn, $query1);
$get1 = mysqli_fetch_assoc($run1);

if($get1){
    if($get1['Status'] == 'blocked'){
        echo json_encode('Blocked');
    }else{
       echo json_encode('Active');
    }
}else{
    $query2 = "SELECT * FROM Transporters WHERE Contact = '$contact'";
    $run2 = mysqli_query($conn, $query2);
    $get2 = mysqli_fetch_assoc($run2);

    if($get2){
        if($get2['Activity'] == 'blocked'){
            echo json_encode('Blocked');
        }else{
           echo json_encode('Active');
        }
    }else{
        $query3 = "SELECT * FROM Businesses WHERE Contact = '$contact'";
        $run3 = mysqli_query($conn, $query3);
        $get3 = mysqli_fetch_assoc($run3);   
        
        if($get3){
            if($get1['Status'] == 'blocked'){
                echo json_encode('Blocked');
            }else{
               echo json_encode('Active');
            }
        }else{
            echo json_encode('Failed');
        }
    }
}

mysqli_close($conn);

?>
