<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookingsystem";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);

$hotelid = "";
$name = "";
$address = "";
$telephone = "";
$email = "";
$fax = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    //GET method: show the data of the hotel
    if ( !isset($_GET["hotelid"]) ) {
        header("location: /mywebsite/hotels.php");
        exit;
    }

    $hotelid = $_GET["hotelid"];

    //read the row of the selected hotel from database table
    $sql = "SELECT * FROM hotel WHERE hotelid=$hotelid";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header ("loction: /mywebsite/hotels.php");
        exit;
    }

    $name = $row["name"];
    $address = $row["address"];
    $telephone = $row["telephone"];
    $email = $row["email"];
    $fax = $row["fax"];
}
else {
    //POST method: update the data of the hotel
    $hotelid = $_POST["hotelid"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $fax = $_POST["fax"];

    do {
        if ( empty($hotelid) || empty($name) || empty($address) || empty($telephone) || empty($email) || empty($fax) ) {
            $errorMessage = "Please fill in all the fields";
            break;
        }

        $sql = "UPDATE hotel " . 
                "SET name = '$name', address = '$address', telephone = '$telephone', email = '$email', fax = '$fax' " . 
                "WHERE hotelid = $hotelid";

        $result = $connection->query($sql);
        
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Hotels updated";

        header("location: /mywebsite/hotels.php");
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
    <h2>New Hotel</h2>

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
        <input type="hidden" name="hotelid" value="<?php echo $hotelid; ?>">
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Hotel Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Hotel Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Hotel Telephone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="telephone" value="<?php echo $telephone; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3-form-label">Fax</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="fax" value="<?php echo $fax; ?>">
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
                <a class="btn btn-outline-primary" href="/mywebsite/hotels.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>