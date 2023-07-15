<?php
require '../files/include.php';
require '../files/homenavbar.php';

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Task</li>
  </ol>
</nav>
<div class="container">

<?php

if(@$_GET['Error']==true){
            ?> <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php
            echo $_GET['Error'];
            ?>
            	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php
        }else{
        if(@$_GET['Success']==true){
            ?> <div class="alert alert-success alert-dismissible fade show" role="alert"><?php
            echo $_GET['Success']; ?>
            	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php
        }    
        }
       




if (isset($_GET['e'])) {
	// code...
	$ECempid=$_GET['e'];
	$ECempPass=$_GET['p'];

	$empid= base64_decode($ECempid);
	$emptpass=$ECempPass;


	$sql="SELECT * FROM `clockin` WHERE clockDay=? AND empID=? AND emppass=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$sdt,$empid,$emptpass);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
        }
        ?>

<form method="POST" action="../files/include.php" class="shadow p-3 mb-5 bg-body rounded">
	<h1>Employee Login</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Employee Id</label>
    <input type="text" name="empid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?echo $empid;?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Your ID.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" value="<?echo $emptpass;?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Todays password sent to your email.</div>
  </div>
  <div class="d-grid gap-2">
  <button type="submit" name="employee" class="btn btn-primary"><i class="bi bi-unlock-fill"></i> Login</button>

</div><hr>
  <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopR" aria-controls="offcanvasTop">Request A New Password </button>

</form>

<hr>

<?php
    }else{
?>
<div class="alert alert-danger" role="alert">
 Hello Employee,<br>
 You are trying to use an expired link. All links expire at midnight every day. New link is always provided by the system please check your inbox or spam box.<hr>
 <i class="bi bi-arrow-right-short"></i> Did you clockin?<br>
<i class="bi bi-arrow-right-short"></i> Did you check the latest Email from TaskBoard?<br>
 If you did the above, contact the ICT office or try again.<br>
 <a href="index.php">Click me to enter your ID and Password manually</a> Password is send daily to your Employee Email.<hr>
 <button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopR" aria-controls="offcanvasTop">Request A New Password </button>
</div>



<?php
        }






} else {
	// code...
if (isset($_SESSION['employee'])) {
	require 'home.php';


	
}else{


 ?>

<form method="POST" action="../files/include.php" class="shadow p-3 mb-5 bg-body rounded">
	<h1>Please Login below:</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Employee Id</label>
    <input type="text" name="empid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Your Employee Id.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
    <div id="emailHelp" class="form-text">Password Sent Today to your email</div>
  </div>
  
  <div class="d-grid gap-2">
  <button type="submit" name="employee" class="btn btn-primary"><i class="bi bi-unlock-fill"></i> Login</button>
</div><hr>
<button class="btn btn-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopR" aria-controls="offcanvasTop">Request A New Password </button>
</form>

<hr>

<?php



}

}











?>
</div>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopR" aria-labelledby="offcanvasTopLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasTopLabel">Password Request For Employee</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
     <form class="row g-3" method="POST" action="../files/include.php">
   
  <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Employee ID</label>
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">Employee ID</span>
     <input type="text" name="remaile" class="form-control" id="basic-url" aria-describedby="basic-addon3" >
      <button type="submit" name="reemail" class="btn btn-primary"><i class="bi bi-minecart-loaded"></i> Submit</button>
</div>

</form>
  </div>
</div>
</div>
<?php
require "../files/footer.php";
?>