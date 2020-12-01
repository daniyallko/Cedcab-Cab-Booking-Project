<?php
      session_start();
      include ('user.php'); 
      $errors=array();
      $message="";

    if (isset($_POST['submit']))
    {
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        $password2 = isset($_POST['password2'])?$_POST['password2']:'';
        $email = isset($_POST['email'])?$_POST['email']:'';
        $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
        date_default_timezone_set('asia/kolkata');
        $datetime = date("Y-m-d h:i");

        if ($password != $password2) {
            $errors="Password Should be Same";
        }

    $user = new user();
		$dbcon = new dbcon();
		$show=$user->register($username,$password,$password2,$email,$mobile,$datetime,$dbcon->conn);

    }
    include('header.php');
    include('navh.php'); 
 ?>

<body>
	
    <div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Ced<span class="gree">Cab</span></h1>

    <section class="container-fluid box col-lg-10 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <h4 class="font-weight-bold">Register Here</h4>
      </div>
        <form action="register.php" method="post">

            <div class="form-group  row feilds ">
                <label class="col-sm-2">NAME</label>
                <input name="username" for="username" type="text" class="form-control-plaintext col-sm-10 arro" id="username" placeholder="Enter your name" required>
            </div>

            <div class="form-group  row feilds ">
              <label class="col-sm-2"  for="password">PASSWORD</label>
              <input type="password" name="password" class="form-control-plaintext col-sm-10 arro" id="password" placeholder="Enter Password" required>
          </div>
         
          <div class="form-group  row feilds ">
            <label class="col-sm-2"  for="password2">RE-PASSWORD</label>
            <input type="password" name="password2" class="form-control-plaintext col-sm-10 arro" id="password2" placeholder="Re-Enter Password" required>
            
         </div>
         <p id="pas" class="bg-danger text-center">password should be same</p>
    
        <div class="form-group  row feilds ">
        <label class="col-sm-2">E-MAIL</label>
            <input name="email" for="email" type="text" class="form-control-plaintext col-sm-10 arro" id="email" placeholder="Enter your E-mail" required>
        </div>
      
        <div class="form-group  row feilds ">
        <label class="col-sm-2">MOBILE</label>
            <input name="mobile" for="mobile" type="number" class="form-control-plaintext col-sm-10 arro" id="mobile" placeholder="Enter your Mobile Number" required>
        </div>
      
            <div class="form-group ">
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="register" name="submit" value="Register">
            </div>
        </form>
    </div>
    </section>
  </div>
		
	
<?php include('footer.php'); ?>