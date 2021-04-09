<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">
        
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>  
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> 
        <title>Sidebar menu responsive</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/img/admin.jfif" alt="Admin">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <div class="nav__list">
                    <a href="#" class="nav__link active tablink" onclick="openCity('admin', this, 'blue')" id="defaultOpen">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Admin Page</span>
                    </a>

                    
                        <a href="#" class="nav__link tablink" onclick="openCity('booked_room', this, 'blue')">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Booked room</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('all_room_info', this, 'blue')">
                            <i class='far fa-address-book nav__icon' ></i>
                            <span class="nav__name">All Room Info</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('add_new_room', this, 'blue')">
                            <!-- <i class='bx bx-user nav__icon' ></i> -->
                            <i class="iconify" data-icon="fluent:conference-room-28-regular" data-inline="false"></i>
                            <span class="nav__name">Add New Room</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('update_room_info', this, 'blue')">
                        <i class="iconify" data-icon="dashicons:update" data-inline="false"></i>
                            <span class="nav__name">Update Room Info</span>
                        </a>
                        
                         <a href="#" class="nav__link tablink" onclick="openCity('customer_info', this, 'blue')">
                            <i class='far fa-user nav__icon' ></i>
                            <span class="nav__name">Customer Info</span>
                        </a>

                        

                        <!--<a href="#" class="nav__link">
                            <i class='bx bx-folder nav__icon' ></i>
                            <span class="nav__name">Data</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                            <span class="nav__name">Analytics</span>
                        </a>  -->
                    </div>
                </div>

                <a href="#" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        
<div id="admin" class="tabcontent">
    <h1>Welcome To Admin Page</h1>
  </div>
  
  <!-- Booked Room -->
  <div id="booked_room" class="tabcontent">
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
$sql = "CALL showing_booked_room_info_to_admin_for_payment_status_1()";
$result = $conn->query($sql);   
   
?>
  
<br>
<h2>Payment Done</h2>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Room No</th>
                <th>Check-in-date</th>
                <th>Check-out-date</th>
                <th>Customer ID</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['customer_id'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); ?>
            </tbody>
        </table>

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
$sql = "CALL showing_booked_room_info_to_admin_for_payment_status_0()";
$result = $conn->query($sql);   
   
?>
  
<br>
<h2>Payment Not Done</h2>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Room No</th>
                <th>Check-in-date</th>
                <th>Check-out-date</th>
                <th>Customer ID</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['room_no'] ?></th>
                    <td><?php echo $r['check_in'] ?></td>
                    <td><?php echo $r['check_out'] ?></td>
                    <td><?php echo $r['customer_id'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); ?>
            </tbody>
        </table>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label >Enter Room No and Check-out-date to cancel Booked Room.</label>
   </div>  
  <div class="form-group">
    <label for="room_no">Room No:</label>
    <input type="text" name="room_no"  placeholder="Room No" >
   </div>  
   <div class="form-group">
    <label for="check_out">Check-out-date:</label>
    <input type="text" name="check_out"  placeholder="Check-out-date" >
   </div>  
  <button type="submit" class="btn btn-primary"  value="submit" name="delete" >Cancel Booking</button>
  </form>
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
  if(isset($_POST['delete'])){
  $room_no = $_POST['room_no'];
  $check_out = $_POST['check_out'];
//   echo gettype($check_out);
//   echo $check_out;
  $sql = "CALL cancel_booked_room('$room_no','$check_out')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("booking cancellation done."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();   
  

  ?>


    </div>

    
  <!-- Add new Room -->
  <div id="add_new_room" class="tabcontent">
    <h2>Create New Room</h2>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
  <label for="room_code">Room Name</label>
        <select name="room_code" id="room_code">
    <option value="111">Delux</option>
    <option value="222">Super Delux</option>
    <option value="333">Luxury</option>
  </select>
</div>
    <div class="form-group">
    <label for="room_no">Room No</label>
    <input type="text" name="room_no" id="">            
    </div>
    <div class="form-group">
    <label for="floor_no">Floor No</label>
    <input type="text" name="floor_no" id="">            
    </div>
    <div class="form-group">
    <label for="features">Features</label>
    <input type="text" name="features" id="">            
    </div>
    <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" id="">            
    </div>
    
  <button type="submit" class="btn btn-primary"  value="submit" name="add_room" >Create</button>
  </form>
    
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
  if(isset($_POST['add_room'])){
  $room_code = $_POST['room_code'];
  $room_no = $_POST['room_no'];
  $floor_no = $_POST['floor_no'];
  $features = $_POST['features'];
  $amount = $_POST['amount'];
 
  $sql = "INSERT INTO room VALUES ('$room_no','$floor_no','$room_code','$features','$amount')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Added New Room."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();   
  

  ?>

<br>
  <h2>Delete Room</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
    <label for="room_no">Room No</label>
    <input type="text" name="room_no" id="">            
    </div>

    <button type="submit" class="btn btn-primary"  value="submit" name="delete_room" >Delete</button>
  </form>
    
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
  if(isset($_POST['delete_room'])){
  $room_no = $_POST['room_no'];
 
  $sql = "CALL delete_room_from_admin('$room_no')";
  $query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Room deleted."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();   
  

  ?>

  </div>


  <!-- ALL Room Info -->
  <div id="all_room_info" class="tabcontent">
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
$sql = "CALL showing_all_room_info_to_admin()";
$result = $conn->query($sql);   
   
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
			$conn->close(); ?>
            </tbody>
        </table>
  </div>

<!-- Update Room Info -->
<div id="update_room_info" class="tabcontent">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <h2>Enter details to update Room Info</h2>
    <div class="form-group">
    <label for="room_no">Room No</label>
    <input type="text" name="room_no" id="">            
    </div>
    <div class="form-group">
    <label for="room_name">Room Name</label>
    <input type="text" name="room_name" id="">            
    </div>
    <div class="form-group">
    <label for="floor_no">Floor No</label>
    <input type="text" name="floor_no" id="">            
    </div>
    <div class="form-group">
    <label for="features">Features</label>
    <input type="text" name="features" id="">            
    </div>
    <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" id="">            
    </div>
    
  <button type="submit" class="btn btn-primary"  value="submit" name="update_room_info" >Submit</button>
  </form>
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
if(isset($_POST['update_room_info'])){
  $room_no= $_POST['room_no'];
  $room_name= $_POST['room_name'];
  $floor_no= $_POST['floor_no'];
  $features= $_POST['features'];
  $amount= $_POST['amount'];
$sql = "CALL update_room_info_by_admin('$room_no','$floor_no','$room_name','$features','$amount')";
$query_run=mysqli_query($conn,$sql);

  if($query_run){
      echo '<script> alert("Updated the Room Info."); </script>';   
      
  }
  else{
    
      echo "<script> alert('$conn->error'); </script>";
     
  }
}
$conn->close();?>

  </div>


  <!-- Customer Info -->

  <div id="customer_info" class="tabcontent">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
  <h2>Enter customer ID to show customer deatils</h2>
    <div class="form-group">
    <label for="customer_id">Customer ID</label>
    <input type="text" name="customer_id" id="">            
    </div>
    <button type="submit" class="btn btn-primary"  value="submit" name="show" >Show</button>
  </form>

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
if(isset($_POST['show'])){
  $customer_id= $_POST['customer_id'];
$sql = "CALL showing_customer_details_to_admin('$customer_id')";
$result = $conn->query($sql);   
if($result){
 

?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Nationality</th>
                <th>Username</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['customer_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['email'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['nationality'] ?></td>
                    <td><?php echo $r['username'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } 
        
  
    
    else{
    
      echo "<script> alert('$conn->error'); </script>";
     
    }}?>
            </tbody>
        </table>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
        <br>
        <button type="submit" class="btn btn-primary"  value="submit" name="show_all" >Show All Customer Details</button>
        </form>

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
if(isset($_POST['show_all'])){
  
$sql = "CALL showing_all_customer_details_to_admin()";
$result = $conn->query($sql);   
   
?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Nationality</th>
                <th>Username</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['customer_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['email'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['nationality'] ?></td>
                    <td><?php echo $r['username'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } ?>
            </tbody>
        </table>
  </div>
  
  

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>
        <script>
            function openCity(cityName,elmnt,color) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablink");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
              }
              document.getElementById(cityName).style.display = "block";
              elmnt.style.backgroundColor = color;
            
            }
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
            </script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>