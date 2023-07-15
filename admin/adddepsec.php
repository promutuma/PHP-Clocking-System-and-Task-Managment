<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Create New Department</h3>
        </div>
        <hr>
       <div class="form-group">
        <Label for="username">Department Unique Code:</Label>        
        <input type="text" name="dcode" class="form-control"><br>
                <Label for="username">Department Name:</Label>        
        <input type="text" name="dname" class="form-control"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">Department Email:</Label>        
        <input type="email" name="demail" class="form-control"><br>
       </div>

       <div class="form-group">
        <label for="userpass">Department Head:</label>
        <input type="text" name="dhead" id="buslocation" class="form-control"><br>



<br>
       <div class="form-group">
        
        <button type="submit" value="adddep" name="adddep" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-folder-plus"></i>  Create New Department
           </button>
       </div>
       <br>
     
        
    </form>