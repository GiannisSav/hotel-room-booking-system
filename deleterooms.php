<?php 
if (isset($_GET["roomid"]) ) {
    $roomid = $_GET["roomid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM room WHERE roomid=$roomid";
    $connection->query($sql);
}
 header("location: /mywebsite/rooms.php");
 exit;

?>