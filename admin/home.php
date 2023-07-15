<?php
$workmonth="576000";

      $sql = "SELECT COUNT(taskid) as pending FROM `task` WHERE task.status='0'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $Tpending= $row['pending']; 

            }

          }


          $sql = "SELECT COUNT(taskid) as active FROM `task` WHERE task.status='1'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $Tactive= $row['active']; 

            }

          }


      $sql = "SELECT COUNT(taskid) as complete FROM `task` WHERE task.status='2' AND task.endday='$sdt'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $Tcomplete= $row['complete']; 

            }

          }





      $sql = "SELECT COUNT(`clockinID`) AS clockedin from clockin WHERE clockDay = '$sdt'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $clockedinToday= $row['clockedin']; 

            }

          }



$sql = "SELECT COUNT(`clockinID`) AS clockedout from clockout WHERE clockDay = '$sdt'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

      

          $clockedoutToday= $row['clockedout']; 

            }

          }

          

          

$sql = "SELECT COUNT(`EmpsysID`) AS empno from employee";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $empno= $row['empno']; 

          

            }

          }


$sql = "SELECT COUNT(clockin.clockinID) AS late FROM clockin WHERE clockin.clockTime>'08:15:00' AND clockin.clockDay='$sdt'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $late= $row['late']; 

          

            }

          }

$sql = "SELECT COUNT(`EmpsysID`) AS suspe from employee WHERE employee.status=0";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

      

          $sus= $row['suspe']; 

          

            }

          }











$notworking =$empno-$clockedinToday;

$working=$empno-$notworking;

$early=$working-$late;
$offduty=$notworking-$sus;

          

?>


 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Number of Tasks'],
          ['Active Tasks',     <?php echo  $Tactive;?>],
          ['Pending Tasks',       <?php echo  $Tpending;?>],
          ['Completed Tasks today',  <?php echo  $Tcomplete;?>],
          
        ]);

        var options = {
          title: 'Employee Tasks',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3dtask'));
        chart.draw(data, options);
      }
    </script>





    

    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load("current", {packages:["corechart"]});

      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Status', 'Number of Employees'],
          ['Clocked in early',     <?php echo  $early;?>],
          ['Clocked in Late',     <?php echo  $late;?>],
          ['Off duty',      <?php echo  $offduty;?>],
          ['Clocked Out',      <?php echo  $clockedoutToday;?>],
           ['Suspended Employee',      <?php echo  $sus;?>],

          

          

          

        ]);



        var options = {

          title: 'Employee Status Today',

          is3D: true,

        };



        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        chart.draw(data, options);

      }

    </script>

    

     <?php
            $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime FROM `clockin` INNER JOIN employee ON employee.empID = clockin.empID WHERE clockin.clockTime > '08:15:59'
            AND clockin.clockDay = '$sdt'
            ";
      $result = $conn->query($sql);
      
        ?>
    
    




      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Day','Clockin Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
       
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['clockDay'];?>','<?php echo $row['clockTime'];?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }

    </script>
    
    
    
      <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='1' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
    
    




      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time',],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
       
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('jan'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
       <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='2' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
      
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('feb'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='3' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
        
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('mar'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='4' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
       
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('apr'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='5' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
        
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('may'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='6' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
        
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('jun'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='7' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('jul'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
      <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='8' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
        
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('aug'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='9' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
      
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('sep'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='10' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
     
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('oct'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='11' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
     
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('nov'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
     <?php
            $sql = "SELECT clockout.empID, employee.surname, SUM(workedTime) AS totaltime FROM clockout INNER JOIN employee on employee.empID=clockout.empID WHERE month(clockDay)='12' GROUP BY clockout.empID
            ";
      $result = $conn->query($sql);
      
        ?>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      google.visualization.drawToolbar()

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        
        
        var data = google.visualization.arrayToDataTable([
       ['Employee ID', 'Employee Surname','Total Worked Time (Sec)','Converted Total Time'],
       <?php 
       if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
      
        ?>
       ['<?php echo $row['empID'];?>', '<?php echo $row['surname'];?>','<?php echo $row['totaltime'];?>','<?php echo foo($row['totaltime']);?>'],
       
           <?php
       }}else{?>
           ['<?php echo "Null ID";?>', '<?php echo "Null Employee Name";?>','No Data','No Data']<?php
       }
       
       ?>
       ],false); // 'false' means that the first row contains labels, not data.
        

        var table = new google.visualization.Table(document.getElementById('dec'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
        
      }

    </script>
    
    
    
    
    
     <div class="row">
    <div class="col">
       <div id="piechart_3d" style="width: 500px; height: 350px;"></div>
    </div>
    <div class="col">
      <div id="piechart_3dtask" style="width: 500px; height: 350px;"></div>
    </div>
  </div> 
  

    
   
     
   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Delayed Clockin Today</h4>
   <div id="table_div"></div>
  
   
   </div>
   


   
   
 <h4>Total Time Per Employee per Month</h4>  
<ul class="nav nav-tabs" id="myTab" role="tablist">
    
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="jan-tab" data-bs-toggle="tab" data-bs-target="#jan" type="button" role="tab" aria-controls="jan" aria-selected="true">Jan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#feb" type="button" role="tab" aria-controls="feb" aria-selected="false">Feb</button>
  </li>
<li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#mar" type="button" role="tab" aria-controls="mar" aria-selected="false">Mar</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#apr" type="button" role="tab" aria-controls="apr" aria-selected="false">Apr</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#may" type="button" role="tab" aria-controls="may" aria-selected="false">May</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#jun" type="button" role="tab" aria-controls="jun" aria-selected="false">Jun</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#jul" type="button" role="tab" aria-controls="jul" aria-selected="false">Jul</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#aug" type="button" role="tab" aria-controls="aug" aria-selected="false">Aug</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#sep" type="button" role="tab" aria-controls="sep" aria-selected="false">Sep</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#oct" type="button" role="tab" aria-controls="oct" aria-selected="false">Oct</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#nov" type="button" role="tab" aria-controls="nov" aria-selected="false">Nov</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="feb-tab" data-bs-toggle="tab" data-bs-target="#dec" type="button" role="tab" aria-controls="dec" aria-selected="false">Dec</button>
  </li>
</ul>

<div class="tab-content shadow" id="myTabContent">
  <div class="tab-pane fade show active" id="jan" role="tabpanel" aria-labelledby="home-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Jan</h4>
   
   <div id="Jan"></div>
   </div></div>
  
  <div class="tab-pane fade" id="feb" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Feb</h4>
   
   <div id="feb"></div>
   </div></div>
   
     <div class="tab-pane fade" id="mar" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Mar</h4>
   
   <div id="mar"></div>
   </div></div>
   
     <div class="tab-pane fade" id="apr" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Apr</h4>
   
   <div id="apr"></div>
   </div></div>
   
     <div class="tab-pane fade" id="may" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>May</h4>
   
   <div id="may"></div>
   </div></div>
   
     <div class="tab-pane fade" id="jun" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Jun</h4>
   
   <div id="jun"></div>
   </div></div>
   
     <div class="tab-pane fade" id="jul" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Jul</h4>
   
   <div id="jul"></div>
   </div></div>
   
     <div class="tab-pane fade" id="aug" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Aug</h4>
   
   <div id="aug"></div>
   </div></div>
   
     <div class="tab-pane fade" id="sept" role="tabpanel" aria-labelledby="sep">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Sep</h4>
   
   <div id="sep"></div>
   </div></div>
   
     <div class="tab-pane fade" id="oct" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Oct</h4>
   
   <div id="oct"></div>
   </div></div>
   
        <div class="tab-pane fade" id="nov" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Nov</h4>
   
   <div id="nov"></div>
   </div></div>
   
        <div class="tab-pane fade" id="dec" role="tabpanel" aria-labelledby="profile-tab">   <div class="shadow p-3 mb-5 bg-body rounded"><h4>Dec</h4>
   
   <div id="dec"></div>
   </div></div>

    

    

      



     

