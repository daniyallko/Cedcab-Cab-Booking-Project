<?php
include('adhead.php');
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); ?>

  <h3 class="text-center">Welcome <?php echo $_SESSION['userdata']['username']; ?></h3>

    <div class="row pl-lg-5">

      <div class="col-sm-6 col-lg-3">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title ">All Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
              $adm = new adminwrk();
            $admc = new dbcon();
            $cn = $adm->countride($admc->conn);
            print_r($cn); ?></p>
            <a href="allrides.php#allr" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Pending Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->pcountride($admc->conn);
            print_r($cn); ?></p>           
             <a  id="penrd" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Completed Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cocountride($admc->conn);
            print_r($cn); ?></p>   
            <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>
  
    </div>

    <div class="row pt-4 pl-lg-5">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Cancelled Rides</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cacountride($admc->conn);
            print_r($cn); ?></p>
             <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Total Earning</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $en = $adm->earn($admc->conn);
            ?>₹<?php echo $en; ?></p>
            <a href="allrides.php#penr" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Total Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $us = $adm->countuser($admc->conn);
             echo $us; ?></p>
            <a href="allusers.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>
    
    </div>

    <div class="row pt-4 pl-lg-5">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Approved Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $au = $adm->acountuser($admc->conn);
            print_r($au); ?></p>
             <a href="allusers.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Pending Users</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $pu = $adm->pcountuser($admc->conn);
             echo $pu; ?></p>
            <a href="aprove.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">All Locations</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $lc = $adm->countloc($admc->conn);
             echo $lc; ?></p>
            <a href="addlocation.php" class="btn btn-primary green">Go To</a>
          </div>
        </div>
      </div>

   
    
    </div>

 <?php 
 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
 include('adfoot.php'); ?>