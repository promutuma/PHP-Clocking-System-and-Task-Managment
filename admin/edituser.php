<?php
if ($_GET['edituser']==True) {
    $usertype=$_GET['user'];
    $user=$_GET['edituser'];
    
    
    if($usertype==0){
        $sql = "SELECT * FROM `hr` WHERE userId = $user";
        $result = $conn->query($sql);

         if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
             $username=$row['userName'];
             $email=$row['userEmail'];
             $regdate=$row['dateofreg'];
             $regtime=$row['Time_of_reg'];
             $status=$row['status'];
             $usertype="hr";
             $usertypename="Human Resource";
            
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
             $usertype="receptionist";
             $usertypename="Receptionist";
         }}
    }
  
    

  ?>
<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Add Human Resource Manager or Receptionist</h4>
        </div>
        <hr>
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
          <option value="<?echo $usertype;?>"><?echo $usertypename;?></option>
          
          
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




    <?

}


?>