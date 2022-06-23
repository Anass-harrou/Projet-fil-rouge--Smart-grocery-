<!DOCTYPE html>
<html lang="en"> 
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<a href="client.php" class="btn btn-primary">Nos client</a>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$ll=$_POST["username"];
$ss=$_POST["solde"];
$sql = "SELECT solde FROM users where username = '$ll'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
    $so=$row["solde"];
  }
} else {
  echo "User introuvable";
}
$up=$so + $ss;
$sql1 = "UPDATE users SET solde='$up' WHERE username='$ll'";
if ($conn->query($sql1) === TRUE) {
  echo "RECHARGE EFFECTUE";
} else {
  echo "Error updating record: " . $conn->error;
}
$conn->close();
?>