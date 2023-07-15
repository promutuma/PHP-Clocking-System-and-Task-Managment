<?php
require '../files/include.php';
require '../files/homenavbar.php';

$home="../admin";

?>
<b class="text-warning d-flex align-items-center justify-content-center sidenave">Clocking System</b> 
<div class="container-fluid">
   
   <div class="row sidenav text-center shadow-sm">
   <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../">Clocking System Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Receptionist</li>
  </ol>
</nav>
 </div>   



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
       
      

if (isset($_SESSION['receptionist'])) {
	# code...





?>


 <div class="row content">
    <div class="col-sm-2 sidenav">
      <div class="btn btn-outline-success">
<?php
	echo "<i class=\"bi bi-person\"></i> | ".$_SESSION['receptionist'] . "<br>";
?>
</div>
    <?php
      require 'recnav.php';?>
    </div>
    <div class="col-sm-10 text-left"> 
      <h1><?php
	echo "<i class=\"bi bi-person\"></i> | ".$_SESSION['receptionist'] . "<br>";?></h1>
 <?php



?>
      <hr>
      
      <p>
      <?php
//Dashboard
if(@$_GET['index']==true){
require "$home/home.php";
}
      
//user adding link page
      
      if (@$_GET['au']==true)
 {
	# code...
	require $home.'adduser.php';
} 
// user account management 
if (@$_GET['uam']==true)
 {
	# code...
	require "$home/uam.php";
} 
// view user
if (@$_GET['viewuser']==true)
 {
	# code...
	require "$home/viewuser.php";
} 
//edit user
if (@$_GET['edituser']==true)
 {
	# code...
	require "$home/edituser.php";
}

// employee account management 
if (@$_GET['eam']==true)
 {
	# code...
	require "$home/eam.php";
}



// Adding Employee
if (@$_GET['emp']==true)
 {
	# code...
	require "$home/addemp.php";
} 

//depertment management portal
if (@$_GET['dep']==true)
 {
	# code...
	require "$home/depsec.php";
} 
//adding depertment
if (@$_GET['sec']==true)
 {
	# code...
	require "$home/adddepsec.php";
} 
// viewing all employees
if (@$_GET['viewemp']==true)
 {
	# code...
	require "$home/viewemp.php";
}
//edit employee details
if (@$_GET['editemp']==true)
 {
	# code...
	require "$home/editemp.php";
}
// view depertments
if (@$_GET['viewdep']==true)
 {
	# code...
	require "$home/viewdep.php";
}
// clocking in and clocking out
if (@$_GET['clock']==true)
 {
	# code...
	require "$home/clock.php";
}
//edit depetment
if (@$_GET['editdep']==true)
 {
	# code...
	require "$home/editdep.php";
}
//report
if (@$_GET['report']==true)
 {
	# code...
	require "$home/report.php";
}
if (@$_GET['task']==true)

 {

    # code...

    require "$home/task.php";

}
if (@$_GET['custom']==true)

 {

    # code...

    require "$home/customreport.php";

}
















}
else
{



    	echo "<span class=\"badge bg-danger\">Not logged in</span>";
if (@$_GET['resetpass']==true)
 {
	# code...
	require 'reset.php';
}else{
    	require_once 'login.php';
} 

    


	


}


?>




    
    
    
</div>




<?php

require "../files/footer.php";

?>