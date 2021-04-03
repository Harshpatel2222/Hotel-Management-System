<?php
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['insertdata'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $gender=$_POST['gender'];
  $email=$_POST['email'];
  $contact_no=$_POST['contact_no']; 
  $adhar_id=$_POST['adhar_id'];
  $nationality=$_POST['nationality'];

     
   $query = "INSERT INTO customer (`first_name`,`last_name`,`gender`,`email`,`contact_no`,`adhar_id`,`nationality`) VALUES ('$first_name','$last_name','$gender','$email','$contact_no','$adhar_id','$nationality')";
   $query_run=mysqli_query($conn,$query);

  if($query_run){
      echo '<script> alert("Data Saved"); </script>';
      header('Location:customer.php');
  }
  else{
      echo '<script> alert("Data Not Saved"); </script>';
  }
}
    
?> 