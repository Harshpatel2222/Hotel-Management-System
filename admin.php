<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";


$conn = new mysqli($servername, $username, $password, $dbname);?>   
 

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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Income', 'Expenses'],
          <?php
           
           $sql = "SELECT sum(amount) AS loss,date from revenue where revenue_type='expense' group by date";
           $result = $conn->query($sql);
           
         
         $sql = "SELECT sum(amount) AS profit,date from revenue where revenue_type='income'  group by date";
           $result1 = $conn->query($sql);
            
          
        while($r = $result1->fetch_assoc()){
            $rr = $result->fetch_assoc();
echo "['".$r['date']."',".$r['profit'].",".$rr['loss']."],";
}
?> 
]);

        var options = {
          title: 'Total Revenue',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Room Status', 'No of Room'],
         <?php   $sql = "SELECT COUNT(check_out) AS booked from room_status where check_out>=CURRENT_DATE";

$result = $conn->query($sql);
  $r = $result->fetch_assoc();
$booked=$r['booked'];
$sql = "SELECT COUNT(check_out) AS non_booked from room_status where check_out<CURRENT_DATE";

$result = $conn->query($sql);
  $r = $result->fetch_assoc();
$non_booked=$r['non_booked'];?>
          
          ['Booked Room',     <?php echo $booked ?>],
          ['Available Room',      <?php echo $non_booked ?>]
          
        ]);

        var options = {
          title: 'Current Room Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      



    </script>
  
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

                        <a href="#" class="nav__link tablink" onclick="openCity('employee', this, 'blue')">
                            <i class='far fa-id-card nav__icon' ></i>
                            <span class="nav__name">Employee</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('employee_attendence', this, 'blue')">
                            <i class='fas fa-fingerprint nav__icon' ></i>
                            <span class="nav__name">Employee Attendence</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('expenses', this, 'blue')">
                            <i class='fas fa-hand-holding-usd nav__icon' ></i>
                            <span class="nav__name">Add Expenses</span>
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
    <div class="row">
    <div class="col-md-6">
    <div id="piechart" style="width: 800px; height: 500px;"></div>
    </div>
    <div class="col-md-6">
    <div id="curve_chart" style="width: 800px; height: 500px;"></div>
  </div>
</div>   
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

<!-- Employee -->

<div id="employee" class="tabcontent">
<div class="container">
<h2>Add New Employee</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" class="form-control" id="first_name"  placeholder="First Name" name="first_name">
  </div>
  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
  </div>
  <div class="form-group">
  <label for="gender">Gender:</label>
        <select name="gender" id="Gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select>
  </div>
  <div class="form-group">
    <label for="contact_no">Contact No</label>
    <input type="text" class="form-control" id="contact_no" placeholder="Contact No" name="contact_no">
  </div>
  <div class="form-group">
    <label for="department">Department</label>
    <input type="text" class="form-control" id="department" placeholder="Department" name="department">
  </div>
  <div class="form-group">
    <label for="salary">Salary Per Month</label>
    <input type="text" class="form-control" id="salary" placeholder="Salary" name="salary">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="insert_employee" >Add</button>
<br>
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
if(isset($_POST['insert_employee'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $contact_no=$_POST['contact_no']; 
  $department=$_POST['department'];
  $salary=$_POST['salary'];
  
     
   $query = "INSERT INTO employee (`first_name`,`last_name`,`gender`,`contact_no`,`department`,`salary`) VALUES ('$first_name','$last_name','$gender','$contact_no','$department','$salary')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Personal Information Added."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
<!-- Show all employee -->

    <br>
    <button type="submit" class="btn btn-primary"  value="submit" name="show_employee" >Show All Employee Details</button>
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
if(isset($_POST['show_employee'])){
  
$sql = "CALL show_all_employee_to_admin()";
$result = $conn->query($sql);   
   
?>
  
<br>  
<table class="table table-striped table-light table-bordered">
          <thead class="thead-dark"><tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Contact No</th>
                <th>Department</th>
                <th>Salary Per Month</th>
                
                
            </tr></thead>
            
            <tbody>
            <?php while ($r = $result->fetch_array()): ?>
                <tr>
                  <th scope="row"><?php echo $r['employee_id'] ?></th>
                    <td><?php echo $r['first_name'] ?></td>
                    <td><?php echo $r['last_name'] ?></td>
                    <td><?php echo $r['gender'] ?></td>
                    <td><?php echo $r['contact_no'] ?></td>
                    <td><?php echo $r['department'] ?></td>
                    <td><?php echo $r['salary'] ?></td>
                    
                   
                </tr>
            <?php endwhile; 
			$conn->close(); } ?>
            </tbody>
        </table>


  </div>
  </div>
  
  <!-- Employee Attendence -->
  <div id="employee_attendence" class="tabcontent">
  <div class="container">
  <h2>Enter Employee ID to mark Attendence</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="employee_id">Employee ID</label>
    <input type="text" class="form-control" id="employee_id"  placeholder="Employee ID" name="employee_id">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="employee_attendence" >Add</button>
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
if(isset($_POST['employee_attendence'])){
  $employee_id=$_POST['employee_id'];
    
   $query = "INSERT INTO employee_attendence (`employee_id`) VALUES ('$employee_id')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Attendence Done."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
<br>
<br>
<br>
<h2>Enter Date to show Employee Attendence</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="date">Date</label>
    <input type="text" class="form-control" id="date"  placeholder="Date" name="date">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="show_attendence" >Show</button>
  </form>
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
if(isset($_POST['show_attendence'])){
  $date = strtotime($_POST['date']);
  $da= date('Y-m-d', $date );

  $sql = "CALL show_attendence_of_employee('$da')";
  $result = $conn->query($sql);
    
      if($result){
  ?>
    
  <br>   
  <table class="table table-striped table-light table-bordered">
            <thead class="thead-dark"><tr>
                  <th>Employee ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Department</th>
                  
                  
              </tr></thead>
              
              <tbody>
              <?php while ($r = $result->fetch_array()): ?>
                  <tr>
                    <th scope="row"><?php echo $r['employee_id'] ?></th>
                      <td><?php echo $r['first_name'] ?></td>
                      <td><?php echo $r['last_name'] ?></td>
                      <td><?php echo $r['department'] ?></td>
                      
                     
                  </tr>
              <?php endwhile; 
        $conn->close(); ?>
              </tbody>
          </table>
  <?php 
   }
   else{
     
       echo "<script> alert('$conn->error'); </script>";
      
   }} ?>
  </div>
  </div>

          
<div id="expenses" class="tabcontent">
<div class="container">
    <h2>Add Expenses</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <br>
  <div class="form-group">
    <label for="expense_name">Name</label>
    <input type="text" class="form-control" id="expense_name"  placeholder="Expense Name" name="expense_name">
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" class="form-control" id="amount"  placeholder="Amount" name="amount">
  </div>
  <button type="submit" class="btn btn-primary"  value="submit" name="add_expenses" >Add</button>
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
if(isset($_POST['add_expenses'])){
  $expense_name=$_POST['expense_name'];
  $amount=$_POST['amount'];
  $expense="expense";
    
   $query = "INSERT INTO revenue (`revenue_type`,`expense_name`,`amount`) VALUES ('$expense','$expense_name','$amount')";
   $query_run=mysqli_query($conn,$query);
   

  if($query_run){
      echo '<script> alert("Expense Added."); </script>';
      // header('Location:booking.php');
  }
  else{
    
       echo "<script> alert('$conn->error'); </script>" ;
      
     
  }
  $conn->close();
}

?>
</div>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>