<?php
$username = "root";
$server = "localhost";
$password = "";
$db_name = "demo";

$connection = new mysqli($server, $username, $password, $db_name);

if($connection->connect_error){
echo "The error happened " . $connection->connect_error;
}

$query = "SELECT username,solde,carte FROM users";
$statement = $connection->prepare($query);
$statement->execute();

$users_array = array();

$statement->bind_result($id,$QR,$CA);

while($statement->fetch()){
    $temp = array();
    $temp['username'] = $id;
    $temp['solde'] = $QR;
    $temp['carte'] = $CA;
    array_push($users_array,$temp);
}

echo json_encode($users_array);


$connection->close();