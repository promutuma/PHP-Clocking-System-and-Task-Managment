<?php
if (isset($_GET['editemp'])) {

    $empid = $_GET['editemp'];

    $sql = "SELECT * FROM `employee` WHERE EmpsysID = $empid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
                
                    $det=$row["depertment"];
                    $empids = $row['EmpsysID'];
                    $empname= $row['surname'];
                    $sts = $row['status'];
?>



        <form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-info border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Update Employee Details</h3>
        </div>
        <hr>
       <div class="form-group">
                   <Label for="username">Employee System ID:</Label>        
        <input type="text" name="sysID" class="form-control" value="<?php echo $empid ?>" readonly="readonly"><br>
        <Label for="username">Employee Surname:</Label>        
        <input type="text" name="surname" class="form-control" value="<?php echo $row['surname']; ?>"><br>
        <Label for="username">Employee Other Names:</Label>        
        <input type="text" name="empname" class="form-control" value="<?php echo $row['empname']; ?>"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">Employee Email:</Label>        
        <input type="email" name="empemail" class="form-control" value="<?php echo $row['empemail']; ?>"><br>
       </div>

       <div class="form-group">
        <label for="userpass">Employee ID</label>
        <input type="text" name="empid" id="buslocation" class="form-control" value="<?php echo $row['empID']; ?>"><br>

      </div>
        <div class="form-group">
        <Label for="status">Employee Department:</Label>        
        <select name="dep" class="form-control" value="<?php echo $row['depertment']; ?>">
            <?php 
            $sql="SELECT * FROM `depertment`";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    ?><option value='<?echo $row['depName'];?>'><?echo $row['depName'];?></option><?php
                }
            
            ?>
        </select>
       </div>
      <div class="form-group">
        <Label for="status">Employee Account Status:</Label>        
        <select name="status" class="form-control">
          <option value="1">Active</option>
          <option value="0">Not Active</option>
          
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







<?php



        }
    }
}
?>




