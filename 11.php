<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-mangement-system";


$conn = new mysqli($servername, $username, $password, $dbname);?>  

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
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
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
