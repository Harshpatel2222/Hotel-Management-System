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
                    <a href="#" class="nav__link  tablink" onclick="openCity('admin', this, 'blue')" id="defaultOpen">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Admin Page</span>
                    </a>

                    
                        <a href="#" class="nav__link tablink" onclick="openCity('booked_room', this, 'blue')">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Booked room</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('add_new_room', this, 'blue')">
                            <!-- <i class='bx bx-user nav__icon' ></i> -->
                            <i class="iconify" data-icon="fluent:conference-room-28-regular" data-inline="false"></i>
                            <span class="nav__name">Add New Room</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('all_room_info', this, 'blue')">
                            <i class='far fa-address-book nav__icon' ></i>
                            <span class="nav__name">All Room Info</span>
                        </a>
                        
                         <a href="#" class="nav__link tablink active" onclick="openCity('customer_info', this, 'blue')">
                            <i class='far fa-user nav__icon' ></i>
                            <span class="nav__name">Customer Info</span>
                        </a>

                        <a href="#" class="nav__link tablink" onclick="openCity('customer_info', this, 'blue')">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">Update Room Info</span>
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

  <!-- Customer Info -->

  
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