<?php
$username = "root";
$server = "localhost";
$password = "";
$db_name = "demo";

$connection = new mysqli($server, $username, $password, $db_name);

if($connection->connect_error){
echo "The error happened " . $connection->connect_error;
}

$query = "SELECT name,facture,clnum FROM payed where name='ilias'";
$statement = $connection->prepare($query);
$statement->execute();

$users_array = array();

$statement->bind_result($id,$QR,$CA);

while($statement->fetch()){
    $temp = array();
    $temp['name'] = $id;
    $temp['facture'] = $QR;
    $temp['clnum'] = $CA;
    array_push($users_array,$temp);
}

echo json_encode($users_array);


$connection->close();