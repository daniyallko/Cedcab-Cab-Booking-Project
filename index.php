<?php
session_start();
if(isset($_SESSION['book']))
{
    unset($_SESSION['book']);
}
if(isset($_POST['book']))
{ 
   $lugg = isset($_POST['lugg'])?$_POST['lugg']:0;
  $_SESSION['book']['pickup']=$_POST['pickup'];
  $_SESSION['book']['drop']=$_POST['drop'];
  $_SESSION['book']['cabtype']=$_POST['cabtype'];
  $_SESSION['book']['lugg']=$lugg;
  $_SESSION['book']['fare']=$_POST['fare'];
  $_SESSION['book']['dist']=$_POST['dist'];
  $_SESSION["time"] = time();  
  echo '<script>alert("Please Login to BOOK a ride");
       window.location.href = "login.php";</script>';
}
if(isset($_SESSION['userdata']))
{
    if($_SESSION['userdata']['is_admin']==0)
    {
        header('Location: dash.php');
    }
    if($_SESSION['userdata']['is_admin']==1)
    {
        header('Location: admin.php');
    }
}
else{
include('adminwrk.php');

include('header.php');

include('navh.php'); 

include('body.php');

include('footer.php'); }
?>