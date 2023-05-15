<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel= "stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class= "container my-5">
        <div class="text-center alert alert-danger" style="background:#e67e22;border:none;color:#fff" >
            <h1>Hotel Room Booking System</h1>
        </div>
        <h2>List of Rooms</h2>
        <a class="btn btn-primary" href="/mywebsite/createrooms.php" role="button">New Room</a>
        <div class="dropdown-center">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="float:right; background-color: orange;">
                Room Page
            </button>
            <ul class="dropdown-menu" style="">
                <li><a class="dropdown-item" href="/mywebsite/bookings.php">Bookings</a></li>
                <li><a class="dropdown-item" href="/mywebsite/index.php">Customers</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomprice.php">Room Prices</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomtype.php">Room Types</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomstatus.php">Room Status</a></li>
                <li><a class="dropdown-item" href="/mywebsite/hotels.php">Hotels</a></li>
                <li><a class="dropdown-item" href="/mywebsite/calendar.php">Calendar</a></li>
            </ul>
        </div>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Room Price</th>
                    <th>Room Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "bookingsystem";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection ->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM room";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[roomid]</td>
                        <td>$row[roomnumber]</td>
                        <td>$row[roomtype]</td>
                        <td>$row[roomprice]</td>
                        <td>$row[roomstatus]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/mywebsite/editrooms.php?roomid=$row[roomid]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/mywebsite/deleterooms.php?roomid=$row[roomid]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }

                ?>
                
            </tbody>
        </table>
    </div>
    
    
</body>
</html>