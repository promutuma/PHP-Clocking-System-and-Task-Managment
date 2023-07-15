<?php
require '../files/include.php';
require '../files/homenavbar.php';

?>
<div class="container">
  <div class="btn btn-outline-primary">
<?php
	echo "<i class=\"bi bi-person\"></i> | ".$_SESSION['Admin'] . "<br>";
?>
</div>
   
<?php
if(@$_GET['Error']==true){
            ?> <div class="alert alert-danger" ><?php
            echo $_GET['Error'];
        }
        if(@$_GET['Success']==true){
            ?></div> <div class="alert alert-success" ><?php
            echo $_GET['Success'];
            
        }
        ?></div>   
    
    
    
    
    
    
    
     <div class="row">
   <b class="text-success d-flex align-items-center justify-content-center">Clocking System</b> 
   <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Clocking System Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Administrator Portal</li>
  </ol>
</nav>

       <?php

if (isset($_SESSION['Admin'])) {
	# code...























?>

<div class="container">
   
  <div class="row">
    <div class="col">
      <?php

require 'adminnav.php';
	
?>
    </div>
    <div class="col-6">
      <?php

if (@$_GET['newb']==true)
 {
	# code...
	require 'newb.php';
} 


if (@$_GET['edb']==true)
 {
	# code...
	require 'editbis.php';
} 


if (@$_GET['bus']==true)
 {
	# code...
	require 'bus.php';
} 


if (@$_GET['ebuedit']==true)
 {
	# code...
	require 'exbusedit.php';
} 

if (@$_GET['index']==true)
 {
	# code...
	require 'home.php';
} 

if (@$_GET['acc']==true)
 {
	# code...
	require 'account.php';
} 


?>
</div>

    </div>
    <div class="col">
      3 of 3
    </div>
  </div>
  
</div>
















<?php



}
else
{

    

	echo "<span class=\"badge bg-danger\">Not logged in</span>";
	
	require_once 'login.php';

}


?>
    
    
    
</div>




<?php

require "../files/footer.php";

?>