<?php
include('adminwrk.php');
if(isset($_POST['pickup']) || isset($_POST['drop']) || $_POST['cabtype'] || $_POST['lugg']){
$pickup = $_POST['pickup'];
$drop = $_POST['drop'];
$cabtype = $_POST['cabtype'];
$lugg = $_POST['lugg'];
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
//$array = array("Charbagh"=>0,"Indira Nagar"=>10,"BBD"=>30,"Barabanki"=>60,"Faizabad"=>100,"Basti"=>150,"Gorakhpur"=>210);
$dist=0;
$dist = abs($d1-$d2);
$fare=0;
$tdist=$dist;
if($cabtype =='CedMicro'){
    if($dist<=10){
        $fare=50+(13.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=185+(12*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=785+(10.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=1805+(8.50*$tdist);
    }
}
if($cabtype =='CedMini'){
    if($dist<=10){
        $fare=150+(14.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=295+(13*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=945+(11.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2065+(9.50*$tdist);
    }
}
if($cabtype =='CedRoyal'){
    if($dist<=10){
        $fare=200+(15.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=355+(14*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=1055+(12.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2275+(10.50*$tdist);
    }
}
if($cabtype =='CedSUV'){
    if($dist<=10){
        $fare=250+(16.50*$dist);
    }
    elseif ($dist<=60) {
        $tdist= $tdist-10;
        $fare=415+(15*$tdist);
    }
    elseif ($dist<=160) {
        $tdist= $tdist-60;
        $fare=1165+(13.20*$tdist);
    }
    elseif ($dist>160) {
        $tdist= $tdist-160;
        $fare=2485+(11.50*$tdist);
    }
}
if($lugg>0){
    if($cabtype=='CedSUV'){
        if($lugg<=10){
            $fare= $fare+100;
        }
        elseif ($lugg>10 && $lugg<=20) {
            $fare=$fare+200;
        }
        elseif($lugg>20){
            $fare=$fare+400;
        }
    }
    else{
        if($lugg<=10){
            $fare= $fare+50;
        }
        elseif ($lugg>10 && $lugg<=20) {
            $fare=$fare+100;
        }
        elseif($lugg>20){
            $fare=$fare+200;
        }
}
}
$result=array(
    'fare'=>$fare,'dist'=>$dist
);
  echo json_encode($result) ;
}
