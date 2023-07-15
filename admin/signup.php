    
<?php
require '../files/homenavbar.php';

?>

<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><i class="bi bi-cpu"></i></h2></span>
				<h4 class="company_title">CETRAD</h4><hr><small>Admin Portal</small>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
						<h2>Signup</h2>
					</div>
					<div class="row">
						<form control="" class="form-group" method="POST" action="../files/include.php">
							<div class="row">
								<input type="text" name="adminusername" id="adminusername" class="form__input" placeholder="Username">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="email" name="email" id="email" class="form__input" placeholder="email">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="password" name="password" id="password" class="form__input" placeholder="Password">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="password" name="password1" id="password1" class="form__input" placeholder="Repeat Password">
							</div>
							
							<div class="row">
								<input type="submit" value="Signup" class="btno">
							</div>
						</form>
					</div>
					<div class="row">
						<p>Do you have an account? <a href="index.php?reg=regnow">Admin Login</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	
	
<?php

require "../files/footer.php";

?>

    