<?php
require '../files/include.php';
require '../files/homenavbar.php';




if (isset($_GET['frr'])) {
	// code...
	$encodefrr=$_GET['frr'];
	$code=base64_decode($encodefrr);


	$end=$sdt." ".$sdt1;
                        
    $Newcode=strtotime($end);

    $codedif=$Newcode-$code;


    if ($codedif>=7260) {
    	// code...
    	?>
	<hr>
	<div class="alert alert-danger" role="alert" style="">
  <b><i class="bi bi-cone-striped"></i> Sorry your link expired: </b><br>
 <i class="bi bi-forward-fill"></i> Please check your latest Email then try again. <br>
 <i class="bi bi-forward-fill"></i> Request a new link from the login page then select reset password<br>
 <i class="bi bi-forward-fill"></i> Login if you remeber your password<br>
  <a href="index.php">Login Page</a>
</div>
<?

    } else {
    	// code...



     $sql="SELECT * FROM `admin` WHERE resetcode = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$code);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empname=$row['username'];
            $email=$row['email'];
            $id=$row['admin_id'];
        

}

?>

<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><i class="bi bi-cpu"></i></h2></span>
				<h4 class="company_title">CETRAD</h4><hr><small>Admin Portal Reset Password</small>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
					    <h2><i class="bi bi-key-fill"></i></h2>
					    <h1>Reset <? echo $empname;?> Password</h1>
					    <hr>
<form control="" class="form-group" method="POST" action="../files/include.php">
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Sys ID</label>
    <input type="email" class="form-control" name="admid" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?echo $id;?>" readonly="readonly">
    <div id="emailHelp" class="form-text">Unique.</div>
  </div>					    
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?echo $email;?>" readonly="readonly">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="email" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?echo $empname?>" readonly="readonly">
    <div id="emailHelp" class="form-text">You cannot edit.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="pass" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
  </div>
  <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
    <input type="password" class="form-control" name="rpass" id="exampleInputPassword1">
  </div>
  <div class="row">
								<input type="submit"  value="Update Password" name="adminReset" class="btno">
							</div>
						</form>
					</div>
					<div class="row">
						<p>Login <a href="index.php">here</a></p>
						<p>Don't have an account? <a href="signup.php">Register Here (admin only)</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>










<?

} else{?>
	<hr>
	<div class="alert alert-danger" role="alert" style="">
  <b><i class="bi bi-cone-striped"></i> Sorry your link expired: </b><br>
 <i class="bi bi-forward-fill"></i> Please check your latest Email then try again. <br>
 <i class="bi bi-forward-fill"></i> Request a new link from the login page then select reset password<br>
 <i class="bi bi-forward-fill"></i> Login if you remeber your password<br>
  <a href="index.php">Login Page</a>
</div>
<?
}
    }
    

	


} else {
	// code...
	?>
	<hr>
	<div class="alert alert-danger" role="alert" style="">
  <b><i class="bi bi-cone-striped"></i> Sorry you are not allowed to access this page.</b><br>
 
  <a href="index.php">Login Page</a>
</div>
<?
	
}



require "../files/footer.php";
?>