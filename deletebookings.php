<?php 
if (isset($_GET["reservationid"]) ) {
    $reservationid = $_GET["reservationid"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookingsystem";

    //Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM bookings WHERE reservationid=$reservationid";
    $connection->query($sql);
}
 header("location: /mywebsite/bookings.php");
 exit;

?>