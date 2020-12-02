<?php
session_start();
if($_SESSION['userdata']['is_admin']==1)
{
  include('header.php');
  echo '<header>
  <nav  class="navbar navbar-expand-lg">
      <a class="navbar-brand nos" href="#">Ced<span class="gree">Cab</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="fas fa-bars logo text-dark"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            
              <li class="nav-item rbtn">
                  <a class="btn" href="admin.php">Dashboard</a>
                  <a class="btn" href="logout.php">Logout</a>
              </li>
          </ul>
      </div>
  </nav>
</header>';
  echo '<h1 class="text-center text-weight-bold text-dark">ADMIN is not allowed in user area</h1>';
}
else{
$id = $_SESSION['userdata']['user_id'];
include('user.php'); 

include('header.php');

include('navs.php');

include('ussidebar.php');?>
<div class="row ">

      <div class="col-sm-6 col-lg-3">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title ">All Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
              $adm = new user();
            $admc = new dbcon();
            $cn = $adm->countride($id,$admc->conn);
            print_r($cn); ?></p>
            <a href="usrride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Pending Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->pcountride($id,$admc->conn);
            print_r($cn); ?></p>           
             <a  href="usrride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Completed Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cocountride($id,$admc->conn);
            print_r($cn); ?></p>   
            <a href="usrride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>
  
    </div>

    <div class="row pt-4">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-danger text-center">
          <div class="card-body">
            <h5 class="card-title">Cancelled Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cacountride($id,$admc->conn);
            print_r($cn); ?></p>
             <a href="usrride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Total Spendings</h5>
            <p class="card-text font-weight-bold text-dark h1"><?php 
           
            $en = $adm->earn($id,$admc->conn);
            ?>₹<?php echo $en; ?></p>
            <a href="usrride.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>
    
    </div>
    
    <?php
include('adfoot.php');
}?>