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
     $l=$row["solde"];
  }
} else {
  echo "0 results";
}
$conn->close();
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
  <h2> Votre solde est <?php echo $l?></h2>
</body>
</html>