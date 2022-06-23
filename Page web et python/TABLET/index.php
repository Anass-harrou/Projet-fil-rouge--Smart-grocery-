<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        img{
            margin: 15px;
            border: 1px solid #ddd;
            display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;
  border-radius: 4px;
  padding: 3px;
  width: 210px;
        }
        footer {
            position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-image: linear-gradient(to left, blue , yellow);
  color: white;
  text-align: center;
}
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <img src="MyQRCode1.png">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                    <h5>[SMART CART]  </h5>
                        <h2 class="pull-left">PANIER</h2>
                    </div>
                    <h6><?php 
                    

// Return current date from the remote server
$date = date('d-m-y');
$date2 = date('h:i:s');
echo "Date   : $date <br> Heure : $date2"
?></h6>
                    <?php  header("refresh: 3");
                    // Include config file
                    require_once "config.php";
                   
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM customers";
                    if($result = mysqli_query($link, $sql)){
                        
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Produit</th>";
                                        echo "<th>Prix </th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['produit'] . "</td>";
                                        echo "<td>" . $row['prix'] . "</td>";                                        
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Votre panier est vide</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    
                    ?>
                    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "client";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT naame FROM payeed WHERE naame='done'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo"<script language='javascript'>
        alert('THANK YOU');
    </script>
    ";
  }
} else {
  echo " ";
}
$sql1 = "SELECT Total, cid FROM fct";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
      echo "Total: " . $row["Total"]. " - n.panier: " . $row["cid"]. "<br>";
    }
  } else {
    echo "0 results";
  }
$conn->close();
?>
                </div>
            </div>        
        </div>
    </div>
  
</body>
</html>