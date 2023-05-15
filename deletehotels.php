<?php 
if (isset($_GET["hotelid"]) ) {
    $hotelid = $_GET["hotelid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM hotel WHERE hotelid=$hotelid";
    $connection->query($sql);
}
 header("location: /mywebsite/hotels.php");
 exit;

?>