    <h1>Users</h1> 

    <h3>Active Users</h3>

    <h4>Human Resource</h4>

     <?php

$sql = "SELECT * FROM `hr` WHERE status = 1";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

  echo "<table class='table table-striped table-hover table-success'><thread><tr row='row'><th scope='col'>User Name</th>

  <th scope='col'>User Email</th><th scope='col'>View Details</th><th scope='col' colspan=2>Action</th></tr></thread>";

  // output data of each row

  while($row = $result->fetch_assoc()) {

    ?>

<tr>

  <td><?php echo $row["userName"]; ?></td>

  <td><?php echo $row["userEmail"]; ?></td>

   <td><a href="index.php?user=0&&viewuser=<?php echo $row['userId']; ?>" class="btn btn-info">View <?php echo $row["userName"]; ?></a></td>

  <td><a href="index.php?user=0&&edituser=<?php echo $row['userId']; ?>" class="btn btn-info">Edit <?php echo $row["userName"]; ?></a></td>

  <td><a href="../files/include.php?user=0&&resetuser=<?php echo $row['userId']; ?>" class="btn btn-danger">Reset Password for <?php echo $row["userName"]; ?></a></td>

</tr>

    <?php

    

  }

  echo "</table>";

} else {

  echo "No users available";

}

?>

 <h4>Receptionist</h4>

     <?php

$sql = "SELECT * FROM `receptionist` WHERE status = 1";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

  echo "<table class='table table-striped table-hover table-success'><thread><tr row='row'><th scope='col'>User Name</th>

  <th scope='col'>User Email</th><th scope='col'>View Details</th><th scope='col' colspan=2>Action</th></tr></thread>";

  // output data of each row

  while($row = $result->fetch_assoc()) {

    ?>

<tr>

  <td><?php echo $row["userName"]; ?></td>

  <td><?php echo $row["userEmail"]; ?></td>

   <td><a href="index.php?user=1&&viewuser=<?php echo $row['userId']; ?>" class="btn btn-info">View <?php echo $row["userName"]; ?></a></td>

  <td><a href="index.php?user=1&&edituser=<?php echo $row['userId']; ?>" class="btn btn-warning">Edit <?php echo $row["userName"]; ?></a></td>

  <td><a href="../files/include.php?user=1&&resetuser=<?php echo $row['userId']; ?>" class="btn btn-danger">Reset Password for <?php echo $row["userName"]; ?></a></td>

</tr>

    <?php

    

  }

  echo "</table>";

} else {

  echo "No users available";

}

?>







<hr>



<h3>Suspended Users</h3>

<h4>Human Resource</h4>

     <?php

$sql = "SELECT * FROM `hr` WHERE status = 0";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

  echo "<table class='table table-striped table-hover table-warning'><thread><tr row='row'><th scope='col'>User Name</th>

  <th scope='col'>User Email</th><th scope='col'>View Details</th><th scope='col' colspan=2>Action</th></tr></thread>";

  // output data of each row

  while($row = $result->fetch_assoc()) {

    ?>

<tr>

  <td><?php echo $row["userName"]; ?></td>

  <td><?php echo $row["userEmail"]; ?></td>

   <td><a href="index.php?user=0&&viewuser=<?php echo $row['userId']; ?>" class="btn btn-info">View <?php echo $row["userName"]; ?></a></td>

  <td><a href="index.php?user=0&&edituser=<?php echo $row['userId']; ?>" class="btn btn-info">Edit <?php echo $row["userName"]; ?></a></td>

  <td><a href="../files/include.php?user=0&&resetuser=<?php echo $row['userId']; ?>" class="btn btn-danger">Reset Password for <?php echo $row["userName"]; ?></a></td>

</tr>

    <?php

    

  }

  echo "</table>";

} else {

  echo "No users available";

}

?>

 <h4>Receptionist</h4>

     <?php

$sql = "SELECT * FROM `receptionist` WHERE status = 0";

$result = $conn->query($sql);



if ($result->num_rows > 0) {

  echo "<table class='table table-striped table-hover table-warning'><thread><tr row='row'><th scope='col'>User Name</th>

  <th scope='col'>User Email</th><th scope='col'>View Details</th><th scope='col' colspan=2>Action</th></tr></thread>";

  // output data of each row

  while($row = $result->fetch_assoc()) {

    ?>

<tr>

  <td><?php echo $row["userName"]; ?></td>

  <td><?php echo $row["userEmail"]; ?></td>

   <td><a href="index.php?user=1&&viewuser=<?php echo $row['userId']; ?>" class="btn btn-info">View <?php echo $row["userName"]; ?></a></td>

  <td><a href="index.php?user=1&&edituser=<?php echo $row['userId']; ?>" class="btn btn-info">Edit <?php echo $row["userName"]; ?></a></td>

  <td><a href="../files/include.php?user=1&&resetuser=<?php echo $row['userId']; ?>" class="btn btn-danger">Reset Password for <?php echo $row["userName"]; ?></a></td>

</tr>

    <?php

    

  }

  echo "</table>";

} else {

  echo "No users available";

}

?>

