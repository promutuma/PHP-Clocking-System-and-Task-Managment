<?php
require 'files/homenavbar.php';

?>
<div class="container">

  
  <a href="tasks/" class="nav-link col"> 
  <div class="card text-white bg-success mb-3" style="max-width: 100%;">
    
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/files/sysphoto/tasks.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Cetrad TaskBoard</h5>
        <p class="card-text">This portal will be used by all employees to capture Tasks carried out.</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>
</a>




<h1> <b class="text-success d-flex align-items-center justify-content-center">Clocking System</b> </h1>     
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
  <a href="admin/index.php?index=index" class="nav-link col">
    <div class="card text-white bg-success h-100">
      <img src="/files/sysphoto/admin.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><i class="bi bi-server"></i> Clocking System Admin</h5>
        <hr>
        <p class="card-text"><i class="bi bi-exclamation-triangle"></i> This portal should only be accesssed by the system adminstrator.</p>
      </div>

    </div>
  </a>
  
  
  <a href="hr/index.php?index=index" class="nav-link col">
    <div class="card text-white bg-success h-100">
      <img src="/files/sysphoto/hr.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><i class="bi bi-file-spreadsheet"></i> Human Resource Manager</h5>
        <hr>
        <p class="card-text"><i class="bi bi-exclamation-triangle"></i> This portal should only be accesssed by the HUMAN RESOURCE MANAGER.</p>
      </div>

    </div>
  </a>
  
  
  <a href="employee/index.php?index=index" class="nav-link col">
    <div class="card text-white bg-success h-100">
      <img src="/files/sysphoto/portal.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><i class="bi bi-reception-3"></i> Clocking Portal</h5>
        <hr>
        <p class="card-text"><i class="bi bi-exclamation-triangle"></i> This portal should only be accessed by the receptionist to clock users if only the android device is not working.</p>
      </div>

    </div>
  </div>
</a>
    
    
    
    
    
</div>




<?php

require "files/footer.php";

?>