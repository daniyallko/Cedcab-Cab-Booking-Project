<?php
session_start();
include('adminwrk.php');

$pickup = $_POST['pickup'];
$drop = $_POST['drop'];
$cabtype = $_POST['cabtype'];
$lugg = $_POST['lugg'];
$far = $_POST['far'];
//$array = array("Charbagh"=>0,"Indira Nagar"=>10,"BBD"=>30,"Barabanki"=>60,"Faizabad"=>100,"Basti"=>150,"Gorakhpur"=>210);
$dist=0;
$adm = new adminwrk();
$admc = new dbcon();
$show = $adm->fetloc($admc->conn); 
$d1=0;
$d2=0;
 foreach($show as $key=>$val){
     if($val['name']==$pickup)
     {
        $d1=$val['distance'];
     }
     if($val['name']==$drop)
     {
         $d2=$val['distance'];
     }
 }
$dist = abs($d1-$d2);
date_default_timezone_set('asia/kolkata');
$datetime = date("Y-m-d h:i");
$id = $_SESSION['userdata']['user_id'];

    $save=$adm->book($pickup,$drop,$cabtype,$dist,$far,$lugg,$datetime,$id,$admc->conn);

?>