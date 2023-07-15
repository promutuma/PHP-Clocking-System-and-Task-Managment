<div class="shadow p-3 mb-5 bg-gradient rounded">
<button class="btn btn-warning shadow-sm bg-gradient" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><i class="bi bi-slash-circle-fill"></i>  All Pending tasks</button>
<button class="btn btn-success shadow-sm bg-gradient" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-stop-circle-fill"></i> Complete Tasks This Month</button>
</div>
<h4><i class="bi bi-bootstrap-reboot"></i> All Active Tasks by Employees</h4>

<?php
    $tsts=1;
                    $sql="SELECT task.taskid, task.taskname, employee.surname, task.startday, task.starttime, task.endday, task.endtime FROM `task` INNER JOIN employee WHERE employee.empID=task.employeeid AND task.status=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("s",$tsts);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {?>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading"><i>Task Name:</i> <?php echo $row['taskname']; ?></h4>
  <p>Employee: <b><?php echo $row['surname']; ?></b> <br>Start Date: <b><?php echo $row['startday']; ?></b><br></p>
  <hr>
  <p class="mb-0"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['taskid']; ?>">
  Edit This Task
</button> </p>
</div>


<?php

}}else{

  ?>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">No active tasks!</h4>
  <p>No active task now.</p>
  <hr>
  <p class="mb-0">Sorry.</p>
</div>


<?php

}


?>






<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel"><i class="bi bi-stop-circle-fill"></i> Tasks Completed This Month</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
<?php
    $tsts=2;
                    $sql="SELECT task.taskid, task.taskname, employee.surname, task.startday, task.starttime, task.endday, task.endtime FROM `task` INNER JOIN employee WHERE employee.empID=task.employeeid AND task.status=? AND MONTH(task.endday)=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$tsts,$thismonth);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <hr>
    <div class="alert alert-success" role="alert">
  <h4>Task Name:<?php echo $row['taskname']; ?></h4><hr> Employee Name: <b><?php echo $row['surname']; ?></b><br> Start Date: <b><?php echo $row['startday']; ?></b><br> Completion Date: <b><?php echo $row['endday']; ?></b><br>
  <button type="button" class="btn btn-primary" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['taskid']; ?>">
  Edit This Task
</button>
   </div>
                   <?php

                    }}else{?>
                      <hr>
   <div class="alert alert-success" role="alert">
  No complete tasks this month
   </div>
                   <?php }

    ?>
  </div>
</div>





<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-slash-circle-fill"></i> All Pending Tasks</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php
    $tsts=0;
                    $sql="SELECT task.taskid, task.taskname, employee.surname, task.startday, task.starttime, task.endday, task.endtime FROM `task` INNER JOIN employee WHERE employee.empID=task.employeeid AND task.status=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("s",$tsts);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <hr>
    <div class="alert alert-warning" role="alert">
  <h4>Task Name:<?php echo $row['taskname']; ?></h4><hr> Employee Name: <b><?php echo $row['surname']; ?></b><br> Start Date: <b><?php echo $row['startday']; ?></b>
  <br><button type="button" class="btn btn-primary" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['taskid']; ?>">
  Edit This Task
</button>
   </div>
                   <?php

                    }}else{?>
                      <hr>
   <div class="alert alert-warning" role="alert">
  No pending tasks
   </div>
                   <?php }

    ?>


   


    
    </div>
  </div>
</div>
<?php
$sql="SELECT * FROM `task`";
                $stmt=$conn->prepare($sql);
                
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {?>


<div class="modal fade" id="exampleModal<?php echo $row['taskid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Task <?php echo $row['taskname']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../files/include.php">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Sys ID:</label>
    <input type="text" name="sysid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['taskid']; ?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Not editable.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Task Name</label>
    <input type="text" name="taskname" class="form-control" id="exampleInputPassword1" value="<?php echo $row['taskname']; ?>">
  </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
        <button type="submit" name="edittask" class="btn btn-primary"><i class="bi bi-cloud-upload"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }}?>