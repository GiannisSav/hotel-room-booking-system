<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$roomtypeid = "";
$roomtype = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show the data of the room type
    if ( !isset($_GET["roomtypeid"]) ) {
        header("location: /mywebsite/roomtype.php");
        exit;
    }

    $roomtypeid = $_GET["roomtypeid"];

    //read the row of the selected room type from database table
    $sql = "SELECT * FROM roomtype WHERE roomtypeid=$roomtypeid";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("loction: /mywebsite/roomtype.php");
        exit;
    }

    $roomtype = $row["roomtype"];
}
else {
    //POST method: update the data of the room type
    $roomtypeid = $_POST["roomtypeid"];
    $roomtype = $_POST["roomtype"];

    do {
        if ( empty($roomtypeid) || empty($roomtype) ) {
            $errorMessage = "Please fill in all the fields";
            break;
        }

        $sql = "UPDATE roomtype " . 
                "SET roomtype = '$roomtype' " . 
                "WHERE roomtypeid = $roomtypeid";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Room Type updated";

        header("location: /mywebsite/roomtype.php");
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
    <h2>New Room Type</h2>

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
        <input type="hidden" name="roomtypeid" value="<?php echo $roomtypeid; ?>">
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Type</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomtype" value="<?php echo $roomtype; ?>">
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
                <a class="btn btn-outline-primary" href="/mywebsite/roomtype.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>