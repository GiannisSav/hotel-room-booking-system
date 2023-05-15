<?php 
if (isset($_GET["roomtypeid"]) ) {
    $roomtypeid = $_GET["roomtypeid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM roomtype WHERE roomtypeid=$roomtypeid";
    $connection->query($sql);
}
 header("location: /mywebsite/roomtype.php");
 exit;

?>