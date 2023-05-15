<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$roomstatusid = "";
$roomnumber = "";
$roomid = "";
$roomstatus = "";
$notes = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show the data of the room status
    if ( !isset($_GET["roomstatusid"]) ) {
        header("location: /mywebsite/roomstatus.php");
        exit;
    }

    $roomstatusid = $_GET["roomstatusid"];

    //read the row of the selected room status from database table
    $sql = "SELECT * FROM roomstatus WHERE roomstatusid=$roomstatusid";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("loction: /mywebsite/roomstatus.php");
        exit;
    }

    $rooomnumber = $row["roomnumber"];
    $roomid = $row["roomid"];
    $roomstatus = $row["roomstatus"];
    $notes = $row["notes"];
}
else {
    //POST method: update the data of the room status
    $roomstatusid = $_POST["roomstatusid"];
    $roomnumber = $_POST["roomnumber"];
    $roomid = $_POST["roomid"];
    $roomstatus = $_POST["roomstatus"];
    $notes = $_POST["notes"];

    do {
        if ( empty($roomstatusid) || empty($roomnumber) || empty($roomid) || empty($roomstatus) || empty($notes) ) {
            $errorMessage = "Please fill in all the fields";
            break;
        }

        $sql = "UPDATE roomstatus " . 
                "SET roomnumber = '$roomnumber', roomid = '$roomid', roomstatus = '$roomstatus', notes = '$notes' " . 
                "WHERE roomstatusid = $roomstatusid";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Room Status updated";

        header("location: /mywebsite/roomstatus.php");
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
    <h2>New Room Status</h2>

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
        <input type="hidden" name="roomstatusid" value="<?php echo $roomstatusid; ?>">
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomnumber" value="<?php echo $roomnumber; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomid" value="<?php echo $roomid; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Status</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomstatus" value="<?php echo $roomstatus; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Notes</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="notes" value="<?php echo $notes; ?>">
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
                <a class="btn btn-outline-primary" href="/mywebsite/roomstatus.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>