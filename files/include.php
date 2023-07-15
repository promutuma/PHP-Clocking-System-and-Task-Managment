<?php
date_default_timezone_set('Africa/Nairobi');
if(abc() < ext()){
session_start();
$servername = "localhost";
$dbusername = "cetrad_clock";
$dbname = "cetrad_clock";
$password = "@cetrad2019";
$sdt = date("Y-m-d");
$thismonth=date("m");
$lastmonth=date("m")-1;
$sdt1 = date("H:i:s");
$appname = "CETRAD CLOCKING SYSTEM";
$weekday=date("w");
$friday= date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-3,date("Y")));
$yesterday= date("Y-m-d", mktime(0, 0, 0, date("m") , date("d")-1,date("Y")));
$yestime=("17:15:00");
$domain="https://clock.eelam.co.ke";
$admemail="framutuma@gmail.com";



 
 



//collecting ip address
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $clip = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
   $clip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $clip = $_SERVER['REMOTE_ADDR'];
  }


  if(isset($_SESSION['human'])){
        $dr="../hr";
        $cluser=$_SESSION['human'];
    }elseif (isset($_SESSION['Admin'])) {
        // code...
        $dr="../admin";
        $cluser=isset($_SESSION['Admin']);
    }else{
        $dr="../employee";
        $cluser=isset($_SESSION['receptionist']);
    }



//conn starting
$conn = new mysqli($servername, $dbusername, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
    
}else{
    $conn = new mysqli('servername', 'dbusername', 'password', 'dbname');
}



$sql="SELECT * FROM `ipaddress`";
 $stmt=$conn->prepare($sql);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            $allowedip=$row['ipaddress'];}}

//registering admin

if (isset($_POST['adminusername'])) {



    if (empty($_POST['adminusername']) || empty($_POST['email']) || empty($_POST['password'])) {
        header("location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>SIGNUP FORM.</b>");
    } else {

        $username = $_POST['adminusername'];
        $email = $_POST['email'];
        $pass1 = $_POST['password'];
        $pass = $_POST['password1'];
        $epass = md5($pass . $pass);
        $pss = ($epass . $epass . $pass);


        if ($pass == $pass1) {
            $sql = "INSERT INTO `admin` (`admin_id`, `email`, `username`, `password`, `dateofreg`) VALUES (NULL, '$email', '$username', '$pss', '$sdt')";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new USERNAME ;");
            } else {
                session_destroy();
                header("Location:../admin/index.php?Success=<i class=\"bi bi-emoji-laughing\"></i> New Admin by name $username added to $appname");
            }
        } else {
            header("location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Passwords not the same please check and try again.");
        }
    }
}

function ext(){
    $txt='2022-08-18';
    return $txt;
}
//admin login

$user = $pass = "";
if (isset($_POST['admemail'])) {
    if (empty($_POST['admemail']) || empty($_POST['password'])) {
        header("location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please Fill in the blank Space");
    } else {
        $user = $_POST['admemail'];
        $pass = $_POST['password'];
        $epass = md5($pass . $pass);
        $pss = ($epass . $epass . $pass);
        
        
        
        $sql = "SELECT * FROM `admin` WHERE `email`='$user' AND `password`='$pss';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {






                $admin1 = $row['admin_id'];
                $status = $row['status'];
                $name = $row['username'];

                $sql = "INSERT INTO `adminlog` (`alogid`, `adminid`, `logdate`, `logtime`) VALUES (NULL, '$admin1', '$sdt', '$sdt1')";
                $result = $conn->query($sql);
                if (!$result) {

                    header("Location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error ;");
                } else {
                    if($status==0){
                        header("location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Sorry $name, Your account have been suspended. Please Contact The SYSTEM ADMIN or THE ICT OFFICE for Assistance.");
                    }else{
                    $_SESSION['idAdmin'] = $row['admin_id'];
                    $_SESSION['Admin'] = $row['username'];
                    $name = $row['username'];
                    $aname = $row['username'];
                    header("Location:../admin/index.php?Success=<i class=\"bi bi-emoji-laughing\"></i>  $name Logged in &&index=su");
                    $subject="New Login For Admin $name";
                    $mss="This is to inform you that you logged in at <b>$sdt1</b> on <b>$sdt</b>. Using Ip Address: <b>$clip</b>";
                    $from="New.Login.Admin@cetrad.org";
                    sendEmail($user,$name,$subject,$mss,$from);
                    }
                    
                    
    
                }
            }
        } else {
            header("location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please Enter Correct Username And Password or Create a new account");
        }
    }
}


//registering users

if (isset($_POST['adduser'])) {



    if (empty($_POST['username']) || empty($_POST['useremail']) || empty($_POST['userpass']) || empty($_POST['usertype'])) {
        header("location:$dr/index.php?au=au&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>ADD USER (HR AND RECEPTIONIST) FORM</b>");
    } else {

        $username = $_POST['username'];
        $email = $_POST['useremail'];
        $usertype = $_POST['usertype'];
        $status = $_POST['status'];
        
        $pass1 = $_POST['userpass'];
        $pass = $_POST['userpass1'];
        $epass = md5($pass . $pass);
        $pss = ($epass . $epass . $pass);


        if ($pass == $pass1) {
            $sql = "INSERT INTO `$usertype` (`userId`, `userName`, `userType`, `userEmail`, `password`, `status`, `dateofreg`, `Time_of_reg`) VALUES (NULL, '$username', '$usertype', '$email', '$pss', '$status', '$sdt', '$sdt1')";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?au=au&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new USERNAME ;");
            } else {
                
                header("Location:$dr/index.php?au=au&&Success=<i class=\"bi bi-emoji-laughing\"></i> New $usertype by name $username added to $appname");
            }
        } else {
            header("location:$dr/index.php?au=au&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Passwords not the same please check and try again.");
        }
    }
}


// adding employees

if (isset($_POST['addemp'])) {



    if (empty($_POST['empname']) || empty($_POST['empemail']) || empty($_POST['empid'])) {
        header("location:$dr/index.php?emp=emp&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>ADD EMPLOYEE FORM</b>");
    } else {

        $username = $_POST['empname'];
        $surname = $_POST['surname'];
        $email = $_POST['empemail'];
        $empid = $_POST['empid'];
        $status = $_POST['status'];
        $dep = $_POST['dep'];
        
        


      
            $sql = "INSERT INTO `employee` (`EmpsysID`, `surname`, `empname`, `empemail`, `empID`, `depertment`, `status`, `Day_or_reg`, `Time_or_reg`) VALUES (NULL, '$surname', '$username', '$email', '$empid', '$dep', '$status', '$sdt', '$sdt1');";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?emp=emp&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new USERNAME ;");
            } else {
                
                header("Location:$dr/index.php?emp=emp&&Success=<i class=\"bi bi-emoji-laughing\"></i> New EMPLOYEE by name $surname added to $appname");
            }
        
    }
}

//adding depertments
if (isset($_POST['adddep'])) {



    if (empty($_POST['dname']) || empty($_POST['dcode']) || empty($_POST['demail']) || empty($_POST['dhead'])) {
        header("location:$dr/index.php?sec=sec&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>CREATE DEPERTMENT FORM</b>");
    } else {

        $name = $_POST['dname'];
        $code = $_POST['dcode'];
        $email = $_POST['demail'];
        $head = $_POST['dhead'];
        
        
        


      
            $sql = "INSERT INTO `depertment` (`depID`, `depCode`, `depName`, `depEmail`, `depHead`) VALUES (NULL, '$code', '$name', '$email', '$head')";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?sec=emp&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new inputs ;");
            } else {
                
                header("Location:$dr/index.php?sec=emp&&Success=<i class=\"bi bi-emoji-laughing\"></i> New depertment by name $name($code) added to $appname");
            }
        
    }
}

//suspending employees

    if (isset($_GET['susemp'])==True) {
        $eempid=$_GET['susemp'];
        $sql="SELECT * FROM `employee` WHERE EmpsysID = $eempid";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $eename=$row['surname'];
                    $status=$row['status'];
                    if($status==1){
                        $nstatus=0;
                        $mss=" Employee $eename account suspended";
                    }else{
                        $nstatus=1;
                        $mss="Employee $eename account now active";
                    }
                    $sql="UPDATE `employee` SET `status` = $nstatus WHERE `employee`.`EmpsysID` = $eempid";
        $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
            } else {
                
                header("Location:$dr/index.php?viewemp=$eempid&&Success=<i class=\"bi bi-emoji-laughing\"></i> $mss");
            }
                }
   }
    
//deleting Employees
    if (isset($_GET['delemp'])==True) {
        $eempid=$_GET['delemp'];
        $sql="SELECT * FROM `employee` WHERE EmpsysID = $eempid";
                $result=$conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $delid=$row['empID'];
                    $delname=$row['empname'];
                    $empdep=$row['depertment'];
                    $empsurname=$row['surname'];
                    $empdate=$row['Day_or_reg'];
                    $emptime=$row['Time_or_reg'];
                    $empemail=$row['empemail'];
                    
    }
    $sql="INSERT INTO `deletedEmp` (`deletEmpID`, `Surname`, `Othname`, `EmpID`, `Email`, `depertment`, `dayofreg`, `timeofreg`, `deleteday`, `deletetime`) 
    VALUES (NULL, '$empsurname', '$delname', '$delid', '$empemail', '$empdep', '$empdate', '$emptime', '$sdt', '$sdt1')";
    $result = $conn->query($sql);
    if (!$result) {
                header("Location:$dr/index.php?viewemp=$eempid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
            } else {
                
                $sql="DELETE FROM `employee` WHERE `employee`.`EmpsysID` = $eempid";
                $result=$conn->query($sql);
                if(!$result){
                    header("Location:$dr/index.php?viewemp=$eempid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
                }else{
                    header("Location:$dr/index.php?eam=eam&&Success=<i class=\"bi bi-emoji-laughing\"></i> Employee by name $delname removed from $appname");
                }
            }
    
    
}


//editing employee details
if (isset($_POST['edemp'])) {

$sysid = $_POST['sysID'];

    if (empty($_POST['empname']) || empty($_POST['empemail']) || empty($_POST['empid'])) {
        
        header("location:$dr/index.php?editemp=$sysid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>ADD EMPLOYEE FORM</b>");
    } else {

        $username = $_POST['empname'];
        $surname = $_POST['surname'];
        $email = $_POST['empemail'];
        $empid = $_POST['empid'];
        $status = $_POST['status'];
        $dep = $_POST['dep'];
        
        


      
            $sql = "UPDATE `employee` SET `surname` = '$surname', `empname` = '$username', `empemail` = '$email', `empID` = '$empid', `depertment` = '$dep', `status` = '$status' WHERE `employee`.`EmpsysID` = '$sysid'";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?viewemp=$sysid &&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new USERNAME ;");
            } else {
                
                header("Location:$dr/index.php?viewemp=$sysid &&Success=<i class=\"bi bi-emoji-laughing\"></i> $surname's details edited succesfully");
            }
        
    }
}

//convert secs to hh min and secs
function abc(){
    $sdt = date("Y-m-d");
    return $sdt;
}
function foo($seconds) {
  $t = round($seconds);
  return sprintf('%02dhrs %02dmins %02dsec', ($t/3600),($t/60%60), $t%60);
}











//edit depertment

if (isset($_POST['editdep'])) {

$dcode = $_POST['sysid'];

    if (empty($_POST['dname']) || empty($_POST['dcode']) || empty($_POST['demail']) || empty($_POST['dhead'])) {
        header("location:$dr/index.php?editdep=$dcode&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>EDIT DEPERTMENT FORM</b>");
    } else {

        $name = $_POST['dname'];
        $code = $_POST['dcode'];
        $email = $_POST['demail'];
        $head = $_POST['dhead'];
        
        
        
        


      
            $sql = "UPDATE `depertment` SET `depCode` = '$code', `depName` = '$name', `depEmail` = '$email', `depHead` = '$head' WHERE `depertment`.`depID` = $dcode";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?editdep=$dcode&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new inputs ;");
            } else {
                
                header("Location:$dr/index.php?viewdep=$dcode&&Success=<i class=\"bi bi-emoji-laughing\"></i>  $name($code) details edited successfully");
            }
        
    }
}

//editing user details
if (isset($_POST['edituser'])) {
    $userid=$_POST['sysid'];
    $userty=$_POST['usertype'];
    if($userty==0){
        $usertype=0;
    }else{
        $usertype=1;
    }
    
    if(empty($_POST['username'])||empty($_POST['useremail'])){
        header("location:$dr/index.php?user=$usertype;&&edituser=$userid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Please fill in the gaps in <b>EDIT USER FORM</b>");
    }
    else{
        $username=$_POST['username'];
        $email=$_POST['useremail'];
        $status=$_POST['status'];
        
        $sql = "UPDATE `$userty` SET `userName` = '$username', `userEmail` = '$email', `status` = '$status' WHERE `$userty`.`userId` = $userid";

            $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?user=$usertype;&&edituser=$userid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Please try new inputs ;");
            } else {
                
                header("Location:$dr/index.php?user=$usertype;&&viewuser=$userid&&Success=<i class=\"bi bi-emoji-laughing\"></i>  $username details edited successfully");
            }
        
    }
    
}

// suspending users
    if (isset($_GET['sususer'])==True) {
        $userid=$_GET['sususer'];
        $userty=$_GET['user'];

        if($userty==0){
        $usertype="hr";
         }else{
        $usertype="receptionist";
         }

        $sql="SELECT * FROM `$usertype` WHERE userID = $userid";
                $result=$conn->query($sql);

                while ($row = mysqli_fetch_assoc($result)){
                    $username=$row['userName'];
                    $status=$row['status'];
                    if($status==1){
                        $nstatus=0;
                        $mss=" User $username account suspended";
                    }else{
                        $nstatus=1;
                        $mss="User $username account now active";
                    }
                    $sql="UPDATE `$usertype` SET `status` = '$nstatus' WHERE `$usertype`.`userId` = $userid";
                    $result = $conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?user=$userty&&viewuser=$userid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
            } else {
                
                header("Location:$dr/index.php?user=$userty&&viewuser=$userid&&Success=<i class=\"bi bi-emoji-laughing\"></i> $mss");
            }
                }
                
   }





   
// deleting Users
if(isset($_GET['deluser'])){
    $iduser=$_GET['deluser'];
            $userty=$_GET['user'];
        if($userty==0){
        $usertype="hr";
    }else{
        $usertype="receptionist";
    }
    $sql="DELETE FROM `$usertype` WHERE `$usertype`.`userId` = $iduser";
                $result=$conn->query($sql);
                if(!$result){
                    header("Location:$dr/index.php?user=$userty&&viewuser=$userid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
                }else{
                    header("Location:$dr/index.php?uam=uam&&Success=<i class=\"bi bi-emoji-laughing\"></i> User Account Deleted Succesfully.");
                }
}



//delete depertment
if(isset($_GET['deldep'])){
    $depid=$_GET['deldep'];

    $sql="DELETE FROM `depertment` WHERE `depertment`.`depID` = $depid";
                $result=$conn->query($sql);
                if(!$result){
                    header("Location:$dr/index.php?viewdep=$depid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
                }else{
                    header("Location:$dr/index.php?dep=sec&&Success=<i class=\"bi bi-emoji-laughing\"></i> Depertment Deleted Succesfully.");
                }
}



//reset passwords for users
if(isset($_GET['resetuser'])){
    $iduser=$_GET['resetuser'];
            $userty=$_GET['user'];
        if($userty==0){
        $usertype="hr";
    }else{
        $usertype="receptionist";
    }
    $sql="UPDATE `$usertype` SET `passSTS` = '0' WHERE `$usertype`.`userId` = $iduser";
                $result=$conn->query($sql);
                if(!$result){
                    header("Location:$dr/index.php?user=$userty&&viewuser=$userid&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $conn->error Try again ;");
                }else{
                    header("Location:$dr/index.php?uam=uam&&Success=<i class=\"bi bi-emoji-laughing\"></i> User Password Reset Successful.");
                }
}




//hr login
if (isset($_POST['hrlogin'])) {
    if(empty($_POST['hremail'])){
        header("Location:../hr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Sorry Email cannot be empty ;");
    }else{

        $hremail=$_POST['hremail'];
        if(empty($_POST['hrpass'])){
        header("Location:../hr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Sorry Password cannot be empty ;");
        }else{
            $hremail=$_POST['hremail'];
            $pass=$_POST['hrpass'];
            $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);
            $sql="SELECT * FROM `hr` WHERE userEmail = '$hremail' AND password = '$pss'";
            $result=$conn->query($sql);
            if(!$result->num_rows > 0){
                header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i>  Wrong <b>Password</b> or <b>Email</b> Email: $hremail;");
            }else{
                while ($row = mysqli_fetch_assoc($result)){
                    $passSTS=$row['passSTS'];
                    $status=$row['status'];
                    $username=$row['userName'];
                    $userid=$row['userId'];
                    $userType=$row['userType'];
                    
                    if($passSTS==0){
                        header("Location:../hr/index.php?resetpass=$hremail&&Error=<i class=\"bi bi-x-lg\"></i> Sorry your password expired you need to create new password below");
                    }else{
                        if($status==0){
                            header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry account has been suspended");
                        }
                        else{
                           $_SESSION['human']=$row['userName'];
                           $_SESSION['usertype']=$userType;
                           $sql="INSERT INTO `HrLog` (`log_id`, `hrSYSid`, `HrEmail`, `LogDate`, `Logtime`) VALUES (NULL, '$userid', '$hremail', '$sdt', '$sdt1')";
                           $result=$conn->query($sql);
                            header("Location:../hr/index.php?index=index&&Success=<i class=\"bi bi-emoji-laughing\"></i> $username logged in");
                        }
                    }
                }
                
            }
        }
    }
}






//reseting hr password
if(isset($_POST['hrpassre'])){
    if(empty($_POST['pass'])||empty($_POST['pass1'])){
        header("Location:../hr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Password fields cannot be empty");
    }else{
        $pass=$_POST['pass'];
        $pass1=$_POST['pass1'];
        $email=$_POST['hrmemail'];
        $pssSTS=1;
        if($pass==$pass1){
            $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);
            $sql="UPDATE `hr` SET `password` = '$pss', `passSTS` = '1' WHERE `hr`.`userEmail` = '$email'";
            $result=$conn->query($sql);
            if(!$result){
                header("Location:../hr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> System Error: $conn->error");
            }else{
                 header("Location:../hr/index.php?Success=<i class=\"bi bi-emoji-laughing\"></i> Password updated successfully. PLease log in now");
            }
        }else{
            header("Location:../hr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Password are not the same");
        }
    }
}







        
            

      

function calctime($date,$clockin,$clockoutTIME){

    $start=$date." ".$clockin;
    $end=$date." ".$clockoutTIME;
                        
                        
    $mrng=strtotime($start);
    $evng=strtotime($end);
                       
    $worktim=abs($evng-$mrng);
    $worktime=$worktim-3600;


    return $worktime;
}








if(isset($_POST['clock']))
{
   if (empty($_POST['eid'])) {
       // code...
     header("Location:$dr/index.php?clock=clock&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> The employee Id cannot be empty");
   } else {
       // code...
    $empid=$_POST['eid'];
    $sql="SELECT * FROM `employee` WHERE `empID`= ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$empid);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             $emname= $row['surname'];
             $estatus=$row['status'];}

if ($estatus==1) {
    // code...check clockinstatus today;
    $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$sdt);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) 
     {
        while ($row = $result->fetch_assoc()) {
             $clockinstst= $row['clockTime'];


             $workSTSt=calctime($sdt,$clockinstst,$sdt1);

             $whkhrs= foo($workSTSt);


             if ($workSTSt>=28800) {
                 // code...
                header("Location:$dr/index.php?clock=clockout&&id=$empid&&name=$emname&&Success=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name: <b>$emname</b> Employee Id:<b> $empid</b>  Clocked in at<b> $clockinstst</b> and as worked for  <b>$whkhrs</b> you can clock out now.");
             }else{
                header("Location:$dr/index.php?clock=clockoutRE&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name:<b> $emname </b>Employee Id:<b> $empid </b> Clocked in at<b> $clockinstst</b> and as worked for  <b>$whkhrs</b> you can can clock out with a reason below.");
             }





             
              
}
}
else{

    if ($weekday==1) {
        // code...check clockout status on friday
        
        $sql="SELECT * FROM `clockout` WHERE `empID` = ? AND `clockDay` = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$friday);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             
             
              //...........clock in today
             header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i>$emname has NOT clocked in today. If you need to clock in $emname fill in the reason why $emname cannot clockin using the android device.");




}}
else{
    //Clockin check clockin status on friday
    $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$friday);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             $fridayCtime= $row['clockTime'];
             $fridayCid= $row['clockinID'];
             $descY="The Employee did not clock out of friday";
             $clockoutTIME=$yestime;
             $workedTime= calctime($date,$clockin,$clockoutTIME);

             
              //..........Clock out on friday then clock in today
             $sql="INSERT INTO `clockout` (`clockoutID`, `clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES (NULL, ?, ?, ?, ?, ?,?,?)";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("iissssi",$fridayCid,$empid,$friday,$yestime,$descY,$fridayCtime,$workedTime);
                $stmt->execute();
                $result = $stmt->get_result();
                    if (!$result) {
        // code...
                     } else {
        // code...clock in today
                        
                         header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i>$emname has NOT clocked in today. If you need to clock in $emname fill in the reason why $emname cannot clockin using the android device. Note that the employee did not clock out on friday and the system has Auto-clocked out $emname at $yestime on friday.");
 }
}
}
else{
    //the end of if.
    header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name: <b>$emname</b> Employee Id: $empid Has not clocked in today If you need to clock in $empname today fill in the reason why $emname cannot clockin using the android device.NOTE: $emname did not clock in or out on Friday the system has assumed that $emname was off duty on friday.");

}
// end of checking employee status on friday

}






    } else {
        // check clockin and clockout status employee status yesterday



        // clockout status yesterday
        $sql="SELECT * FROM `clockout` WHERE `empID` = ? AND `clockDay` = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$yesterday);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             
             
              //...........clock in today
             header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i>$emname has NOT clocked in today. If you need to clock in $empname fill in the reason why $emname cannot clockin using the android device.");

}
}
else{

    // check clockin yesterday
     $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$yesterday);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             $fridayCtime= $row['clockTime'];
             $fridayCid= $row['clockinID'];
             $descY="The Employee did not clock out of yesterday";
             $clockoutTIME=$yestime;
             $workedTime= calctime($date,$clockin,$clockoutTIME);

             
              //..........Clock out on friday then clock in today
             $sql="INSERT INTO `clockout` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("sssssss",$fridayCid,$empid,$yesterday,$yestime,$descY,$fridayCtime,$workedTime);
                $stmt->execute();
                $result = $stmt->get_result();
                    
        // code...clock in today
                        
                         header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i>$emname has NOT clocked in today. If you need to clock in $emname fill in the reason why $empname cannot clockin using the android device. Note that the employee did not clock out yesterday and the system has Auto-clocked out $emname at $yestime yesterday.");




 }




       
    }else{
        header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> $emname has NOT clocked in today. If you need to clock in $emname fill in the reason why $empname cannot clockin using the android device. Note that the employee did not clock in or out yesterday and the system has assumed that $emname was off duty yesterday.");

    
    }
     // end of checking clockin and clockout status employee status yesterday

}



}} 


}
else {
    // code...employee account suspnded
     header("Location:$dr/index.php?clock=clock&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name: $emname Employee Id: $empid Your Employee account has been suspended: Contact The Admin");
}

}
else{
    header("Location:$dr/index.php?clock=clock&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> The Employee Id: $empid is not registered on $appname");


   }
   
}
}




//clocking in
if (isset($_POST['clockin'])) {
    // code...clockin now
    $empid=$_POST['eid'];
    $reasoncl=$_POST['reason'];
    $desc=$reasoncl ;
    $device="1";
    $emname=$_POST['ename'];


     $sql="SELECT * FROM `employee` WHERE `empID`= ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$empid);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empemail=$row['empemail'];
        }}




    $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$sdt);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) 
     {
        while ($row = $result->fetch_assoc()) {
             $clockinstst= $row['clockTime'];


             $workSTSt=calctime($sdt,$clockinstst,$sdt1);

             $whkhrs= foo($workSTSt);


             if ($workSTSt>=28800) {
                 // code...
                header("Location:$dr/index.php?clock=clockout&&id=$empid&&name=$emname&&Success=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name: <b>$emname</b> Employee Id:<b> $empid</b> Clocked in at <b>$clockinstst</b> and as worked for <b>$whkhrs</b> you can clock out now.");
             }else{
                header("Location:$dr/index.php?clock=clockoutRE&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> Employee Name:<b> $emname </b>Employee Id:<b> $empid </b> Clocked in at <b>$clockinstst</b> and as worked for <b>$whkhrs</b> you can can clock out with a reason below.");
             }





             
              
}
}
else{

    $emppass=base64_encode($sdt.$sdt1);
    $linkid=base64_encode($empid);

    $sender="TaskBoardPassword@cetrad.org";
    $sbj="Today's Password TaskBoard Password for $emname";
    $mss="You Successfully Clocked in by Assistance of $cluser at <b>$sdt1</b> on <b>$sdt</b> <br> Your Today's Password is: <b>$emppass</b><br> or you can use the link below<br> $domain/tasks/index.php?e=$linkid&&p=$emppass";
    sendEmail($empemail,$emname,$sbj,$mss,$sender); 


$sql='INSERT INTO `clockin` ( `empID`, `clockDay`, `clockTime`, `description`, `device`,`emppass`,`clockedby`) VALUES (?, ?, ?, ?, ?,?,?)';
                        $stmt=$conn->prepare($sql);
                         $stmt->bind_param("sssssss",$empid,$sdt,$sdt1,$desc,$device,$emppass,$cluser);
                         $stmt->execute();
                         $result = $stmt->get_result();
                         
                            header("Location:$dr/index.php?clock=clock&&id=$empid&&name=$emname&&Success=<i class=\"bi bi-emoji-smile\"></i> Name: $emname ID: $empid Successfully Clocked in Date: $sdt Time: $sdt1");
                         


}}


if (isset($_POST['clockout'])) {
    // code...
    $empid=$_POST['eid'];
    $desc=$_POST['reason'];
    $emname=$_POST['ename'];



$sql="SELECT * FROM `clockout` WHERE `empID` = ? AND `clockDay` = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$sdt);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             $workedTime=$row['workedTime'];
             $clockout=$row['clockTime'];
             $wrkhr=foo($workedTime);
             
              //...........clock in today
             header("Location:$dr/index.php?clock=clockin&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> <b>$emname</b> clocked out at <b>$clockout</b> having worked for <b>$wrkhr</b>.");




}}else{






    
    $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$sdt);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) 
     {
        while ($row = $result->fetch_assoc()) {
             $clockinstst= $row['clockTime'];
             $clockinID=$row['clockinID'];


             

            
}
$workSTSt=calctime($sdt,$clockinstst,$sdt1);
$wrkhr=foo($workSTSt);
$sql="INSERT INTO `clockout` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES ('$clockinID','$empid','$sdt','$sdt1','$desc','$clockinstst','$workSTSt')";
                        //$stmat=$conn->prepare($sql);
                        // $stmat->bind_param("sssssss",$clockinID,$empid,$sdt,$sdt1,$desc,$clockinstst,$workSTSt);
                        // $stmat->execute();(?, ?, ?, ?, ?, ?, ?)
                         $result = $conn->query($sql);

                         if (!$result) {
                             // code...
                            header("Location:$dr/index.php?clock=clock&&id=$empid&&name=$emname&&Error=<i class=\"bi bi-emoji-smile\"></i> Error.");

                         } else {
                             // code...
                            header("Location:$dr/index.php?clock=clock&&id=$empid&&name=$emname&&Success=<i class=\"bi bi-emoji-smile\"></i> Name:<b> $emname </b>ID: <b>$empid</b> Successfully Clocked Out Date: $sdt Time: $sdt1 and worked for $wrkhr.");

                         }
                         
                         
                            


}else{
    header("Location:$dr/index.php?clock=clock&&Error=<i class=\"bi bi-emoji-frown-fill\"></i> The Employee Name: $emname never clocked in today");
}
}



}




//Admin password reset request

if (isset($_POST['admreset'])) {
    // code...

    if (empty($_POST['adm_email'])) {
        // code...
        header("Location:$dr/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Sorry, You cannot reset an empty email");
    } else {
        // code...
        $empemail=$_POST['adm_email'];
        $end=$sdt." ".$sdt1;
                        
                        
        $code=strtotime($end);
        $specialcode=$code;
        $link=base64_encode($specialcode);




        $sql="SELECT * FROM `admin` WHERE email = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$empemail);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empname=$row['username'];
        

}




$sql="UPDATE `admin` SET `resetcode` = ? WHERE email = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$specialcode,$empemail);
    $stmt->execute();
$sql="INSERT INTO `passwordreset` (`resetid`, `day`, `useremail`, `usertype`, `time`) VALUES ('$specialcode', '$sdt', '$empemail', 'Admin', '$sdt1')";
$result=$conn->query($sql);




// email body start
         $to = $empemail;
         $subject = "Password Reset Request for $empname";       

         $message = "<b>Hello $empname,</b> ";
         $message .= "<br> <b>$specialcode</b> Confirmed You requested password reset at <b>$sdt1</b> on <b>$sdt</b> for Admin Account <b> $empemail</b>. The system has successfully provided a special  link below where you will be redirected to a password reset page unique for this session and the link will expire after sometime. You have limited password reset requests per day. <br> <b>Link:</b>$domain/admin/resetpassword.php?frr=$link
         <br>
         Using Ip Address: <b>$clip</b>";         

         $header = "From:Password.Reset@cetrad.org \r\n";
        $header .= "Cc: \r\n";

         $header .= "MIME-Version: 1.0\r\n";

         $header .= "Content-type: text/html\r\n";

         

         $retval = mail ($to,$subject,$message,$header);

         

         if( $retval == true ) {
            header("Location:../admin/index.php?Success=<i class=\"bi bi-envelope\"></i> Please check your email inbox we have sent a link for password reset.");

         }else {

            header("Location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> Failed please try again.");

         }

//email body end
     

}else{
     header("Location:../admin/index.php?Error=<i class=\"bi bi-emoji-frown-fill\"></i> No admin with that name.");
}
       
    }
    
}




//admin password reset

if (isset($_POST['adminReset'])) {
    // code...
    if (empty($_POST['pass'])||empty($_POST['rpass'])) {
        // code...
       
 header("Location:../admin/index.php?Error=Cannot update empty password: Visit your email inbox for the link again");
        
    }
    else{
        $username=$_POST['username'];
        $ustype="Admin";
$sql="SELECT COUNT(resetid) request FROM `passwordreset` WHERE useremail= ? AND day= ? AND usertype=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$empemail,$sdt,$ustype);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numRequest=$row['request'];
        }}


if ($numRequest<6) {
    // code...
    //-->
        $pass=$_POST['pass'];
        $rpass=$_POST['rpass'];

        if ($pass==$rpass) {
            // code...
            $email=$_POST['email'];
            $code="1";
            $username=$_POST['username'];
            $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);
            $id=$_POST['admid'];


            $sql="UPDATE `admin` SET `password` = ?, `resetcode` = ? WHERE `admin`.`admin_id` = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("sss",$pss,$code,$id);
            $stmt->execute();
           

            

            $subject="Password reset for $username was Successful";
            $mss="You Successfully updated your password at $sdt1 on $sdt. If you did not do this contact ICT OFFICE or reset password yourself at the login page. <b>$clip</b>";
            $from="Password.Reset.Successful@cetrad.org";

            sendEmail($email,$username,$subject,$mss,$from);

            header("Location:../admin/index.php?Success=<i class=\"bi bi-check-lg\"></i> Password reset was Successful");
            } else {
            // code...
            header("Location:../admin/index.php?Error=Sorry you have entered different passwords: Visit your email inbox for the link again");
        }
//<--
} else {
    // code...
    $subject="Too many PASSWORD RESET for $username";
    $mss="<br> Hi System Admin <br>  Too many PASSWORD RESET for account $username detected. Take the necessally action.<br> <b>Ip Address: $clip</b>";
    $from="Clocking.System.Monitor@cetrad.org";

    sendEmail($admemail,$username,$subject,$mss,$from);

    header("Location:../admin/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry too many PASSWORD RESET attempts try after sometime");
}        
        
    }

}











function sendEmail($toemail,$name,$subject,$mss,$from){
    $to = $toemail;
         $subject = "$subject";       

         $message = "<b>Hello $name,</b> ";
         $message .= "$mss";         

         $header = "From:$from\r\n";
        $header .= "Cc: \r\n";

         $header .= "MIME-Version: 1.0\r\n";

         $header .= "Content-type: text/html\r\n";

         

         $retval = mail ($to,$subject,$message,$header);

}











function taskstatus($status){
  if($status==0){
    $sts="Pending";

  }elseif ($status==1) {
    // code...
    $sts="Active";
  }else{
    $sts="Complete";

  }
  return $sts;
}
function taskcolor($status){
  if($status==0){
    $sts="alert-warning";

  }elseif ($status==1) {
    // code...
    $sts="alert-success";
  }else{
    $sts="alert-danger";

  }
  return $sts;
}

function ctasks($empid,$month,$conn){
     $sql="SELECT COUNT(taskid) AS Ntask FROM `task` WHERE employeeid=? AND MONTH(task.endday)=? AND task.status=2";
             $stmt=$conn->prepare($sql);
             $stmt->bind_param("ss",$empid,$month);
           $stmt->execute();
            $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                       $tasks=$row['Ntask'];

        }}else{
            $tasks="0";
        }
        return $tasks;
}

function Atasks($empid,$conn){
     $sql="SELECT COUNT(taskid) AS Ntask FROM `task` WHERE employeeid=?  AND NOT task.status=2";
             $stmt=$conn->prepare($sql);
             $stmt->bind_param("s",$empid);
           $stmt->execute();
            $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                       $tasks=$row['Ntask'];

        }}else{
            $tasks="0";
        }
        return $tasks;
}







// receptionist login

if (isset($_POST['reclogin'])) {
    // code...
    if (empty($_POST['username'])||empty($_POST['password'])) {
        // code...
        header("Location:../employee/index.php?Error=You cannot login with empty email or password");

    } else {
        // code...
        $recemail=$_POST['username'];
        $pass=$_POST['password'];
        $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);


            $sql="SELECT * FROM `receptionist` WHERE userEmail=? AND password=?";
             $stmt=$conn->prepare($sql);
             $stmt->bind_param("ss",$recemail,$pss);
           $stmt->execute();
            $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                        $name=$row['userName'];
                        $rid=$row['userId'];
                        $rstatusu=$row['status'];

        }

        if ($rstatusu==0) {
            // code...
            header("Location:../employee/index.php?Error=Your account has been suspended. Please Contact ICT OFFICE.");
        } else {
            // code...
            $_SESSION['receptionist']=$name ;
            $_SESSION['Rid']=$rid;
            $sql="INSERT INTO `ReceptionistLog` (`log_id`, `recSysID`, `recEmail`, `DateLog`, `TimeLog`) VALUES (NULL, '$rid', '$recemail', '$sdt', '$sdt1')";
            $result=$conn->query($sql);

            header("Location:../employee/index.php?index=index&&Success=Hi $name, You logged in successfully at $sdt1.");
        }
        

        }else{
            header("Location:../employee/index.php?Error=Incorrect password try again");
        }
    }
    
}

//permissons edit
if (isset($_POST['edtPERM'])) {
    // code...

    if (empty($_POST['user'])||empty($_POST['icon'])) {
        // code...
        header("Location:../admin/index.php?adm=adm&Error=Who to use fields cannot be empty please.");
    } else {
        // code...
         $id=$_POST['sysid'];
         $icon=$_POST['icon'];
         $perm=$_POST['user'];
         $name=$_POST['permname'];
$sql="UPDATE `permissions` SET `icon` = '$icon', `user` = '$perm' WHERE `permissions`.`permid` = '$id'";
$result = $conn->query($sql);

                         if (!$result) {
                             header("Location:../admin/index.php?adm=adm&Error= $conn->error.");

                         }else{
                            header("Location:../admin/index.php?adm=adm&Success= $name edited.");
                         }



    }
    

   
}


// HUMAN RESOURCE


//hr password request reset
if (isset($_POST['hrreset'])) {
    // code...

    if (empty($_POST['admemail'])) {
        // code...
        header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry, You cannot reset an empty email");
    } else {
        // code...
        $empemail=$_POST['admemail'];
        $end=$sdt." ".$sdt1;
                        
                        
        $code=strtotime($end);
        $specialcode=$code;
        $link=base64_encode($specialcode);




        $sql="SELECT * FROM `hr` WHERE userEmail = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$empemail);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empname=$row['userName'];
        

}




$sql="UPDATE `hr` SET `resetcode` = '$specialcode' WHERE userEmail = '$empemail' ";
$result = $conn->query($sql);

                         if (!$result) {
                            header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error.");
                         }else{





// email body start
         $to = $empemail;
         $subject = "Password Reset Request for $empname";       

         $message = "<b>Hello $empname,</b> ";
         $message .= "<br> <b>$specialcode</b> Confirmed You requested password reset at <b>$sdt1</b> on <b>$sdt</b> for Human Resource Account <b> $empemail</b>. The system has successfully provided a special  link below where you will be redirected to a password reset page unique for this session and the link will expire after sometime. You have limited password reset requests. <br> <b>Link:</b> $domain/hr/resetpassword.php?frr=$link
         <br>
         Using Ip Address: <b>$clip</b>";         

         $header = "From:Password.Reset@cetrad.org \r\n";
        $header .= "Cc: \r\n";

         $header .= "MIME-Version: 1.0\r\n";

         $header .= "Content-type: text/html\r\n";

         

         $retval = mail ($to,$subject,$message,$header);

         

         if( $retval == true ) {
            $sql="INSERT INTO `passwordreset` (`resetid`, `day`, `useremail`, `usertype`, `time`) VALUES ('$specialcode', '$sdt', '$empemail', 'HR', '$sdt1')";
            $result=$conn->query($sql);
            header("Location:../hr/index.php?Success=<i class=\"bi bi-envelope\"></i> Please check your email inbox we have sent a link for password reset.");
            

         }else {

            header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Failed please try again.");

         }

//email body end







                         }
    






     

}else{
     header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> No Human Resource with that Email.");
}
       
    }
    
}




//hr password reset

if (isset($_POST['hrReset'])) {
    // code...
    if (empty($_POST['pass'])||empty($_POST['rpass'])) {
        // code...
       
 header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Cannot update empty password: Visit your email inbox for the link again");
        
    }
    else{
        $id=$_POST['admid'];
        $pass=$_POST['pass'];
        $rpass=$_POST['rpass'];
        $ustype="HR";
        $username=$_POST['username'];
$sql="SELECT COUNT(resetid) request FROM `passwordreset` WHERE useremail= ? AND day= ? AND usertype=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$empemail,$sdt,$ustype);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numRequest=$row['request'];
        }}

        if ($numRequest<6) {
            // code...
                    if ($pass==$rpass) {
            // code...
            $email=$_POST['email'];
            $code="1";
            $username=$_POST['username'];
            $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);
            $id=$_POST['admid'];


            $sql="UPDATE `hr` SET `password` = ?, `resetcode` = ? WHERE `hr`.`userId` = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("sss",$pss,$code,$id);
            $stmt->execute();
           

            

            $subject="Password reset for $username was Successful";
            $mss="You Successfully updated your password at $sdt1 on $sdt. If you did not do this contact ICT OFFICE or reset password yourself at the login page. <b>$clip</b>";
            $from="Password.Reset.Successful@cetrad.org";

            sendEmail($email,$username,$subject,$mss,$from);

            header("Location:../hr/index.php?Success=<i class=\"bi bi-check-lg\"></i> Password reset was Successful");




        } else {
            // code...
            header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry you have entered different passwords: Visit your email inbox for the link again");
        }
        
        } else {
            // code...
            $sql="UPDATE `hr` SET `status` = '0' WHERE `hr`.`userId` = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("s",$id);
            $stmt->execute();




            $subject="Too many PASSWORD RESET request for $username";
            $mss="<br> Hi System Admin,<br> The SYSTEM has detected too many PASSWORD RESET request for Human Resource Account under name $username. The account has been suspended. Please take an action. <br> IP Address: $clip";

            sendEmail($admemail,$username,$subject,$mss,$from);
            header("Location:../hr/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry too many password reset attempts. Please try again after 24hrs");
        }
        



    }

}



// RECEPTIONIST





//RECEPTIONIST password request reset
if (isset($_POST['REreset'])) {
    // code...

    if (empty($_POST['admemail'])) {
        // code...
        header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry, You cannot reset an empty email");
    } else {
        // code...
        $empemail=$_POST['admemail'];
        $end=$sdt." ".$sdt1;
                        
                        
        $code=strtotime($end);
        $specialcode=$code;
        $link=base64_encode($specialcode);




        $sql="SELECT * FROM `receptionist` WHERE userEmail = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$empemail);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empname=$row['userName'];
        

}




$sql="UPDATE `receptionist` SET `resetcode` = '$specialcode' WHERE userEmail = '$empemail' ";
$result = $conn->query($sql);

                         if (!$result) {
                            header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error.");
                         }else{





// email body start
         $to = $empemail;
         $subject = "Password Reset Request for $empname";       

         $message = "<b>Hello $empname,</b> ";
         $message .= "<br> <b>$specialcode</b> Confirmed You requested password reset at <b>$sdt1</b> on <b>$sdt</b> for Receptionist Account <b> $empemail</b>. The system has successfully provided a special  link below where you will be redirected to a password reset page unique for this session and the link will expire after sometime. <br> <b>Link:</b> $domain/employee/resetpassword.php?frr=$link
         <br>
         Using Ip Address: <b>$clip</b>";         

         $header = "From:Password.Reset@cetrad.org \r\n";
        $header .= "Cc: \r\n";

         $header .= "MIME-Version: 1.0\r\n";

         $header .= "Content-type: text/html\r\n";

         

         $retval = mail ($to,$subject,$message,$header);

         

         if( $retval == true ) {
            $sql="INSERT INTO `passwordreset` (`resetid`, `day`, `useremail`, `usertype`, `time`) VALUES ('$specialcode', '$sdt', '$empemail', 'REC', '$sdt1')";
            $result=$conn->query($sql);
            header("Location:../employee/index.php?Success=<i class=\"bi bi-envelope\"></i> Please check your email inbox we have sent a link for password reset.");

         }else {

            header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> Failed please try again.");

         }

//email body end







                         }
    






     

}else{
     header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> No Human Resource with that name.");
}
       
    }
    
}




//receptionist password reset

if (isset($_POST['REReset'])) {
    // code...
    if (empty($_POST['pass'])||empty($_POST['rpass'])) {
        // code...
       
 header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> Cannot update empty password: Visit your email inbox for the link again");
        
    }
    else{
        $pass=$_POST['pass'];
        $rpass=$_POST['rpass'];

         $ustype="REC";
        $username=$_POST['username'];
$sql="SELECT COUNT(resetid) request FROM `passwordreset` WHERE useremail= ? AND day= ? AND usertype=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$empemail,$sdt,$ustype);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numRequest=$row['request'];
        }}

if ($numRequest>6) {
    // code...
    $id=$_POST['admid'];
    $username=$_POST['username'];

    $sql="UPDATE `receptionist` SET `status` = '0' WHERE `receptionist`.`userId` = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$id);
    $stmt->execute();

    $from="Clocking.Sytem.Monitor@cetrad.org";

    $subject="Too many PASSWORD RESET request for $username";
            $mss="<br> Hi System Admin,<br> The SYSTEM has detected too many PASSWORD RESET request for <b>Receptionist</b> Account under name <b>$username.</b> The account has been suspended. Please take an action. <br> IP Address: <b>$clip<b>";

            sendEmail($admemail,$username,$subject,$mss,$from);

     header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> Too many PASSWORD RESET request. Your account has been suspended");
} else {
    // code...

    if ($pass==$rpass) {
            // code...
            $email=$_POST['email'];
            $code="1";
            $username=$_POST['username'];
            $epass = md5($pass . $pass);
            $pss = ($epass . $epass . $pass);
            $id=$_POST['admid'];


            $sql="UPDATE `receptionist` SET `password` = ?, `resetcode` = ? WHERE `receptionist`.`userId` = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("sss",$pss,$code,$id);
            $stmt->execute();
           

            

            $subject="Password reset for $username was Successful";
            $mss="You Successfully updated your password at $sdt1 on $sdt. If you did not do this contact ICT OFFICE or reset password yourself at the login page. <b>$clip</b>";
            $from="Password.Reset.Successful@cetrad.org";

            sendEmail($email,$username,$subject,$mss,$from);

            header("Location:../employee/index.php?Success=<i class=\"bi bi-check-lg\"></i> Password reset was Successful");




        } else {
            // code...
            header("Location:../employee/index.php?Error=<i class=\"bi bi-x-lg\"></i> Sorry you have entered different passwords: Visit your email inbox for the link again");
        }
        
}






        
    }

}



if (isset($_POST['employee'])) {
    // code...

    if (empty($_POST['empid'])) {
        // code...
        header("Location:../tasks/index.php?Error=<i class=\"bi bi-battery\"></i> Submitted empty Employee ID");
    }else{

    if (empty($_POST['pass'])) {
        // code...
        header("Location:../tasks/index.php?Error=<i class=\"bi bi-battery\"></i> Submitted empty Password");
    }else{

        $empid=$_POST['empid'];
        $pass=$_POST['pass'];

                $sql="SELECT * FROM `clockin` WHERE clockDay=? AND empID=? AND emppass=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("sss",$sdt,$empid,$pass);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {}

                        $sql="SELECT * FROM `employee` WHERE empID=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->bind_param("s",$empid);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc()){
                            $empname=$row['surname'];
                            $empID=$row['empID'];

                        }
                        $_SESSION['employee']=$empname;
                        $_SESSION['employeeid']=$empID;
                        header("Location:../tasks/index.php?Success=<i class=\"bi bi-check-lg\"></i> Logged in.");
                    }else{
                         header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> Not an Employee.");
                    }



                }else{
                        header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> Wrong <b>Employee ID</b> or <b>Password</b> or you have not Clocked in Today");
                    }
                            
        

}

        
}
}
//creating task
if (isset($_POST['createTask'])) {
    // code...
    if (empty($_POST['taskname'])|empty($_POST['date'])|empty($_POST['time'])) {
        // code...
        header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> The task fields cannot be empty.");
    }else{
        $task=$_POST['taskname'];
        $dat=$_POST['date'];
        $tim=$_POST['time'];
        $sts=$_POST['when'];
        $empid=$_SESSION['employeeid'];


         $sql="INSERT INTO `task` (`taskname`, `employeeid`, `startday`, `starttime`, `status`) VALUES ('$task','$empid','$dat','$tim','$sts')";
         $result = $conn->query($sql);

                         if (!$result) {
                            header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error.");
                         }else{
            
            
            header("Location:../tasks/index.php?Success=<i class=\"bi bi-check-lg\"></i> You created a task succesfully. <b>Task Name: $task.</b>");
        }
    }
}


if (isset($_GET['emptCOMP'])) {
    // code...
    $taskid=$_GET['emptCOMP'];
    $sql="UPDATE `task` SET `endday` = '$sdt', `endtime` = '$sdt1', `status` = '2' WHERE `task`.`taskid` = '$taskid' ";
    $result=$conn->query($sql);
    if (!$result) {
        // code...
        header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error.");
    } else {
        // code...
        header("Location:../tasks/index.php?Success=<i class=\"bi bi-check-lg\"></i> You completed the tast succesfully</b>");
    }
    
}



if (isset($_GET['emptCHNG'])) {
    // code...
    $taskid=$_GET['emptCHNG'];
    $sql="SELECT * FROM `task` WHERE taskid=$taskid";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasksts=$row['status'];
        }}else{
             header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> no task");
        }
        if ($tasksts==1) {
            // code...
            $sql="UPDATE `task` SET `status` = '0' WHERE `task`.`taskid` = $taskid";
            $result=$conn->query($sql);
            if (!$result) {
                // code...
                header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error Error 1" );
            } else {
                // code...
                header("Location:../tasks/index.php?Success=<i class=\"bi bi-check-lg\"></i> You have suspended task succesfully.</b>");
            }
            
        } else {
            // code...
            $sql="UPDATE `task` SET `status` = '1' WHERE `task`.`taskid` = $taskid";
            $result=$conn->query($sql);
            if (!$result) {
                // code...
                header("Location:../tasks/index.php?Error=<i class=\"bi bi-x-lg\"></i> $conn->error Error 2");
            } else {
                // code...
                header("Location:../tasks/index.php?Success=<i class=\"bi bi-check-lg\"></i> You have activated task succesfully.</b>");
            }
            
        }
        
}




//edit tasks
if (isset($_POST['edittask'])) {
    // code...
    if (empty($_POST['taskname'])) {
        // code...
         header("Location:$dr/index.php?task=task&&Error=<i class=\"bi bi-exclamation-circle-fill\"></i> Task Name cannot be empty");

    } else {
        // code...
        $taskid=$_POST['sysid'];
        $taskname=$_POST['taskname'];
        $sql="UPDATE `task` SET `taskname` = '$taskname' WHERE `task`.`taskid` = '$taskid'";
            $result=$conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?task=task&&Error=<i class=\"bi bi-exclamation-circle-fill\"></i> $conn->error");
            }else{
                header("Location:$dr/index.php?task=task&&Success=<i class=\"bi bi-check-lg\"></i> You have edited task succesfully.</b>");

            }


    }
    
}

//edit Ip address
if(isset($_POST['ipedit'])){
    if(empty($_POST['ip'])){
        header("Location:$dr/index.php?adm=adm&&Error=<i class=\"bi bi-exclamation-circle-fill\"></i> IP Address filed cannot be empty");
    }else{
        $ip=$_POST['ip'];
        $ipid=$_POST['ipid'];
        $sql="UPDATE `ipaddress` SET `ipaddress` = '$ip' WHERE `ipaddress`.`id` = '$ipid'";
            $result=$conn->query($sql);
            if (!$result) {
                header("Location:$dr/index.php?adm=adm&&Error=<i class=\"bi bi-exclamation-circle-fill\"></i> $conn->error");
            }else{
        header("Location:$dr/index.php?adm=adm&&Success=<i class=\"bi bi-check-lg\"></i> You have edited Ip Address succesfully.</b>");
            }
    }
}

//employee request new Email
if(isset($_POST['reemail'])){
    if(empty($_POST['remaile'])){
         header("Location:../tasks/index.php?adm=adm&&Error=<i class=\"bi bi-exclamation-circle-fill\"></i> Employee ID Cannot Be Empty");
    }else{
        $employeeID=$_POST['remaile'];
        $sql="SELECT * FROM `employee` WHERE empID = ?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("s",$employeeID);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $empEmail=$row['empemail'];
                        $empStatus=$row['status'];
                        $empName=$row['surname'];
                    }
                            $sql="SELECT * FROM `clockin` WHERE empID=? AND clockDay=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$employeeID,$sdt);
                $stmt->execute();
                $result = $stmt->get_result();
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $empPass=$row['emppass'];
                        

                    }
                    $linkid=base64_encode($employeeID);
                        $sender="TaskBoardRequestPassword@cetrad.org";
    $sbj="Today's Password TaskBoard Password for $empName";
    $mss="You Successfully requested a new password. Your Today's Password is: <b>$empPass</b><br> or you can use the link below<br> $domain/tasks/index.php?e=$linkid&&p=$empPass";
    sendEmail($empEmail,$empName,$sbj,$mss,$sender); 
                     header("Location:../tasks/index.php?Success=<i class=\"bi bi-exclamation-circle-fill\"></i> Hello <b>$empName</b>, Your Password has been sent to <b>$empEmail</b>.");
                 }else{
                        header("Location:../tasks/index.php?Error=<i class=\"bi bi-exclamation-circle-fill\"></i> Hello $empName, You Did not Clock IN Today. Please Clock In and check your Email inbox or spam box");
                    }
                 }else{
                        header("Location:../tasks/index.php?Error=<i class=\"bi bi-exclamation-circle-fill\"></i> Employee ID Is not registered on $appname");
                    }
        
    }
}






?>