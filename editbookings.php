<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$reservationid = "";
$datestart = "";
$dateend = "";
$roomid = "";
$customers_id = "";
$noofnights = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show the data of the booking
    if ( !isset($_GET["reservationid"]) ) {
        header("location: /mywebsite/bookings.php");
        exit;
    }

    $reservationid = $_GET["reservationid"];

    //read the row of the selected booking from database table
    $sql = "SELECT * FROM bookings WHERE reservationid=$reservationid";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("loction: /mywebsite/bookings.php");
        exit;
    }

    $datestart = $row["datestart"];
    $dateend = $row["dateend"];
    $roomid = $row["roomid"];
    $customers_id = $row["customers_id"];
    $noofnights = $row["noofnights"];
}
else {
    //POST method: update the data of the booking
    $reservationid = $_POST["reservationid"];
    $datestart = $_POST["datestart"];
    $dateend = $_POST["dateend"];
    $roomid = $_POST["roomid"];
    $customers_id = $_POST["customers_id"];
    $noofnights = $_POST["noofnights"];

    do {
        if ( empty($reservationid) || empty($datestart) || empty($dateend) || empty($roomid) || empty($customers_id) || empty($noofnights) ) {
            $errorMessage = "Please fill in all the fields";
            break;
        }

        $sql = "UPDATE bookings " . 
                "SET datestart = '$datestart', dateend = '$dateend', roomid = '$roomid', customers_id = '$customers_id', noofnights = '$noofnights' " . 
                "WHERE reservationid = $reservationid";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Bookings updated";

        header("location: /mywebsite/bookings.php");
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
    <h2>New Booking</h2>

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
        <input type="hidden" name="reservationid" value="<?php echo $reservationid; ?>">
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Date Start</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="datestart" value="<?php echo $datestart; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Date End</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="dateend" value="<?php echo $dateend; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomid" value="<?php echo $roomid; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Customer ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customers_id" value="<?php echo $customers_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">No of nights</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="noofnights" value="<?php echo $noofnights; ?>">
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
                <a class="btn btn-outline-primary" href="/mywebsite/bookings.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>