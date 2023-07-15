<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Add Employee Details</h3>
        </div>
        <hr>
       <div class="form-group">
        <Label for="username">Employee Surname:</Label>        
        <input type="text" name="surname" class="form-control"><br>
        <Label for="username">Employee Other Names:</Label>        
        <input type="text" name="empname" class="form-control"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">Employee Email:</Label>        
        <input type="email" name="empemail" class="form-control"><br>
       </div>

       <div class="form-group">
        <label for="userpass">Employee ID</label>
        <input type="text" name="empid" id="buslocation" class="form-control"><br>

      </div>
        <div class="form-group">
        <Label for="status">Employee Department:</Label>        
        <select name="dep" class="form-control">
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
          <option value="1">Active</option>
          <option value="0">Not Active</option>
          
        </select>
       </div>

<br>
       <div class="form-group">
        
        <button type="submit" value="addemp" name="addemp" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-person-plus-fill"></i>  Add Employee
           </button>
       </div>
       <br>
     
        
    </form>