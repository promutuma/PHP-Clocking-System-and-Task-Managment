    
<div class="container-fluid">
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><i class="bi bi-people-fill"></i></h2></span>
				<h4 class="company_title">CETRAD</h4><hr><small>Human Resource Portal</small>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row">
						<h2>Log In</h2>
					</div>
					<div class="row">
						<form control="" class="form-group" method="POST" action="../files/include.php">
							<div class="row">
								<input type="Email" name="hremail" id="email" class="form__input" placeholder="Email">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="password" name="hrpass" id="password" class="form__input" placeholder="Password">
							</div>
							<div class="row">
								<input type="checkbox" name="remember_me" id="remember_me" class="">
								<label for="remember_me">Remember Me!</label>
							</div>
							<div class="row">
								<input type="submit" value="Login" name="hrlogin" class="btno">
							</div>
						</form>
					</div>
					<div class="row">
						<p>Forgot password? <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Reset here</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->

	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-life-preserver"></i> Reset Your Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="../files/include.php">
        	<div class="mb-3">
   			 <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-open"></i> Admin Email address</label>
  			  <input type="email" name="admemail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
 			   <div id="emailHelp" class="form-text">Your registered email here.</div>
			</div>
        	
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="hrreset" class="btn btn-primary">Reset Your Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

    