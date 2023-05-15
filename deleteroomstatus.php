<?php 
if (isset($_GET["roomstatusid"]) ) {
    $roomstatusid = $_GET["roomstatusid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM roomstatus WHERE roomstatusid=$roomstatusid";
    $connection->query($sql);
}
 header("location: /mywebsite/roomstatus.php");
 exit;

?>