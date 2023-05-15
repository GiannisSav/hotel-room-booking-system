<?php 
if (isset($_GET["roompriceid"]) ) {
    $roompriceid = $_GET["roompriceid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM roomprice WHERE roompriceid=$roompriceid";
    $connection->query($sql);
}
 header("location: /mywebsite/roomprice.php");
 exit;

?>