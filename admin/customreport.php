
<div class=" shadow p-3 mb-5 bg-body rounded">
    <h3>Data Options</h3>

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
  <input type="date" name="sdate" class="form-control" id="basic-url" aria-describedby="basic-addon3" max="<?echo $yesterday;?>">
</div>
  </div>
  <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Last Date</label>
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">To/</span>
     <input type="date" name="edate" class="form-control" id="basic-url" aria-describedby="basic-addon3" max="<?echo $sdt;?>">
      <button type="submit" class="btn btn-primary"><i class="bi bi-minecart-loaded"></i> Submit</button>
</div>

</form>
  </div>
  </div>
</div>
<?php

if(isset($_POST['sdate'])){
if(empty($_POST['sdate']||empty($_POST['edate']))){
    header("index.php?Error=Dates cannot be empty.report=report");
}else{
    $startd=$_POST['sdate'];
    $endd=$_POST['edate'];
    
    
     $sql = "SELECT employee.empID, employee.surname, clockin.clockDay, clockin.clockTime, clockout.clockTime AS clockoutTime,clockout.workedTime ,clockin.description AS clockindes, clockout.description 
AS clockoutdes FROM `clockin` INNER JOIN clockout 
ON clockout.clockinID = clockin.clockinID INNER JOIN employee ON employee.empID = clockin.empID WHERE clockin.clockDay >= '$startd' AND clockin.clockDay <= '$endd' ORDER BY clockin.clockDay DESC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        ?>

    

<button onclick="exportTableToExcel('customtable','EmployeeData_From_<?php echo $startd;?>_to_<?php echo $endd;?>.csv')" class="btn btn-info"><i class="bi bi-cloud-download"></i> Download As Excel File</button>

        <table class="table table-warning table-striped table-hover" id="customtable">
           

            <thead class="text-nowrap">
                            <tr>
                <th colspan="8">Employee Data From <?php echo $startd;?> to <?php echo $endd;?></th>
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

    

 

    <td>  <?php   echo foo($row['workedTime'])  ;?></td>

    

  

    

    <td>  <?php echo  $row['clockoutdes'];?></td>

    

  </tr>
<?php }?>


  </tbody>

</table>
<?php }else{ 
    ?>
    <div class="alert alert-danger" role="alert">
  No custom dates selected. Please make sure you have selected both start and end date.
  <hr>Go back to
      <a class="nav-link  " href="index.php?report=report"> All Employees Report Monthly</a>
</div>
    <?php
}
    
   
    }
}
?>