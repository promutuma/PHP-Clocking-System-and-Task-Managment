    <h1>Departments</h1> 
     <?php
$sql = "SELECT * FROM `depertment`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table class='table table-striped table-hover table-success'><thread><tr row='row'><th scope='col'>Department Unique Code</th><th scope='col'>Department Name</th>
  <th scope='col'>Department Email</th><th scope='col'>Department Head</th><th scope='col'>View Details</th><th scope='col'>Action</th></tr></thread>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<tr>
  <td><?php echo $row["depCode"]; ?></td>
  <td><?php echo $row["depName"]; ?></td>
  <td><?php echo $row["depEmail"]; ?></td>
  <td><?php echo $row["depHead"]; ?></td>
   <td><a href="index.php?viewdep=<?php echo $row['depID']; ?>" class="btn btn-info"><i class="bi bi-search"></i> View <?php echo $row["depCode"]; ?></a></td>
  <td><a href="index.php?editdep=<?php echo $row['depID']; ?>" class="btn btn-warning"><i class="bi bi-cloud-upload"></i> Edit <?php echo $row["depCode"]; ?></a></td>
</tr>
    <?php
    
  }
  echo "</table>";
} else {
  echo "No departments available";
}

?>

