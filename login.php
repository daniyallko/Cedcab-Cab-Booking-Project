<?php
      session_start();
	  include ('user.php'); 
	  $errors = array();
      $message = '';

	  if (isset($_POST['submit']))
	  {
		  $user_name = isset($_POST['email'])?$_POST['email']:'';
		  $password = isset($_POST['password'])?$_POST['password']:'';

		  $user = new user();
		  $dbcon = new dbcon();
		  $show=$user->login($user_name,$password,$dbcon->conn);
        }
        
		include('header.php'); 
		include('navh.php'); 
 ?>

<body>
	<div id="wrapper">

	<div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Ced<span class="gree">Cab</span></h1>

    <section class="container-fluid box col-lg-10 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <h4 class="font-weight-bold">Login Here</h4>
      </div>
        <form action="login.php" method="post">

		<div class="form-group  row feilds ">
        <label class="col-sm-2">E-MAIL</label>
            <input name="email" for="email" type="text" class="form-control-plaintext col-sm-10 arro" id="email" placeholder="Enter your E-mail" required>
		</div>
		
		<div class="form-group  row feilds ">
              <label class="col-sm-2"  for="password">PASSWORD</label>
              <input type="password" name="password" class="form-control-plaintext col-sm-10 arro" id="password" placeholder="Enter Password" required>
		  </div>
		  
		  <div class="form-group ">
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="login" name="submit" value="Login">
            </div>
        </form>
    </div>
    </section>
  </div>

    <?php include('footer.php'); ?>