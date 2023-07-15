<?php
date_default_timezone_set('Africa/Nairobi');
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
$domain="";
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