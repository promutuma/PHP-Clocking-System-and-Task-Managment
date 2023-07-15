<?php

function viewpermissions($perm){
	if ($perm=="B") {
		// code...
		$permN="Admin, Human Resource and Receptionist";
	}elseif ($perm=="H") {
		// code...
		$permN="Admin and Human Resource";
	}elseif($perm=="R"){
		$permN="Admin and Receptionist";

	}
	 else {
		// code...
		$permN="Admin Only";
	}
return $permN;	

}

function permcolor($perm){
	if ($perm=="B") {
		// code...
		$permN="table-warning";
	}elseif ($perm=="H") {
		// code...
		$permN="table-info";
	}elseif($perm=="R"){
		$permN="table-success";

	}
	 else {
		// code...
		$permN="table-danger";
	}
return $permN;

}





$x=1;
?>
<div class=" shadow p-3 mb-5 bg-body rounded">
<label for="basic-url" class="form-label"><b>Allowed IP</b></label>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon3"><b><i class="bi bi-wifi"></i></b>   Allowed Ip Address </span>
  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $allowedip;?>" readonly="readonly">
  <span class="input-group-text" id="basic-addon3"><button type="button" class="btn btn-primary bg-gradient shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-journal-check"></i> 
  Change IP address
</button></span>
</div>
</div>

<a href="../files/apk/CETRAD_CLOCKING_SYSTEM.apk" class="btn btn-success shadow  bg-gradient"><i class="bi bi-cloud-download"></i> Download Clocking System Android APP</a>
<hr>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th colspan="2" scope="col">Permission Name</th>
      <th scope="col">Allowed To</th>
      <th scope="col">Edit Permission</th>
    </tr>
  </thead>
  <tbody><?php

 $sql="SELECT * FROM `permissions`";
             $stmt=$conn->prepare($sql);     
          	 $stmt->execute();
           	 $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                 	while ($row = $result->fetch_assoc()) {


?>
  
    <tr class="<?php echo permcolor($row['user']) ?>">

      <th scope="row"><?php echo  $x++; ?></th>
      <td><?php echo  $row['icon'] ; ?></td>
      <td><?php echo  $row['permname'] ; ?></td>
      <td><?php echo viewpermissions($row['user']) ; ?></td>
      <td><a data-bs-toggle="modal" data-bs-target="#jj<?php echo  $row['permid'] ; ?>"> Edit Me</a></td>
    </tr>

<?php
}}
?>
</tbody>
</table>


<?php

 $sql="SELECT * FROM `permissions`";
             $stmt=$conn->prepare($sql);     
          	 $stmt->execute();
           	 $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                 	while ($row = $result->fetch_assoc()) {

?>

<!-- Modal -->
<div class="modal fade" id="jj<?php echo  $row['permid'] ; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo  $row['permname'] ; ?> Permissions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form method="POST" action="../files/include.php">
        <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Permission SYS ID:</label>
    <input type="text" name="sysid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo  $row['permid'] ; ?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Not Editable</div>
  </div>
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Permission Name:</label>
    <input type="text" name="permname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo  $row['permname'] ; ?>' readonly="readonly">
    <div id="emailHelp" class="form-text">Not Editable</div>
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Icon Code:</label>
    <input type="text" name="icon" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value='<?php echo  $row['icon'] ; ?>'>
    <div id="emailHelp" class="form-text">Use bootsrap Icons PLease: On there website <a href="https://icons.getbootstrap.com/"> getboostrap.com</a> </div>
  </div>


  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Who to use</label>
     <select class="form-select" name="user">
        
        <option value="N">Admin Only</option>
        <option value="H">Human Resource Only</option>
        <option value="R">Receptionist Only</option>
        <option value="B">Admin, Human Resource and Receptionist</option>
        
      </select>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edtPERM" class="btn btn-primary">Save changes</button>
      </div>
  </form>
    </div>
  </div>
</div>

<?php
}}


$sql="SELECT * FROM `ipaddress`";
 $stmt=$conn->prepare($sql);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            $ipid=$row['id'];
                            $allowedip=$row['ipaddress'];}}

?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter The New Ip address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../files/include.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">SYS ID:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ipid" value="<?php echo $ipid;?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Cannot Be Editted.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">IP Address:</label>
    <input type="text" name="ip" class="form-control" id="exampleInputPassword1" value="<?php echo $allowedip;?>">
  </div>

  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Close</button>
        <button type="submit" name="ipedit" class="btn btn-primary"><i class="bi bi-list-check"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>