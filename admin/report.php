
<div class=" shadow p-3 mb-5 bg-body rounded">
    <h3>Data Options</h3>
<a data-bs-toggle="modal" data-bs-target="#today"  class="btn btn-success bg-gradient"><i class="bi bi-search"></i> View Today Clock In</a>

<a data-bs-toggle="modal" data-bs-target="#yesterday"  class="btn btn-success bg-gradient"><i class="bi bi-search"></i> View Yesterday</a>

<a data-bs-toggle="modal" data-bs-target="#thisweek"  class="btn btn-info bg-gradient"><i class="bi bi-search"></i> View This Week</a>

<a data-bs-toggle="modal" data-bs-target="#lastweek"  class="btn btn-info bg-gradient"><i class="bi bi-search"></i> View Last Week</a>

<a data-bs-toggle="modal" data-bs-target="#thismonth"  class="btn btn-secondary bg-gradient"><i class="bi bi-search"></i> View This Month</a>

<a data-bs-toggle="modal" data-bs-target="#lastmonth"  class="btn btn-primary bg-gradient"><i class="bi bi-search"></i> View Last Month</a>
<hr>
<a data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"  class="btn btn-primary bg-gradient"><i class="bi bi-search"></i> Select Custom Dates</a>
</div>


<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasTopLabel">Select Start Date and the Last Date then Submit</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form class="row g-3" method="POST" action="index.php?custom=custom">
     <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Start Date</label>
   <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon3">From/</span>
  <input type="date" name="sdate" class="form-control" id="basic-url" aria-describedby="basic-addon3" max="<?php echo $yesterday;?>">
</div>
  </div>
  <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Last Date</label>
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">To/</span>
     <input type="date" name="edate" class="form-control" id="basic-url" aria-describedby="basic-addon3" max="<?php echo $sdt;?>">
      <button type="submit" class="btn btn-primary"><i class="bi bi-minecart-loaded"></i> Submit</button>
</div>

</form>
  </div>
  </div>
</div>



<?php 

$thisweek = date('W');

$lastweek = date('W')-1;

$thisMON = date('m');

$lastMON = date('m')-1;

$yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));







$sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>



    

 <button onclick="exportTableToExcel('tblStocks','All_Employee_Data_As_<?php echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download As Excel File</button>
  

        <table class="table table-warning table-striped table-hover" id="tblStocks">
         


            <thead class="text-nowrap">
              <tr>
                <th colspan="8">All Data</th>
              </tr>

  <tr>

    <th>Clocking Date</th>

    <th>Description / Image</th>

    

    <th>Employee ID</th>

      <th>Employee Name</th>

    <th>Clock In Time</th>

    <th>Clock Out Time</th>

    <th>Total Time Worked</th>

    <th>Clock Out Status</th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?php echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php  echo foo($row['workedTime'])  ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>









<div class="modal fade" id="today" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Today's Clockin Details</h5>
        <button onclick="exportTableToExcel('todayDetails','Clockin_Data_AS_<?php echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download Today As Excel File</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">
          <?php
      $sql="SELECT clockDay, description,clockin.empID,employee.surname AS surname, clockTime FROM clockin INNER JOIN employee ON employee.empID=clockin.empID WHERE clockDay='$sdt'";
      $result= $conn->query($sql);
      if($result->num_rows>0){
          ?>

                <table class="table table-warning table-striped table-hover" id="todayDetails">

            <thead class="text-nowrap">
                            <tr>
                <th colspan="5">Clockin Only Data</th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>
  </tr>
  </thead>
  <tbody>
      
          <tbody>
              <?php
              while($row = mysqli_fetch_assoc($result)){
                  ?>
                  <tr>
                      <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>
                      <td><?php echo $row['description'];?><img src="../employee/eimage/<?php echo  $row['description'];?>" style="width: 50%;" alt="<?php echo  $row['description'];?>"></td>
                      <td><?php echo  $row['empID'];?></td>
                      <td><?php echo  $row['surname'];?></td>
                      <td><?php echo  $row['clockTime'];?></td>
                  </tr>
              <?php }
              ?>
          </tbody>
          <?php
      }
      ?>
  </tbody>
</table>
      </div>

      <div class="modal-footer">

       

      </div>

    </div>

  </div>

</div>





















<div class="modal fade" id="yesterday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Yesterday Clock In and Out Details</h5><br>
        <button onclick="exportTableToExcel('yesDetails','Yesterday_EmployeeData_As_<? echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download Yesterday As Excel File</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        

        

        

   <?php     

        $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE clockin.clockDay = '$yesterday' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    



        <table class="table table-warning table-striped table-hover" id="yesDetails">
           

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">Yesterdays Employee Data On Date <?php echo $sdt;?></th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>

    <th>Clock Out Time: </th>

    <th>Total Time Worked: </th>

    <th>Clock Out Status: </th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php   echo foo($row['workedTime'])  ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>

        

        

        

        

        

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>

</div>



























<div class="modal fade" id="thisweek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">This Week Clock In and Out Details</h5><br>
        <button onclick="exportTableToExcel('thisWeek','thisweek_EmployeeData_As_<?php echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download This Week As Excel File</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        

        

        

   <?php     

        $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE WEEK(clockin.clockDay) = '$thisweek' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    



        <table class="table table-warning table-striped table-hover" id="thisWeek">

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">This week Employee Data On Date <?php echo $sdt;?></th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>

    <th>Clock Out Time: </th>

    <th>Total Time Worked: </th>

    <th>Clock Out Status: </th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?php echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php echo foo($row['workedTime'])  ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>

        

        

        

        

        

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>

</div>





















<div class="modal fade" id="lastweek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Last Week Clock In and Out Details</h5><br>
        <button onclick="exportTableToExcel('lastWeek','lastWeek_EmployeeData_As_<?php echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download Last Week As Excel File</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        

        

        

   <?php     

        $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE WEEK(clockin.clockDay) = '$lastweek' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    



        <table class="table table-warning table-striped table-hover" id="lastWeek">

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">Last Week Employee Data On Date <?php echo $sdt;?></th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>

    <th>Clock Out Time: </th>

    <th>Total Time Worked: </th>

    <th>Clock Out Status: </th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?php echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php echo foo($row['workedTime']) ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>

        

        

        

        

        

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>

</div>





























<div class="modal fade" id="thismonth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">This Month Clockin Details</h5><br>
        <button onclick="exportTableToExcel('thisMonth','thisMonth_EmployeeData_As_<? echo $sdt;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download This Month As Excel File</button>


        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        

        

   <?php     

        $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE MONTH(clockin.clockDay) = '$thisMON' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    



        <table class="table table-warning table-striped table-hover" id="thisMonth">

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">This Month Employee Data On Date <? echo $sdt;?></th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>

    <th>Clock Out Time: </th>

    <th>Total Time Worked: </th>

    <th>Clock Out Status: </th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?php echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php echo foo($row['workedTime']) ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>

        

        

        

        

        

        

        

        

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>

</div>















<div class="modal fade" id="lastmonth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Last Month Employee Clock In and Out Details</h5><br>
        <button onclick="exportTableToExcel('lastmonth','LastMonth_EmployeeData_As_<?php echo $sdt;?>.csv')" class="btn btn-info" ><i class="bi bi-cloud-download"></i> Download As Excel File</button>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">
        
        

        

        

        

        

   <?php     

        $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, 

clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 

AS clockoutdes FROM `clockin` INNER JOIN clockout 

ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE MONTH(clockin.clockDay) = '$lastMON' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    



        <table class="table table-warning table-striped table-hover" id="lastmonth">

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">Last Month Employee Data on Date <?php echo $sdt;?></th>
              </tr>

  <tr>

    <th>Clocking Date:</th>

    <th>Description / Image</th>

    

    <th>Employee ID: </th>

      <th>Employee Name</th>

    <th>Clock In Time: </th>

    <th>Clock Out Time: </th>

    <th>Total Time Worked: </th>

    <th>Clock Out Status: </th>

    

    

  </tr>

  </thead>

  <tbody>

   <?php while ($row = mysqli_fetch_assoc($result)) {?>

  <tr>

      

  <td class="text-nowrap"><?php echo  $row['clockDay'];?></td>

  <td><?php echo $row['clockindes'];?><img src="../employee/eimage/<?php echo  $row['clockindes'];?>" style="width: 50%;" alt="<?php echo  $row['clockindes'];?>"></td>

    

   

  

    

    <td> <?php echo  $row['empID'];?></td>

    

 <td> <?php echo  $row['surname'];?></td>

    

    <td> <?php echo  $row['clockTime'];?></td>

    

  

    <td>  <?php echo  $row['clockoutTime'];?></td>

    

 

    <td>  <?php echo foo($row['workedTime']) ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>

   <?php }?>

  </tbody>

</table>





<?php }?>

        

        

        

        

        

      </div>

      <div class="modal-footer">

        

      </div>

    </div>

  </div>

</div>

