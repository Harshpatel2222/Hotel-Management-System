<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Hotel Management Sysytem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="customer.css">
</head>
<body >
  <!-- Navigation bar top -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark ">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">Hotel Management System</a>
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#room">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#about">About</a>
        </li>
      </ul>

    </div>
  </nav>
  <!-- Background Image -->
  <section >
    <img id="background" src="Images/background.jpg" alt="">
  </section>
  <!-- Text -->
  <section id="text">
    <p class="text-1">Welcome to 5	&#11088; Hotel</p>
    <p class="text-2">A Best Place To Stay</p>
  </section>
  <!-- Check Avability -->
  <form action="customer.php"   method="POST">
  <div class="container check">
    <span class="date">Check-in Date</span>
    <input class="date-1" type="date" name="check-in-date" id="">
    <span class="date">check-out Date</span>
    <input class="date-1" type="date" name="check-out-date" id="">
    <button class="check-button" type="submit" name="available_room">Check Avability</button>
    </form>
  </div>
  <div class="container">
  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['available_room'])){
  $date = strtotime($_POST['check-in-date']);
  $check_in= date('Y-m-d', $date );
  $date = strtotime($_POST['check-out-date']);
  $check_out= date('Y-m-d', $date ); 
  $sql = "CALL available_room('$check_in','$check_out')";
$result = $conn->query($sql); 
    if($result){        
?>
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Room No</th>
                <th>Floor No</th>
                <th>Room name</th>
                <th>No of Single Bed</th>
                <th>No of Double Bed</th>
                <th>No of Accomodate</th>
                <th>Features</th>
                <th>Price Per Day</th>
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['floor_no'] ?></td>
                    <td><?php echo $r['room_name'] ?></td>
                    <td><?php echo $r['no_of_single_bed'] ?></td>
                    <td><?php echo $r['no_of_double_bed'] ?></td>
                    <td><?php echo $r['no_of_accomodate'] ?></td>
                    <td><?php echo $r['features'] ?></td>
                    <td><?php echo $r['amount'] ?></td>
                </tr>
            <?php endwhile; 
			 ?>
            </tbody>
        </table>
<?php 
 }
 else{
     echo "<script> alert('$conn->error'); </script>";
 }} $conn->close();?>
</div>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = 'CALL room_info(111)';
$result = $conn->query($sql);

    $row = $result->fetch_assoc();
?>
    <!-- Booking Room -->
    <form action="customer.php" method="post">
    <div class="container" id="room">
        <div class="row">
          <div class="col-sm">
            <img class="room-image" src="Images/deluxe-1_1920x960.jpg" alt="">
          </div>
          <div class="col-sm">
          <p class="price"><?php echo $row["amount"] ?>/- Per Day</p>
          <p class="text"><?php echo $row["room_name"] ?> Room</p>
          <?php $conn->close(); ?>
            <!-- <input class="book-button" type="button" value="Book Now" name="book" onclick="openForm()"> -->
            <!-- Button trigger modal -->
            <button onclick="location.href='register.php'" type="button" class="book-button">Book Now</button>
          </div>
        </div>
      </div>
      </form>
      <?php
        // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = 'CALL room_info(222)';
$result = $conn->query($sql);

    $row = $result->fetch_assoc();
?>
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <img class="room-image" src="Images/super_deluxe-2_1920x960.jpg" alt="">
          </div>
          <div class="col-sm">
          <p class="price"><?php echo $row["amount"] ?>/- Per Day</p>
          <p class="text"><?php echo $row["room_name"] ?> Room</p>
          <?php $conn->close(); ?>
          <button onclick="location.href='register.php'" type="button" class="book-button">Book Now</button>
          </div>
        </div>
      </div>
      <?php
        // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$var=333;
$sql = "CALL room_info($var)";
$result = $conn->query($sql);

    $row = $result->fetch_assoc();
?>
      <div class="container">
        <div class="row">
          <div class="col-sm">
            <img class="room-image" src="Images/luxury.jpg" alt="">
          </div>
          <div class="col-sm">
          <p class="price"><?php echo $row["amount"] ?>/- Per Day</p>
          <p class="text"><?php echo $row["room_name"] ?> Room</p>
          <?php    ?>
          <button onclick="location.href='register.php'" type="button" class="book-button">Book Now</button>
          </div>
        </div>
      </div>
      
  





   
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>