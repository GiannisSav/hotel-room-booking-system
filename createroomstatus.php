<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$roomnumber = "";
$roomid ="";
$roomstatus ="";
$notes ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $roomnumber = $_POST["roomnumber"];
    $roomid = $_POST["roomid"];
    $roomstatus = $_POST["roomstatus"];
    $notes = $_POST["notes"];

    do {
        if ( empty($roomnumber) || empty($roomid) || empty($roomstatus) || empty($notes) ) {
            $errorMessage = "All the field must be filled in";
            break;
        }

        // add new room status to database
        $sql = "INSERT INTO roomstatus (roomnumber, roomid, roomstatus, notes) " . "VALUES ('$roomnumber', '$roomid', '$roomstatus', '$notes')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }


        $roomnumber = "";
        $roomid ="";
        $roomstatus ="";
        $notes ="";

        $successMessage = "Room Status added correctly";

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