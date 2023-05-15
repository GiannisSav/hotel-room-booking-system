<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$roomid = "";
$roomprice ="";


$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $roomid = $_POST["roomid"];
    $roomprice = $_POST["roomprice"];

    do {
        if ( empty($roomid) || empty($roomprice) ) {
            $errorMessage = "All the field must be filled in";
            break;
        }

        // add new room price to database
        $sql = "INSERT INTO roomprice (roomid, roomprice) " . "VALUES ('$roomid', '$roomprice')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }


        $roomid = "";
        $roomprice ="";

        $successMessage = "Room Price added correctly";

        header("location: /mywebsite/roomprice.php");
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
    <h2>New Room Price</h2>

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
            <label class="col-sm-3-form-label">Room ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomid" value="<?php echo $roomid; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Room Price</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="roomprice" value="<?php echo $roomprice; ?>">
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
                <a class="btn btn-outline-primary" href="/mywebsite/roomprice.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>