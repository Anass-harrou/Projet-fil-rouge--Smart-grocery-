<?php
$json_object = file_get_contents('php://input');
$data = json_decode($json_object);
$qr=$data->qr;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";
$dbnamee = "client";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT solde FROM users where username = 'ilias'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    $x = $row["solde"]; 
  }
} else {
  echo "0 results";
}

$conn1 = new mysqli($servername, $username, $password, $dbnamee);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql1="SELECT total FROM fct";
$result1 = $conn1->query($sql1);
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $y = $row["total"];
    

  }
} else {
  echo "0 results";
}
$a=(int)$x;
$b=(int)$y;
$c=$a - $b;
if ($c<0)
{
  echo"solde insuffisant";
}
else{
  $sql5 = "INSERT INTO 	payeed (naame)
  VALUES ('done')";
  if ($conn1->query($sql5) === TRUE) {
    echo " ";
  } else {
    echo "Error: " . $sql5 . "<br>" . $conn1->error;
  }
  $sql4 = "INSERT INTO payed (name, facture, clnum)
  VALUES ('anass', '$b', '$qr')";
  if ($conn->query($sql4) === TRUE) {
    echo "successfully";
  } else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
  }
$sql3 = "UPDATE users SET solde='$c' WHERE username='ilias'";
if ($conn->query($sql3) === TRUE) {
  echo " ";
} else {
  echo "Error updating record: " . $conn->error;
}}

$conn->close();
$conn1->close();
?>