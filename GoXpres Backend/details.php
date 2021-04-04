<?php
include 'connect.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);

$rcontact = $obj['rcontact']; 
$ccontact = $obj['ccontact'];
$date = $obj['date'];
$pickup = $obj['pickup'];
$dropoff = $obj['dropoff'];
$plat = $obj['plat'];
$plng = $obj['plng'];
$dlat = $obj['dlat'];
$dlng = $obj['dlng'];
$distance = $obj['distance'];
$quantity = $obj['quantity'];
$cost = $obj['cost'];
$commission = $obj['commission'];
$net = $cost - $commission;
$pextra = $obj['pextra'];
$dextra = $obj['dextra'];
$pcontact = $obj['pcontact'];
$dcontact = $obj['dcontact'];
$size = $obj['size'];
$tcode = rand(10000, 99999);
$tstatus = $obj['tstatus'];

$query = "INSERT INTO RidesInfo  VALUES ('$rcontact', '$ccontact', 
'$date','$pickup','$dropoff', '$plat',
'$plng', '$dlat', '$dlng', '$distance', '$quantity', '$cost', '$pextra',
'$dextra', '$pcontact', '$dcontact', '', '', '$tcode', '$tstatus', '', '',
'', '', '', $commission, $net, '$size')";

$insert = mysqli_query($conn, $query);

if(!$insert){
    echo json_encode("Error");
}else{
    echo json_encode($tcode);
}

mysqli_close($conn);

?>       












































