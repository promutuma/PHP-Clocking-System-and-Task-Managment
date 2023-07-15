<?php
if ($_GET['viewuser']==True) {
    $usertypeN=$_GET['user'];
    $user=$_GET['viewuser'];
    
    
    if($usertypeN==0){
        $sql = "SELECT * FROM `hr` WHERE userId = $user";
        $result = $conn->query($sql);

         if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
             $username=$row['userName'];
             $email=$row['userEmail'];
             $regdate=$row['dateofreg'];
             $regtime=$row['Time_of_reg'];
             $status=$row['status'];
             $userty="Human Resource Manager";
             $usertype="hr";
             $type=0;
             $userty1="Receptionist";
             $usertype1="receptionist";
            
         }}
    }
    else
    {
        $sql = "SELECT * FROM `receptionist` WHERE userId = $user";
        $result = $conn->query($sql);

         if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
             $username=$row['userName'];
             $email=$row['userEmail'];
             $regdate=$row['dateofreg'];
             $regtime=$row['Time_of_reg'];
             $status=$row['status'];
             $userty="Receptionist";
             $usertype="receptionist";
             $userty1="Human Resource Manager";
             $usertype1="hr";
             $type=1;
         }}
    }
  if($status==0){
    $accouts="Suspended";
    $table="table-warning";
    $btnvalue="Activate ";
}
else{
    $accouts="Active";
     $table="table-success";
     $btnvalue="Suspend ";
} 
    

  ?>
<table class="table table-striped table-sm shadow-lg p-3 mb-5 bg-body rounded <? echo $table;?>">
    <thead class="text-center">
    <tr>
        <a href="index.php?uam=uam" class="link-primary"><i class="bi bi-arrow-return-left"></i> Back to other users</a> | 
        
    <td colspan=3><b><h3><?php echo $userty; ?></h3></b></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><small><i>User Name:</i></small></td>
    <td colspan=2><b><h5><?php echo $username; ?></h5></b></td>
  </tr>
  <tr>
    <td  rowspan=6><img src="../files/sysphoto/user.png" class="figure-img img-fluid mx-auto d-block" alt="<?php echo $username; ?>" style="width:40%;"></td>
    <td><small><i>User Email:</i></small></td>
    <td><b><h5><?php echo $email; ?></h5></b></td>
    
  </tr>
  <tr>
    <td><small><i>Date of Registration:</i></small></td>
    <td><b><h5><?php echo $regdate; ?></h5></b></td>
    
  </tr>
  <tr>
    <td><small><i>Time of Registration:</i></small></td>
    <td><b><h5><?php echo $regtime; ?></h5></b></td>
    
  </tr>
  <tr>
    <td><small><i>Last Login:</i></small></td>
    <td><b><h5><?php  ?></h5></b></td>
    
  </tr>
  <tr>
    <td><small><i>Account Status:</i></small></td>
    <td><b><h5><?php echo $accouts; ?></h5></b></td>
    
  </tr>
  <tr>
    <td><small><i>Account Security:</i></small></td>
    <td><a href="../files/include.php?user=<?php echo $usertype;?>&&resetuser=<?php echo $user; ?>" class="btn btn-outline-dark">Reset Password for <?php echo $username; ?> </a></td>
    
  </tr>
  <tr>
    <td colspan=3>
        
        
        <a data-bs-toggle="modal" data-bs-target="#editDetails" href="index.php?user=<?php echo $usertype;?>&&edituser=<?php echo $user; ?>" class="btn btn-warning bg-gradient"><i class="bi bi-gear-fill"></i> Edit <?php echo $username; ?> Details</a>
        <a href="index.php?user=<?php echo $type;?>&&sususer=<?php echo $user; ?>" class="btn btn-info bg-gradient"><i class="bi bi-bootstrap-reboot"></i> <?php echo $btnvalue.$username; ?> Account</a>
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="" class="btn btn-danger bg-gradient"><i class="bi bi-trash-fill"></i> Delete <?php echo $username; ?> Account</a>
    </td>
    
  </tr>
  
  </tbody>
</table>  
    <?
  
    
     
    
    
    
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
          
        Are you sure you want to<b> DELETE <?php echo $username ?></b> Account. If you delete the data will be lost forever and no backup is being provided. You can either edit the details or suspend the account
      </div>
      <a data-bs-toggle="modal" data-bs-target="#editDetails" href="index.php?user=<?php echo $usertype;?>&&edituser=<?php echo $user; ?>" class="btn btn-warning bg-gradient"><i class="bi bi-gear-fill"></i> Edit  Details</a>
      <div class="modal-footer"><hr>
        <a type="button" class="btn btn-primary bg-gradient" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Do Not Delete</a>
        <a href="../files/include.php?user=<?php echo $usertype;?>&&deluser=<?php echo $user; ?>" type="button" class="btn btn-danger bg-gradient"><i class="bi bi-trash-fill"></i> Delete Completely</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Edit <?php echo $username; ?> Account Details</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        
        
        
<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success ">
        
        
    <div class="form-group">
        <label for="userpass">User System ID:</label>
        <input type="text" name="sysid" id="buslocation" class="form-control" value="<?echo $user;?>" readonly="readonly"><br>
        
      </div>
       <div class="form-group">
        <Label for="username">User Name:</Label>        
        <input type="text" name="username" class="form-control" value="<?echo $username;?>"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">User Email:</Label>        
        <input type="email" name="useremail" class="form-control" value="<?echo $email;?>"><br>
       </div>
       <div class="form-group">
        <Label for="usertype">User Type:        </Label>
        <select name="usertype" class="form-control">
          <option value="<?echo $usertype;?>"><?echo $userty;?></option>
          <option value="<?echo $usertype1;?>"><?echo $userty1;?></option>
          
          
        </select>
       </div>

      <div class="form-group">
        <Label for="status">Account Status:</Label>        
        <select name="status" class="form-control">
          <option value="1">Active</option>
          <option value="0">Not Active</option>
          
        </select>
       </div>

<br>
       <div class="form-group">
        <button type="submit" value="edituser" name="edituser" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-gear-fill"></i> Edit <?echo $username;?> Details
           </button>
       </div>
       <br>
    </form>
      </div>
      
    </div>
  </div>
</div>




