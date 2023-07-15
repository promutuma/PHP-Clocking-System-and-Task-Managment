<?php
if ($_GET['editdep']==True) {
    # code...
    $depid=$_GET['editdep'];
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




<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Edit <?php echo $name ?> Details</h3>
        </div>
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
        
        <button type="submit" value="editdep" name="editdep" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-folder-plus"></i>  Submit <?php echo $name ?> Details
           </button>
       </div>
       <br>
     
        
    </form>



<?php
}