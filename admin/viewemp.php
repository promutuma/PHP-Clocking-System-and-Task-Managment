<?php

if ($_GET['viewemp']==True) {
    # code...
    $empid=$_GET['viewemp'];
    
    $thisM= date("m");

                $sql="SELECT * FROM `employee` WHERE EmpsysID = $empid";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $day=$row["Day_or_reg"];
                    $det=$row["depertment"];
                    $empids = $row['EmpsysID'];
                    $empid = $row['empID'];
                    $empname= $row['surname'];
                    $sts = $row['status'];
                    $empother=$row['empname'];
                    $empemail=$row['empemail'];
                    
                    if($sts==1){
                        $table="table-success";
                        $status="Active";
                        $status1="Not Active";
                    }else{
                        $table="table-warning";
                        $status="Not Active";
                        $status1="Active";
                    }
                    ?>
<table class="table table-bordered shadow-sm p-3 mb-5 bg-body rounded border border-info <?php echo $table; ?>">
  <tr>
    <td><i><small>Employee ID:</small></i> <b><h4><?php echo $row['empID']; ?></h4></b></td>
    <td colspan=2><i><small>Employee Name:</small></i><b><h4><?php echo $row['surname']." ".$row['empname']; ?></h4></b></td>
    
  </tr>
  <tr>
    <td rowspan="4"><img src="../files/sysphoto/emp.png" class="img-fluid" alt='<?php echo $row['surname']." ".$row['empname']." Image"; ?>'></td>
    <td><i><small>Employee Email:</small></i><br><b><h5><?php echo $row["empemail"]; ?></h5></b></td>
    <td><i><small>Worked Hours This Month:</small></i><br><b><h5>
        <?php
         $sql="SELECT empID, SUM(workedTime) AS emptotaltime FROM clockout WHERE empID=$empid AND MONTH(clockDay)=$thisM GROUP BY clockout.empID";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $worksec= $row['emptotaltime'];
                    echo foo($worksec);
                }
        ?>
    </h5></b></td>
    
    
  </tr>
  <tr>
  
    <td><i><small>Employee Department</small></i><br> <b><h5><?php echo $det; ?></h5></b></td>
    <td><i><small>Today Status:</small></i> <br><b><h5>
        <?php
        
        $sql = "SELECT * FROM `clockin` WHERE `empID` = $empid AND `clockDay` = '$sdt';";
                   $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                       $clock=$row['clockinID'];
                       $clockin=$row['clockTime'];
                
                $sql = "SELECT * FROM `clockout` WHERE `empID` = '$empid' AND `clockDay` = '$sdt';";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $cout=$row['clockTime'];
                                $worktime=$row['workedTime'];
                                
                                echo "Worked for " .$worktime ." Seconds today from " .$clockin." to " .$cout;
                            }}else{
                                echo "Working, clocked in at ".$clockin;
                            }
            }}
            else
            {
echo "Off Duty";
                              }
        ?>
        </h5>
    </b>
    </td>
    
  </tr>
  <tr>
    
    <td><i><small>Date of Registration</small></i><br> <b><h5><?php echo $day; ?></h5></b></td>
    <td><i><small>Account Status:</small></i><br><b><h5>
    <?php
    
    if($sts==1){echo "Active";}else{echo "Suspended";}
    ?>
    </h5></b></td>
    
  </tr>
    <tr>
    <td><i><small>Number of Active and Suspended Tasks</small></i><h5><? echo Atasks($empid,$conn);?></h5></td>
    <td><i><small>Number of Complete Task This Month</small></i><h5><? echo ctasks($empid,$thismonth,$conn);?></h5></td>
    
 </tr>
 <tr>
    <td colspan=3>
        <a href="index.php?eam=eam" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back To Other Employees</a>
        <a data-bs-toggle="modal" data-bs-target="#editDetails" href="index.php?editemp=<?php echo $empids ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit <?php echo $empname." Details"; ?></a>
    <a href="../files/include.php?susemp=<?php echo $empids ?>" class="btn btn-info"><i class="bi bi-person-dash"></i>
    <?php
    if($sts==1){$stss="Suspend ";}else{$stss="Activate ";}
    ?>
    <?php echo $stss .$empname." Account"; ?></a>
    <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Remove <?php echo $empname; ?></a>
    </td>
    
  </tr>

</table>
<?php
                }

}

?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Warning</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1>  <i class="bi bi-exclamation-lg"></i></h1>
          
       Do you want to DELETE<b> <?php echo $empname ?>. </b>If you delete the data will be lost forever and no backup is being provided. You can either edit the details or suspend the account
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Do Not Delete</a>
        <a href="../files/include.php?delemp=<?php echo $empids ?>" type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Delete Completely</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal to edit employee -->
<div class="modal fade" id="editDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Update <?php echo $empname; ?> Details</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        
        
        

        <form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success">
        <div class="form-group ">
      
       

       <div class="form-group">
                   <Label for="username">Employee System ID:</Label>        
        <input type="text" name="sysID" class="form-control" value="<?php echo $empids ?>" readonly="readonly"><br>
        <Label for="username">Employee Surname:</Label>        
        <input type="text" name="surname" class="form-control" value="<?php echo $empname; ?>"><br>
        <Label for="username">Employee Other Names:</Label>        
        <input type="text" name="empname" class="form-control" value="<?php echo $empother; ?>"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">Employee Email:</Label>        
        <input type="email" name="empemail" class="form-control" value="<?php echo $empemail; ?>"><br>
       </div>

       <div class="form-group">
        <label for="userpass">Employee ID</label>
        <input type="text" name="empid" id="buslocation" class="form-control" value="<?php echo $empid; ?>"><br>

      </div>
        <div class="form-group">
        <Label for="status">Employee Department:</Label>        
        <select name="dep" class="form-control" value="<?php echo $det; ?>">
            <option value='<?echo $det;?>'><?echo $det;?></option>
            <?php 
            $sql="SELECT * FROM `depertment`";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    ?><option value='<?php echo $row['depName'];?>'><?php echo $row['depName'];?></option><?php
                }
            
            ?>
        </select>
       </div>
      <div class="form-group">
        <Label for="status">Employee Account Status:</Label>        
        <select name="status" class="form-control">
          <option value="<?php echo $sts; ?>"><?php echo $status; ?></option>
          <option value="<?php echo $sts; ?>"><?php echo $status1; ?></option>
          
        </select>
       </div>

<br>
       <div class="form-group">
        
        <button type="submit" value="edemp" name="edemp" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-gear"></i>  Edit Employee Details
           </button>
       </div>
       <br>
     
        
    </form>


        
        
        
      </div>
      
    </div>
  </div>
</div>



