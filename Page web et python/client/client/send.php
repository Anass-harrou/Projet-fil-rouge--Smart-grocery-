<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>




<!DOCTYPE HTML> 
<html>  
<body>
<style>
input[type=text], select {
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  margin-left: 100px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


input[type=number], select {
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  margin-left: 100px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 70%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  margin-left: 100px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

a{
    margin-left: 160px;
}

div{
  margin-left: 400px;
  margin-right: 400px;
  margin-top: 200px;
  border-radius: 2523px;
  background-color: #f2f2f2;
  padding: px;
}

</style>
<div>
<form action="snd.php" method="post" >
<input type="text" name="username" required placeholder= "client username " ><br>
<input type="number" name="solde" required placeholder="Valeur à charger" ><br>
<input type="submit">
</form>
<a href="welcome.php" class="btn btn-primary">Acceuil</a>
</div>

</body>
</html>