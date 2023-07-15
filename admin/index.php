<?php

require '../files/include.php';

require '../files/homenavbar.php';



?>









                <b class="text-warning d-flex align-items-center justify-content-center sidenave">Clocking System</b> 

                

                

                

<div class="container-fluid">  

<div class="row sidenav text-center  shadow-sm">

    

    

    

   <nav aria-label="breadcrumb">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="../">Clocking System Home</a></li>

    <li class="breadcrumb-item active" aria-current="page">Administrator Portal</li>

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
            
        }}




if (isset($_SESSION['Admin'])) {

	# code...

	

	?>

  <div class="row content  shadow">

    <div class="col-sm-2 sidenav">

      <div class="btn btn-outline-success">

<?php

	echo "<i class=\"bi bi-person\"></i> | ".$_SESSION['Admin'] . "<br>";

?>

</div>

    <?php

      require 'adminnav.php';?>

    </div>

    <div class="col-sm-10 text-left"> 

      <h1><?php

	echo "<i class=\"bi bi-person\"></i> | ".$_SESSION['Admin'] . "<br>";?></h1>

 <?php







?>

      <hr>

      

      <p>

      <?php

//Dashboard

if(@$_GET['index']==true){

require 'home.php';

}

      

//user adding link page

      

      if (@$_GET['au']==true)

 {

	# code...

	require 'adduser.php';

} 

// user account management 

if (@$_GET['uam']==true)

 {

	# code...

	require 'uam.php';

} 

// view user

if (@$_GET['viewuser']==true)

 {

	# code...

	require 'viewuser.php';

} 

//edit user

if (@$_GET['edituser']==true)

 {

	# code...

	require 'edituser.php';

}



// employee account management 

if (@$_GET['eam']==true)

 {

	# code...

	require 'eam.php';

}







// Adding Employee

if (@$_GET['emp']==true)

 {

	# code...

	require 'addemp.php';

} 



//depertment management portal

if (@$_GET['dep']==true)

 {

	# code...

	require 'depsec.php';

} 

//adding depertment

if (@$_GET['sec']==true)

 {

	# code...

	require 'adddepsec.php';

} 

// viewing all employees

if (@$_GET['viewemp']==true)

 {

	# code...

	require 'viewemp.php';

}

//edit employee details

if (@$_GET['editemp']==true)

 {

	# code...

	require 'editemp.php';

}

// view depertments

if (@$_GET['viewdep']==true)

 {

	# code...

	require 'viewdep.php';

}

// clocking in and clocking out

if (@$_GET['clock']==true)

 {

	# code...

	require 'clock.php';

}

//edit depetment

if (@$_GET['editdep']==true)

 {

	# code...

	require 'editdep.php';

}

//report

if (@$_GET['report']==true)

 {

	# code...

	require 'report.php';

}

//report

if (@$_GET['adm']==true)

 {

    # code...

    require 'admin.php';

}
//task

if (@$_GET['task']==true)

 {

    # code...

    require 'task.php';

}
if (@$_GET['custom']==true)

 {

    # code...

    require 'customreport.php';

}







      ?>

      </p>

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







require "../files/footer.php";





?>



