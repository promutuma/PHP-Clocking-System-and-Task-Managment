<?php
if ($_GET['viewdep']==True) {
    # code...
    $depid=$_GET['viewdep'];
    $sql = "SELECT * FROM `depertment` WHERE depID =$depid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        $uniquec=$row["depCode"];
        $name=$row["depName"];
        $email=$row["depEmail"];
        $dhead=$row["depHead"];
        $depid=$row['depID'];
    }
}

?>

<div class="card text-center shadow bg-light bg-gradient">
  <div class="card-header">
    <small><i>Code: </i></small><b><?php echo $uniquec;?></b>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $name;?></h5>
    <p class="card-text"><? echo $name ." is headed by ".$dhead;?>
    <hr>
    <small><i>department Email: </i></small><b>
        <?
        echo $email;
        ?>
    </b><br>
    <small><i>Number of Employees: </i></small><b>
        <?
        echo $noemp;
        ?>
    </b>
    </p>
    <hr>
    <a data-bs-toggle="modal" data-bs-target="#editDetails" href="" class="btn btn-warning bg-gradient shadow-sm"><i class="bi bi-pencil"></i> Edit <?php echo $name;?> Department</a><br><br>
    <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="" class="btn btn-danger bg-gradient shadow-sm"><i class="bi bi-trash"></i> Delete <?php echo $name;?> Department</a><br><br>
    <a href="index.php?dep=sec" class="btn btn-primary bg-gradient shadow-sm"><i class="bi bi-arrow-left"></i> Back To Departments</a>
  </div>
  <div class="card-footer text-muted">
    <? echo $sdt;?>
  </div>
</div>

<?php
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Warning</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1>  <i class="bi bi-exclamation-lg"></i></h1>
          
        Do you want to<b> DELETE <?php echo $name ?> Department.</b> If you delete the data will be lost forever and no backup is being provided. You can either edit the details or suspend the account
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-primary bg-gradient shadow-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Do Not Delete</a>
        <a href="../files/include.php?deldep=<?php echo $depid ?>" type="button" class="btn btn-danger bg-gradient shadow-sm"><i class="bi bi-trash-fill"></i> Delete Completely</a>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Edit <?php echo $name ?> Details</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        
        
        
<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success">
 
        <hr>
        <div class="form-group">
        <Label for="username">Department System Code:</Label>        
        <input type="text" name="sysid" class="form-control" value="<?php echo $depid ;?>" readonly="readonly"><br>
        </div>
       <div class="form-group">
        <Label for="username">Department Unique Code:</Label>        
        <input type="text" name="dcode" class="form-control" value="<?php echo $uniquec ;?>"><br>
        <Label for="username">Department Name:</Label>        
        <input type="text" name="dname" class="form-control" value="<?php echo $name ;?>"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">Department Email:</Label>        
        <input type="email" name="demail" class="form-control" value="<?php echo $email ;?>"><br>
       </div>

       <div class="form-group">
        <label for="userpass">Depertment Head:</label>
        <input type="text" name="dhead" id="buslocation" class="form-control" value="<?php echo $dhead ;?>"><br>



<br>
       <div class="form-group">
        
        <button type="submit" value="editdep" name="editdep" class="btn btn-outline-success btn-block btn-lg form-control bg-gradient shadow-sm" >
             <i class="bi bi-folder-plus"></i>  Submit <?php echo $name ?> Details
           </button>
       </div>
       <br>
     
        
    </form>
        
        
        
        
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>