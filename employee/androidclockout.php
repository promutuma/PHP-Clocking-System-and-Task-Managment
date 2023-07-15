<?
require "../files/include.php";

if($clip==$allowedip){


if (isset($_POST['Employee_ID'])) {
    if (empty($_POST['Employee_ID'])) {
        
        $response['error']=false;
        $response['act']=true;
        $response['message']="Error: Employee ID cannot Be Empty";

    } else {
        $empid=$_POST['Employee_ID'];

             $sql="SELECT * FROM `employee` WHERE `empID`= ? ";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("s",$empid);
               $stmt->execute();
               $result = $stmt->get_result();

               if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $empname=$row['surname'];
                $status=$row['status'];
                $empemail=$row['empemail'];
                }

                if ($status==0) {
                    // code...
                                    $response['error']=false;
                                    $response['act']=true;
                $response['message']="Sorry your account has been suspended";
                } else {
                    
                    //check clockout today
                    $sql="SELECT * FROM `clockout` WHERE `empID` = ? AND `clockDay` = ? ";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("is",$empid,$sdt);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
             $workedTime=$row['workedTime'];
             $clockout=$row['clockTime'];
             $wrkhr=foo($workedTime);}
$response['error']=false;
$response['act']=true;
                $response['message']="Sorry you clocked out today at $clockout";
         }else{
                //check worked hrs

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
$desc="Worked for 8hrs";
 if ($workSTSt>=28800) {
                 // code...
                $sql="INSERT INTO `clockout` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES ('$clockinID','$empid','$sdt','$sdt1','$desc','$clockinstst','$workSTSt')";

                         $result = $conn->query($sql);

                         if (!$result) {
                             // code...
                                            $response['error']=false;
                                            $response['act']=true;
                $response['message']="Sorry $empname Error occured please try again.";

                         } else {
                             // code...
                $response['error']=true;
                $response['message']="Hello $empname you Successfully Clocked Out Date: $sdt Time: $sdt1 and worked for $wrkhr..";
                            

                         }
                         
             }else{
                $response['error']=false;
                $response['act']=false;
                $response['empid']="$empid";
                $response['message']="Sorry $empname You cannot clock out now you have worked for less than 8hrs. Please Select the reason for clocking out Early then clock out";
                
             }



                         
                            


}else{
                $response['error']=false;
                $response['act']=true;
                $response['message']="Sorry $empname you never clocked in today.";
}

             }

                }          
                
            } else {
                // code...
                $response['error']=false;
                $response['act']=true;
                $response['message']="Sorry your ID is not registered";
               }

    }
}
}else{
    $response['error']=false;
    $response['act']=true;
                $response['message']="Sorry Invalid Location. Make sure you are at CETRAD Offices";
}




echo json_encode($response);
?>