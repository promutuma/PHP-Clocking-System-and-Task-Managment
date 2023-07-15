<?php
require_once '../files/include.php';
if(isset($_GET['logout']))
{
    session_destroy();
    header("location:index.php");
}
else
{
    header("location:index.php?Invalid=You are Logged out Please Login");
}

?>