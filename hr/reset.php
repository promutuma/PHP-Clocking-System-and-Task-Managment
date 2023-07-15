<?
if($_GET['resetpass']){
    $email=$_GET['resetpass'];

    
    
 ?>   <div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><i class="bi bi-cpu"></i></h2></span>
				<h4 class="company_title">CETRAD</h4><hr><small>Human Resource Reset Password</small>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
					    <h2><i class="bi bi-key-fill"></i></h2>
					    
						<h2>Log In</h2>
						<hr>
					</div>
					<div class="row">
						<form control="" class="form-group" method="POST" action="../files/include.php">
							<div class="row">
							    
								<input type="text" name="hrmemail" id="hrmemail" class="form__input" placeholder="Email" value="<?echo $email?>" readonly="readonly">
							</div>
							<div class="row">
								 <span class="fa fa-lock"></span> 
								<input type="password" name="pass" id="password" class="form__input" placeholder="Password">
							</div>
							<div class="row">
								 <span class="fa fa-lock"></span> 
								<input type="password" name="pass1" id="password" class="form__input" placeholder="Repeat Password">
							</div>
							<div class="row">
								<input type="submit" value="Save New Password" name="hrpassre" class="btno">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><?
    
    
    
    
    
}




?>