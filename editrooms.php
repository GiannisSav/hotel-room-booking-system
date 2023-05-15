<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$roomid = "";
$roomnumber = "";
$roomtype = "";
$roomprice = "";
$roomstatus = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show the data of the rooms
    if ( !isset($_GET["roomid"]) ) {
        header("location: /mywebsite/rooms.php");
        exit;
    }

    $roomid = $_GET["roomid"];

    //read the row of the selected room from database table
    $sql = "SELECT * FROM room WHERE roomid=$roomid";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("loction: /mywebsite/rooms.php");
        exit;
    }

    $roomid = $row["roomid"];
    $roomnumber = $row["roomnumber"];
    $roomtype= $row["roomtype"];
    $roomprice = $row["roomprice"];
    $roomstatus = $row["roomstatus"];
}
else {
    //POST method: update the data of the room
    $roomid = $_POST["roomid"];
    $roomnumber = $_POST["roomnumber"];
    $roomtype = $_POST["roomtype"];
    $roomprice = $_POST["roomprice"];
    $roomstatus = $_POST["roomstatus"];

    do {
        if ( empty($roomid) || empty($roomnumber) || empty($roomtype) || empty($roomprice) || empty($roomstatus) ) {
            $errorMessage = "Please fill in all the fields";
            break;
        }

        $sql = "UPDATE room " . 
                "SET roomid = '$roomid', roomnumber = '$roomnumber', roomtype = '$roomtype', roomprice = '$roomprice', roomstatus = '$roomstatus' " . 
                "WHERE roomid = $roomid";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Room updated";

        header("location: /mywebsite/rooms.php");
        exit;

    } while (false);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel= "stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
    <h2>New Room</h2>

    <?php
    if ( !empty($errorMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <input type="hidden" name="roomid" value="<?php echo $roomid; ?>">
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomid" value="<?php echo $roomid; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomnumber" value="<?php echo $roomnumber; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Type</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomtype" value="<?php echo $roomtype; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomprice" value="<?php echo $roomprice; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Status</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomstatus" value="<?php echo $roomstatus; ?>">
            </div>
        </div>

        <?php
        if ( !empty($successMessage) ) {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria label='Close'></button>
                    </div>
                </div>
            </div>   
            ";
        }

        ?>


        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="sumbit" class="btn btn-primary">Sumbit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/mywebsite/rooms.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>