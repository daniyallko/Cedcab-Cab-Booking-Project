<?php
session_start();
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1)
{
    

include('header.php');
include('adminwrk.php'); 
 ?>
<header>
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
  </header>
  <?php
    echo '<h1 class="text-center text-weight-bold text-dark">ADMIN can not Enter User Area</h1>';
}
else {
include('user.php'); 

if(isset($_GET['action']))
{
    if($_GET['action']=='blk')
        {
            $id= $_GET['id'];
            $ap=1;
            $adm = new user();
            $admc = new dbcon();
            $sho = $adm->ridec($ap,$id,$admc->conn);
        }
}
include('header.php');

include('navs.php');

include('ussidebar.php');


?>
<nav class="nav nav-pills nav-justified col-sm-10">
    <a class="nav-link btn btn-light " href="usrride.php" >All Rides</a>
    <a class="nav-link btn btn-light " href="upenride.php">Pending Rides</a>
    <a class="nav-link btn btn-light " href="ucanride.php">Cancelled Rides</a>
    <a class="nav-link btn btn-light " href="ucomride.php">Completed Rides</a>
  </nav>

<div id="drp" class="row p-2">



  <div class="mr-2" id="cfilt" >
  <label for="filter">FILTER BY CAB</label>
  <select name="cfil" id="cfil">
  <option value="" selected>NONE</option>
  <option value="CedMini">CedMini</option>
  <option value="CedMicro">CedMicro</option>
  <option value="CedRoyal">CedRoyal</option>
  <option value="CedSUV">CedSUV</option>
  </select>
  </div>
</div>

<div id="comru">

  <h3 class="text-center">Completed Rides</h3>
    
    <table id="tbl4" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl4)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(4,tbl4)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl4)">Luggage ⇩</th>
            <th onclick="sortTable(6,tbl4)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Invoice</th>
        </thead>
        <tbody id="tbl4c">
        <?php 
            $id=$_SESSION['userdata']['user_id'];
            $adm = new user();
            $admc = new dbcon();
            $showm = $adm->comride($id,$admc->conn);
            foreach($showm as $key=>$val)
            {
                echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." Rs</td><td>";
              
                echo "Completed</td>";
              
                echo  "<td>".$val['customer_user_id']."</td>"; 

                echo "<td><a class='btn btn-info' href='invoiceu.php?id=".$val['ride_id']."'>Invoice</a></td>";

            }
        ?>
        </tbody>

    </table>
  </div>

<?php include('adfoot.php');} ?>