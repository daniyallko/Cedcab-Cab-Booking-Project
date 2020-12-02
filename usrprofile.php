<?php
session_start();

include('user.php'); 



if (isset($_POST['change']))
{
    $old = isset($_POST['old'])?$_POST['old']:'';
    $new = isset($_POST['new'])?$_POST['new']:'';
    $rnew = isset($_POST['rnew'])?$_POST['rnew']:'';
    $idp = isset($_POST['id'])?$_POST['id']:'';

    $adm = new user();
    $admc = new dbcon();
    $show = $adm->changep($old,$new,$rnew,$idp,$admc->conn);
}

    $id=$_SESSION['userdata']['user_id'];
    $adm = new user();
    $admc = new dbcon();
    $show = $adm->prof($id,$admc->conn);
    foreach($show as $key=>$val)
    {
        $na=$val['name'];
        $mo=$val['mobile'];
        
    }

    if (isset($_POST['edit']))
{
    $name = isset($_POST['name'])?$_POST['name']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $ida = isset($_POST['id'])?$_POST['id']:'';
    
    $adm = new user();
    $admc = new dbcon();
    $show = $adm->uprof($name,$mobile,$ida,$admc->conn);
}
include('header.php');

include('navs.php');

include('ussidebar.php');

?>
  <nav class="nav nav-pills nav-justified col-sm-10">
    <button class="nav-link btn btn-light " id="edipr">Edit Profile</button>
    <button class="nav-link btn btn-light " id="chpa">Change Password</button>
  </nav>

<div id="edi">
  <h3 class="text-center">Edit Profile</h3>
  <section class="container-fluid box col-lg-7 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
  <form action="usrprofile.php"  method="post">
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="name" >Name</label>
    <input class="form-control-plaintext col-sm-10 " type="text" name="name" id="name" placeholder="Enter Your Name" value="<?php if(isset($na)){ echo $na; } ?>" required>
    </div>
    <div class="form-group  row feilds ">
    <label class="col-sm-2" for="mobile">Mobile</label>
    <input class="form-control-plaintext col-sm-10 " type="text" name="mobile" id="mobile" maxlength="10" placeholder="Enter Mobile Number" <?php if(isset($mo)){echo "value=".$mo ;} ?> required>
    </div>
    <input type="hidden" name="id" id="id" <?php if(isset($id)){ echo "value= ".$id; } ?>>
    <div class="form-group ">
        <input type="submit" class="btn green btn-primary btn-lg btn-block" id="edit" name="edit" value="Edit Profile">
    </div>
    </form>
  </section>
</div>

<div id="cpaa">
  <h3 class="text-center">Change Password</h3>
  <section class="container-fluid box col-lg-7 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
  <form action="usrprofile.php"  method="post">
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="old" >Old Password</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="old" id="old" placeholder="Enter Old Password" required>
  </div>
    
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="new" >New Password</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="new" id="new" placeholder="Enter New Password" required>
  </div>

  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="rnew" >Re-enter New Password</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="rnew" id="rnew" placeholder="Re-Enter New Password" required>
  </div>

    <input type="hidden" name="id" id="id" <?php if(isset($id)){ echo "value= ".$id; } ?>>
    <div class="form-group ">
        <input type="submit" class="btn green btn-primary btn-lg btn-block" id="change" name="change" value="Change Password">
    </div>
    </form>
  </section>
</div>



<?php include('adfoot.php'); ?>