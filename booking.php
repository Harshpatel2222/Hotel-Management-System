<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <style>
body {font-family: "Lato", sans-serif;}

.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content */
.tabcontent {
  color: white;
  display: none;
  padding: 50px;
  text-align: center;
}

#home {background-color:red;}
#personal_info {background-color:green;}
#room_booking {background-color:blue;}
#payment {background-color:orange;}
</style>
</head>
<body>

<div class="content">
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
</div>
<p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

<button class="tablink" onclick="openCity('home', this, 'red')" id="defaultOpen">Home</button>
<button class="tablink" onclick="openCity('personal_info', this, 'green')">Personal Info</button>
<button class="tablink" onclick="openCity('room_booking', this, 'blue')">Room Booking</button>
<button class="tablink" onclick="openCity('payment', this, 'orange')">Payment</button>

<div id="home" class="tabcontent">

</div>

<div id="personal_info" class="tabcontent">
<div class="container">
<form action="booking.php" method="POST">
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
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email">
  </div>
  <div class="form-group">
  <label for="nationality">Nationality:</label>
        <select name="nationality" id="nationality">
    <option value="indian">Indian</option>
    <option value="non_indian">Non Indian</option>
  </select>

  <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['insertdata'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $email=$_POST['email'];
  $contact_no=$_POST['contact_no']; 
  $nationality=$_POST['nationality'];
  $username=htmlspecialchars($_SESSION["username"]);
     
   $query = "INSERT INTO customer (`first_name`,`last_name`,`gender`,`email`,`contact_no`,`nationality`,`username`) VALUES ('$first_name','$last_name','$gender','$email','$contact_no','$nationality','$username')";
   $query_run=mysqli_query($conn,$query);

  if($query_run){
      echo '<script> alert("Data Saved"); </script>';
      header('Location:booking.php');
  }
  else{
      echo '<script> alert("Data Not Saved"); </script>';
  }
}
    
?>

  </div>

  <button type="submit" class="btn btn-primary"  value="submit" name="insertdata">Submit</button>
</form>
</div> 
</div>

<div id="room_booking" class="tabcontent">
  <h1>Tokyo</h1>
  <p>Tokyo is the capital of Japan.</p>
</div>

<div id="payment" class="tabcontent">
  <h1>Oslo</h1>
  <p>Oslo is the capital of Norway.</p>
</div>

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