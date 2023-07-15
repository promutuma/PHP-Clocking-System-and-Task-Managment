<?php

if (@$_GET['clock']==true)

 {

$clockst=$_GET['clock'];



if($clockst=="clock"){


    ?>

    <form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-success border border-end-0 border-warning rounded-3">

        <div class="form-group ">

      

        <h3 class="modal-title"><i class="bi bi-people"></i> Enter Employee ID Below</h3>

        <small>Clockin or Clock Out</small>

        </div>

        <hr>

       <div class="form-group">

        <Label for="Eid">Employee ID:</Label>        

        <input type="text" name="eid" class="form-control"><br>

       </div>



<br>

       <div class="form-group">

        

        <button type="submit" value="clock" name="clock" class="btn btn-outline-success btn-block btn-lg form-control" >

             <i class="bi bi-clock-history"></i>  Check Clockin

           </button>

       </div>

       <br>

     

        

    </form>

    <?php

}







if($clockst=="clockoutRE"){

                                      
    
    $empid=$_GET['id'];

    $name=$_GET['name'];

    $sql = "SELECT * FROM `clockin` WHERE `empID` = $empid AND `clockDay` = '$sdt';";

                   $result = $conn->query($sql);

                   if ($result->num_rows > 0) {

                       while ($row = mysqli_fetch_assoc($result)) {

                            $clock=$row['clockinID'];

                            $clockin=$row['clockTime'];

                            $dis=$row['description'];

                       }

                                            ?>

                           

                           <form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-primary border border-end-0 border-warning rounded-3">

                            <div class="form-group ">

      

                             <h3 class="modal-title"><i class="bi bi-people"></i> <?php echo "Clock out ".$name; ?></h3>

                             <small><?php echo $name ." already clocked in today at " .$clockin .". Do you need to clock " .$name." out now?"?></small>

                                 </div>

                             <hr>

                            <div class="form-group">

                            <Label for="Eid">Employee ID:</Label>        

                         <input type="text" name="eid" class="form-control" value="<?php echo $empid ?>" readonly="readonly"><br>

                            </div>

                            <div class="form-group">

                            <Label for="Eid">Employee Name:</Label>        

                            <input type="text" name="ename" class="form-control" value="<?php echo $name ?>" readonly="readonly"><br>

                            </div>
                            <div class="form-group">

                            <Label for="Eid">Why are you clocking out early:</Label>
                             <select name="reason" class="form-control">
                                    <option value="Field Assignment">Field Assignment</option>
                                    <option value="Attending A meeting">Attending A meeting</option>
                                    <option value="Visiting An External Client">Visiting An External Client</option>
                                    <option value="Taking A Day Off">Taking A Day Off</option>
                                    <option value="Other">Other...</option>   

                                    </select>    

                            

                            </div>



                            <br>

                            <div class="form-group">

        

                            <button type="submit" value="clockout" name="clockout" class="btn btn-outline-success btn-block btn-lg form-control" >

                             <i class="bi bi-clock-history"></i>  Clock Out <?php echo $name?>

                         </button>

                         </div>

                             <br>

     

        

    </form>

                           <?php

                      

                   }
}










if($clockst=="clockin")                  

                   

                   

                   {

                       

                       $empid=$_GET['id'];

    $name=$_GET['name'];

                       ?>

<form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-primary border border-end-0 border-warning rounded-3">

                            <div class="form-group ">

      

                             <h3 class="modal-title"><i class="bi bi-people"></i> <?php echo "Clock In ".$name; ?></h3>

                             <small><?php echo $name ." has not clocked in today. Do you need to clock " .$name." in now?"?></small>

                                 </div>

                             <hr>

                            <div class="form-group">

                            <Label for="Eid">Employee ID:</Label>        

                            <input type="text" name="eid" class="form-control" value="<?php echo $empid ?>" readonly="readonly"><br>

                            </div>

                            <div class="form-group">

                            <Label for="Eid">Employee Name:</Label>        

                            <input type="text" name="ename" class="form-control" value="<?php echo $name ?>" readonly="readonly"><br>

                            </div>

                            <div class="form-group">

                            <Label for="Eid">Reason For Clocking In using webportal:</Label>
                             <select name="reason" class="form-control">
                                    <option value="Android Device Not working">Android Device Not working</option>
                                    <option value="On Field">On Field</option>
                                    <option value="On Leave">On Leave</option>
                                    <option value="Other">Other..</option>   

                                    </select>    

                            

                            </div>



                            <br>

                            <div class="form-group">

        

                            <button type="submit" value="clockin" name="clockin" class="btn btn-outline-success btn-block btn-lg form-control" >

                             <i class="bi bi-clock-history"></i>  Clock In <?php echo $name?>

                         </button>

                         </div>

                             <br>

     

        

    </form>






    <?php

                       

                   

}

if($clockst=="clockout")

{

    

    $empid=$_GET['id'];

    $name=$_GET['name'];

    $sql = "SELECT * FROM `clockin` WHERE `empID` = $empid AND `clockDay` = '$sdt';";

                   $result = $conn->query($sql);

                   if ($result->num_rows > 0) {

                       while ($row = mysqli_fetch_assoc($result)) {

                            $clock=$row['clockinID'];

                            $clockin=$row['clockTime'];

                            $dis=$row['description'];

                       }

                                            ?>

                           

                           <form method='POST' enctype="multipart/form-data" action="../files/include.php" class="text-primary border border-end-0 border-warning rounded-3">

                            <div class="form-group ">

      

                             <h3 class="modal-title"><i class="bi bi-people"></i> <?php echo "Clock out ".$name; ?></h3>

                             <small><?php echo $name ." already clocked in today at " .$clockin .". Do you need to clock " .$name." out now?"?></small>

                                 </div>

                             <hr>

                            <div class="form-group">

                            <Label for="Eid">Employee ID:</Label>        

                         <input type="text" name="eid" class="form-control" value="<?php echo $empid ?>" readonly="readonly"><br>

                            </div>

                            <div class="form-group">

                            <Label for="Eid">Employee Name:</Label>        

                            <input type="text" name="ename" class="form-control" value="<?php echo $name ?>" readonly="readonly"><br>

                            </div>



                            <br>

                            <div class="form-group">

        

                            <button type="submit" value="clockout" name="clockout" class="btn btn-outline-success btn-block btn-lg form-control" >

                             <i class="bi bi-clock-history"></i>  Clock Out <?php echo $name?>

                         </button>

                         </div>

                             <br>

     

        

    </form>

                           <?php

                      

                   }
}





}?>

