<?php
require "../files/include.php";

if (isset($_POST['Employee_ID'])) {
     if (empty($_POST['reason'])) {
         $response['error']=false;
         $response['act']=true;
         $response['message']="Error: Reason cannot Be Empty";
     }else{
         $empid=$_POST['Employee_ID'];
         $reason=$_POST['reason'];
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
                $response['message']="Error: Sorry you clocked out today at $clockout";
         }else{
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
$desc=$reason;

$sql="INSERT INTO `clockout` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES ('$clockinID','$empid','$sdt','$sdt1','$desc','$clockinstst','$workSTSt')";

                         $result = $conn->query($sql);

                         if (!$result) {
                             // code...
                                            $response['error']=false;
                                            $response['act']=true;
                $response['message']="Error: Sorry $empname Error occured please try again.";

                         } else {
                             // code...
                $response['error']=true;
                $response['message']="Hello $empname you Successfully Clocked Out Date: $sdt Time: $sdt1 and worked for $wrkhr..";
                            

                         }
     }//
         }
     }
}else{
    $response['error']=false;
         $response['act']=true;
         $response['message']="Error: You are no allowed to access this session";
}





echo json_encode($response);
?>