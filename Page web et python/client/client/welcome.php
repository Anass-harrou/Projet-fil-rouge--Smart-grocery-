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
  <li><a  href="index.php">Solde</a></li>
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


<h1 class="my-5">Bonjour, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></h1>