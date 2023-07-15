<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">
        <div class="form-group ">
      
        <h3 class="modal-title"><i class="bi bi-people"></i> Add Human Resource Manager or Receptionist</h4>
        </div>
        <hr>
       <div class="form-group">
        <Label for="username">User Name:</Label>        
        <input type="text" name="username" class="form-control"><br>
       </div>
       <div class="form-group">
        <Label for="useremail">User Email:</Label>        
        <input type="email" name="useremail" class="form-control"><br>
       </div>
       <div class="form-group">
        <Label for="usertype">User Type:        </Label>
        <select name="usertype" class="form-control">
          <option value="hr">Human Resource</option>
          <option value="receptionist">Receptionist</option>
          
        </select>
       </div>
       <div class="form-group">
        <label for="userpass">Password:</label>
        <input type="password" name="userpass" id="buslocation" class="form-control"><br>
        <label for="userpass1">Repeat Password:</label>
        <input type="password" name="userpass1" id="buslocation" class="form-control"><br>
      </div>
      <div class="form-group">
        <Label for="status">Account Status:</Label>        
        <select name="status" class="form-control">
          <option value="1">Active</option>
          <option value="0">Not Active</option>
          
        </select>
       </div>

<br>
       <div class="form-group">
        
        <button type="submit" value="adduser" name="adduser" class="btn btn-outline-success btn-block btn-lg form-control" >
             <i class="bi bi-person-plus-fill"></i>  Add The User
           </button>
       </div>
       <br>
     
        
    </form>