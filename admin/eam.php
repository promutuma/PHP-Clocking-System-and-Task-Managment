    <h1>Employees</h1> 
    <h3>Active Employees</h3>
    <hr>
     <?php
$sql = "SELECT * FROM `employee` WHERE status = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table class='table table-striped table-hover table-success'><thread><tr row='row'><th scope='col'>Employee ID</th><th scope='col'colspan='2'>Employee Name</th>
  <th scope='col'>Employee Email</th><th scope='col'>Department</th><th scope='col'>View Details</th><th scope='col'>Action</th></tr></thread>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<tr>
  <td><?php echo $row["empID"]; ?></td>
  <td><?php echo $row["surname"]; ?></td>
  <td><?php echo $row["empname"]; ?></td>
  <td><?php echo $row["empemail"]; ?></td>
  <td><?php echo $row["depertment"]; ?></td>
   <td><a href="index.php?viewemp=<?php echo $row['EmpsysID']; ?>" class="btn btn-info"><i class="bi bi-binoculars-fill"></i> View <?php echo $row["surname"]; ?></a></td>
  <td><a href="index.php?editemp=<?php echo $row['EmpsysID']; ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit <?php echo $row["surname"]; ?></a></td>
</tr>
    <?php
    
  }
  echo "</table>";
} else {
  echo "No Employees available";
}
?>
<h3>Suspended Employees</h3>
<hr>
 <?php
$sql = "SELECT * FROM `employee` WHERE status = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table class='table table-striped table-hover table-warning'><thread><tr row='row'><th scope='col'>Employee ID</th><th scope='col'colspan='2'>Employee Name</th>
  <th scope='col'>Employee Email</th><th scope='col'>Department</th><th scope='col'>View Details</th><th scope='col'>Action</th></tr></thread>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<tr>
  <td><?php echo $row["empID"]; ?></td>
  <td><?php echo $row["surname"]; ?></td>
  <td><?php echo $row["empname"]; ?></td>
  <td><?php echo $row["empemail"]; ?></td>
  <td><?php echo $row["depertment"]; ?></td>
   <td><a href="index.php?viewemp=<?php echo $row['EmpsysID']; ?>" class="btn btn-info"><i class="bi bi-binoculars-fill"></i> View <?php echo $row["surname"]; ?></a></td>
  <td><a href="index.php?editemp=<?php echo $row['EmpsysID']; ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit <?php echo $row["surname"]; ?></a></td>
</tr>
    <?php
    
  }
  echo "</table>";
} else {
  echo "No Employees available";
}
?>





