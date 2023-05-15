<?php
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'bookingsystem');
    $stmt = $mysqli->prepare("SELECT * FROM bookings WHERE MONTH(datestart) = ? AND YEAR(datestart) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['datestart'];
            }
            
            $stmt->close();
        }
    }
    
    
     $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
     $firstDayOfMonth = mktime(0,0,0,(int)$month,1,(int)$year);
     $numberDays = date('t',$firstDayOfMonth);
     $dateComponents = getdate($firstDayOfMonth);
     $monthName = $dateComponents['month'];
     $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');
   
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-success 'style='background-color: #cc33ff;' href='?month=".date('m', mktime(0, 0, 0, (int)$month-1, 1, (int)$year))."&year=".date('Y', mktime(0, 0, 0, (int)$month-1, 1, (int)$year))."'>Previous Month</a> ";
    $calendar.= " <a class='btn btn-xs btn-danger' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, (int)$month+1, 1, (int)$year))."&year=".date('Y', mktime(0, 0, 0, (int)$month+1, 1, (int)$year))."'>Next Month</a></center><br>";
    
   
      $calendar .= "<tr>";
     foreach($daysOfWeek as $day) {
          $calendar .= "<th  class='header'>$day</th>";
     } 

     $currentDay = 1;
     $calendar .= "</tr><tr>";


     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

         }
     }
    
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
         if($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
         }elseif(in_array($date, $bookings)){
             $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'> <span class='glyphicon glyphicon-lock
             '></span> Already Booked</button>";
         }else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='calendarcreate.php?date=".$date."' class='btn btn-success btn-xs' style='background-color: #cc33ff;'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
         }
            
          $calendar .="</td>";
          $currentDay++;
          $dayOfWeek++;
     }

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 
         }
     }
     
     $calendar .= "</tr>";
     $calendar .= "</table>";
     echo $calendar;

}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel= "stylesheet" href= "https://maxcdn.boostrapcdn.com/boostrap/3.4.0/css/boostrap.min.css">
    <link rel= "stylesheet" href= "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center alert alert-danger" style="background:#e67e22;border:none;color:#fff" >
                    <h1>Hotel Room Booking System</h1>
                </div> 
                <div class="dropdown-center">
            <button class="btn btn-danger dropdown-toggle" type="button"  data-bs-toggle="dropdown" aria-expanded="false" style="float:right; background-color: orange;">
                Pages
            </button>
            <ul class="dropdown-menu" style="">
                <li><a class="dropdown-item" href="/mywebsite/bookings.php">Bookings</a></li>
                <li><a class="dropdown-item" href="/mywebsite/index.php">Customers</a></li>
                <li><a class="dropdown-item" href="/mywebsite/rooms.php">Rooms</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomprice.php">Room Prices</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomtype.php">Room Types</a></li>
                <li><a class="dropdown-item" href="/mywebsite/roomstatus.php">Room Status</a></li>
                <li><a class="dropdown-item" href="/mywebsite/hotels.php">Hotels</a></li>
            </ul>
        </div>
                    <?php
                        $dateComponents = getdate();
                        if(isset($_GET['month']) && isset($_GET['year'])) {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                        }
                        else{
                            $month = $dateComponents['month'];
                            $year = $dateComponents['year'];
                        }
                        echo build_calendar($month, $year);
                    ?>
                
            </div>
        </div>
    </div>
</body>
</html>
