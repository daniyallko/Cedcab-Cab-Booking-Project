<?php
session_start();

if(isset($_POST['book']))
{ 
   $lugg = isset($_POST['lugg'])?$_POST['lugg']:0;
  $_SESSION['book']['pickup']=$_POST['pickup'];
  $_SESSION['book']['drop']=$_POST['drop'];
  $_SESSION['book']['cabtype']=$_POST['cabtype'];
  $_SESSION['book']['lugg']=$lugg;
  echo '<script>alert("Please Login to BOOK a ride");
       window.location.href = "login.php";</script>';
}
if(isset($_SESSION['userdata']))
{
    header('Location: indexlog.php');
}
else{
include('adminwrk.php');

include('header.php');

include('navh.php'); 

include('body.php');

include('footer.php'); }
?>