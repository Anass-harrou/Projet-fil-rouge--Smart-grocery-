<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demo";
$qq=$_SESSION["username"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET statut ='Activé' WHERE username ='$qq'";

if ($conn->query($sql) === TRUE) {
  //echo "votre carte est activé";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
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
<h1> votre carte est activé</h1>
</body>
</html>




