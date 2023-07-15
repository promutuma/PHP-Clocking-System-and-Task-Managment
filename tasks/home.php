<a href="logout.php?logout=logout" class="btn btn-danger position-absolute end-0">
  Log Off <i class="bi bi-lock-fill"></i>
</a>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
  Create Task <i class="bi bi-plus-lg"></i>
</button>

<h2>
  My tasks
</h2>
<hr>

<?php
function changests($sts){
  if ($sts==1) {
    // code...
    $rsts="Suspend the task";
  } else {
    // code...
    $rsts="Continue with the task";
  }
  return $rsts;
}




$empemail=$_SESSION['employeeid'];
$sql="SELECT * FROM `task` WHERE employeeid=? AND NOT STATUS=2";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$empemail);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {



?>

<div class="alert <?php echo taskcolor($row['status']);?> shadow-sm p-3 mb-5 rounded" role="alert">
  <h4><?php echo $row['taskname']; ?></h4>
  <hr>
  Started on: <b><?php echo $row['startday']; ?></b> at <b><?php echo $row['starttime']; ?></b> and the task is <b><?php echo taskstatus($row['status']);?></b> 
  <a class="btn btn-warning position-absolute top-0 end-0" href="../files/include.php?emptCHNG=<?php echo $row['taskid'];?>"><?php echo changests($row['status']);?></a>
  <a class="btn btn-danger position-absolute end-0" href="../files/include.php?emptCOMP=<?php echo $row['taskid'];?>"><i class="bi bi-tv-fill"></i> Mark as complete</a>
</div>
<?php }}else{
?>

<div class="alert alert-primary shadow-sm" role="alert">
  <h4>No tasks today</h4>
  <hr>
  <a href="" data-bs-toggle="modal" data-bs-target="#create">Click me to create new task</a>
</div>
<?php

}

?>

















<!-- Modal -->
<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row gy-2 gx-3 align-items-center" method="POST" action="../files/include.php">
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingInput">Task Name:</label>
    <input type="text" name="taskname" class="form-control" id="autoSizingInput" placeholder="Task Name:">
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingInputGroup">Date</label>
    <div class="input-group">
      <div class="input-group-text"><i class="bi bi-calendar3"></i></div>
      <input type="date" name="date" class="form-control" id="autoSizingInputGroup" placeholder="date">
      <div class="input-group-text"><i class="bi bi-stopwatch"></i></div>
      <input type="time" name="time" class="form-control" id="autoSizingInputGroup" placeholder="time">
    </div>
  </div>
  <div class="col-auto">
    <label class="visually-hidden" for="autoSizingSelect">Preference</label>
    <select name="when" class="form-select" id="autoSizingSelect">
      <option selected>Choose...</option>
      <option value="1">Start Now</option>
      <option value="0">Start Later</option>
      
    </select>
  </div>
 
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="createTask" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Create</button>
      </div>
      </form>
    </div>
  </div>
</div>