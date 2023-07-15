<?
require "../files/include.php";

//if(!$clip==$allowedip){


if (isset($_POST['Employee_ID'])) {
    if (empty($_POST['Employee_ID'])||empty($_POST['encoded_string'])) {
        
        $response['error']=false;
        $response['message']="Employee ID cannot Be Empty or you did not capture your picture.";

    } else {
        $empid=$_POST['Employee_ID'];
        $encoded_string=$_POST['encoded_string'];
        $decoded_string = base64_decode($encoded_string);
        
        $desc ="empID" .$empid."CETRADclock".$sdt."_".$sdt1."SYS.jpg";


                 $sql="SELECT * FROM `employee` WHERE `empID`= ? ";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("s",$empid);
               $stmt->execute();
               $result = $stmt->get_result();

               if ($result->num_rows > 0) {
                // code...
                while ($row = $result->fetch_assoc()) {
                    $empname=$row['surname'];
                $status=$row['status'];
                $empemail=$row['empemail'];
                }

                if ($status==0) {
                    // code...
                                    $response['error']=false;
                $response['message']="Error: Sorry your account has been suspended";
                } else {
                    // code... check if employee cloacked in today

                             $sql="SELECT * FROM `clockin` WHERE `empID` = ? AND `clockDay` = ? ";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$empid,$sdt);
               $stmt->execute();
               $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                        $clockin=$row['clockTime'];
                                

                    }   $response['error']=true;
                $response['message']="Hi $empname, You clocked in at $clockin today.";    
                }else{


         $sql="SELECT MAX(clockinID) AS lastclockinID FROM `clockin` WHERE empID=? AND NOT clockDay=? ";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$empid,$sdt);
               $stmt->execute();
               $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                        $lastclockinID=$row['lastclockinID'];

                    }}
                          

                 $sql="SELECT * FROM `clockin` WHERE empID=? AND clockinID=?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$empid,$lastclockinID);
               $stmt->execute();
               $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {
                        
                        $clockdate=$row['clockDay'];
                        $clocktime=$row['clockTime'];

                    }}


                $sql="SELECT * FROM `clockout` WHERE `empID` = ? AND `clockDay` = ?";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("ss",$empid,$clockdate);
               $stmt->execute();
               $result = $stmt->get_result();
             if ($result->num_rows > 0) 
                 {
                    while ($row = $result->fetch_assoc()) {}
                                $path = 'eimage/'.$desc;
        
        $file = fopen($path, 'wb');
        
        $is_written = fwrite($file, $decoded_string);
        fclose($file);

                    $emppass=base64_encode($sdt.$sdt1);
                     $linkid=base64_encode($empid);

    $sender="TaskBoardPassword@cetrad.org";
    $sbj="Today's Password TaskBoard Password for $empname";
    $mss="You Successfully Clocked in by use of the Android App at <b>$sdt1</b> on <b>$sdt</b> <br> Your Today's Password is: <b>$emppass</b><br> or you can use the link below<br> $domain/tasks/index.php?e=$linkid&&p=$emppass";
    sendEmail($empemail,$empname,$sbj,$mss,$sender); 


                            $sql = "INSERT INTO `clockin` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `device`, `emppass`, `clockedby`) VALUES (NULL, '$empid', '$sdt', '$sdt1', '$desc', '0', '$emppass', 'Android Device')";

                             $result = $conn->query($sql);
                            if (!$result) {
                            $response['error']=false;
                             $response['message']="Error occured. Press the clockin button again."; ;
                            } else {
                
                             $response['error']=true;
                            $response['message']="Hi $empname, You are Clocked In Successfully at $sdt $sdt1. Please have a good day. Please check your email for more.";
                              }
                }else{
                                //clock out last time clocked in
                    $workedTime=calctime($clockdate,$clocktime,$yestime);
                    $descY="The Employee did not clockout on $clockdate";
                    $clockoutTime=$yestime;
                    $sql="INSERT INTO `clockout` (`clockoutID`, `clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `clockinTIME`, `workedTime`) VALUES (NULL, ?, ?, ?, ?, ?,?,?)";
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("iissssi",$lastclockinID,$empid,$clockdate,$yestime,$descY,$clocktime,$workedTime);
                $stmt->execute();
                $result = $stmt->get_result();
                
                    // code...
                      $path = 'eimage/'.$desc;
        
        $file = fopen($path, 'wb');
        
        $is_written = fwrite($file, $decoded_string);
        fclose($file);

                    $emppass=base64_encode($sdt.$sdt1);
                     $linkid=base64_encode($empid);

    $sender="TaskBoardPassword@cetrad.org";
    $sbj="Today's Password TaskBoard Password for $empname";
    $mss="You Successfully Clocked in by use of the Android App at <b>$sdt1</b> on <b>$sdt</b> <br> Your Today's Password is: <b>$emppass</b><br> or you can use the link below<br> $domain/tasks/index.php?e=$linkid&&p=$emppass";
    sendEmail($empemail,$empname,$sbj,$mss,$sender); 


                            $sql = "INSERT INTO `clockin` (`clockinID`, `empID`, `clockDay`, `clockTime`, `description`, `device`, `emppass`, `clockedby`) VALUES (NULL, '$empid', '$sdt', '$sdt1', '$desc', '0', '$emppass', 'Android Device')";

                             $result = $conn->query($sql);
                            if (!$result) {
                            $response['error']=false;
                             $response['message']="Error: You are Not Clocked IN reasons $conn->connect_error. Try again" ;
                            } else {
                
                             $response['error']=true;
                            $response['message']="Hi $empname, You are Clocked In Successfully at $sdt $sdt1. Please have a good day. Please check your email for more.";
                              

                }
                

                    }

}
//



                }       


              } else {
                // code...
                $response['error']=false;
                $response['message']="Sorry your ID is not registered";
               }

    }
}
//}else{
//    $response['error']=false;
         //       $response['message']="Sorry Invalid Location. Make sure you are //at CETRAD Offices";
//}



echo json_encode($response);
?>