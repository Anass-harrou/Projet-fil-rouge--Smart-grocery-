<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>
</head>
<body>

<ul>
<li><a  href="welcome.php">Accueil</a></li>
  <li><a  href="index.php">solde</a></li>
  <li><a href="payer.php">Payer Ma Commande</a></li>
  <li><a href="send.php">Virement</a></li>
  <li><a href="dmd.php">Demander ma carte</a></li>
  <li><a href="ac.php">Activé ma carte</a></li>
  <li><a href="blq.php">Bloqué ma carte</a></li>
  <li><a href="hs.php">Historiquee</a></li>
  <li><a href="reset-password.php">Reset  Password</a></li>
  <li><a href="logout.php">Sign Out </a></li>
</ul>

</body>
</html>



<?php
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
$qq=$_SESSION["username"];
$sql="SELECT solde FROM users where username = '$qq'";
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
$sql1="SELECT total,cid FROM fct";
$result1 = $conn1->query($sql1);
if ($result1->num_rows > 0) {
  // output data of each row
  while($row = $result1->fetch_assoc()) {
    $y = $row["total"];
    $z = $row["cid"];
    

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
  VALUES ('$qq', '$b', '$z')";
  if ($conn->query($sql4) === TRUE) {
    echo "successfully";
  } else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
  }
$sql3 = "UPDATE users SET solde='$c' WHERE username='$qq'";
if ($conn->query($sql3) === TRUE) {
  echo " ";
} else {
  echo "Error updating record: " . $conn->error;
}}

$conn->close();
$conn1->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="welcome.php" class="btn btn-primary">Acceuil</a>
</body>
</html>