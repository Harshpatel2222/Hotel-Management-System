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
  <div class="container check">
    <span class="date">Check-in Date</span>
    <input class="date-1" type="date" name="check-in-date" id="">
    <span class="date">check-out Date</span>
    <input class="date-1" type="date" name="check-out-date" id="">
    <button class="check-button" type="submit">Check Avability</button>
    
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
            <button class="book-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Book now</button>
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
            <button class="book-button">Book now</button>
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

$sql = 'CALL room_info(333)';
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
          <?php $conn->close(); ?>
            <button class="book-button">Book now</button>
          </div>
        </div>
      </div>

      


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">Personal Infromation <hr>
         First Name <br>
        <input type="text" name="first_name" id=""> <br>
        Last Name <br>
        <input type="text" name="last_name" id=""> <br>
        <br>
        <label for="gender">Gender:</label>
        <select name="gender" id="Gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select> <br>
        Contact No. <br>
        <input type="text" name="contact_no" id=""> <br>
        Email Adress <br>
        <input type="email" name="email" id=""> <br>
        Adhar ID <br>
        <input type="text" name="ahdar_id" id=""> <br>
        <br>
        <label for="nationality">Nationality:</label>
        <select name="nationality" id="nationality">
    <option value="indian">Indian</option>
    <option value="non_indian">Non Indian</option>
  </select> <br>
  </div>
  <div class="col-md-6 ml-auto">Booking Information
      <hr>
      <label for="type_of_room">Type Of Room:</label>
        <select name="type_of_room" id="type_of_room">
    <option value="delux">Delux</option>
    <option value="super_delux">Super_delux</option>
    <option value="luxury">Luxury</option>
  </select> <br>
  <label for="feature">Feature:</label>
        <select name="feature" id="feature">
    <option value="">Delux</option>
    <option value="super_delux">Super_delux</option>
    <option value="luxury">Luxury</option>
  </select> <br>
  </div> 
      </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

      
      
      

      

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>