<?php 
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); 
$id=$_SESSION['userdata']['user_id'];
if(isset($_GET['action']))
{
    $id=$_GET['id'];
    
    if($_GET['action']=='blk')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }

    if($_GET['action']=='app')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }
}
?>

<nav class="nav nav-pills nav-justified col-sm-10">
    <a class="nav-link btn btn-light " href="allrides.php">All Rides</a>
    <a class="nav-link btn btn-light " href="apenride.php" >Pending Rides</a>
    <a class="nav-link btn btn-light " href="acanride.php" >Cancelled Rides</a>
    <a class="nav-link btn btn-light " href="acomride.php">Completed Rides</a>
  </nav>


  <div id="drp" class="row">


  <div class="mr-2" id="cfilt">
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
  

  <div id="comr">

<h3 class="text-center">Completed Rides</h3>
  
  <table id='tbl3' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
      <thead>
          <th>Ride id</th>
          <th onclick="sortTable(1,tbl3)">Ride Date ⇩</th>
          <th>Pickup Point</th>
          <th>Drop Point</th>
          <th>Cab Type</th>
          <th onclick="sortTablen(5,tbl3)">Distance ⇩</th>
          <th>Luggage</th>
          <th onclick="sortTablen(7,tbl3)">Ride Fare ⇩</th>
          <th>Status</th>
          <th>User id</th>
          <th>Invoice</th>
          <th>Delete</th>
      </thead>
      <tbody id="tbl3c">
      <?php 
          $adm = new adminwrk();
          $admc = new dbcon();
          $com = $adm->comride($admc->conn);
          foreach($com as $key=>$val)
          {
            echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."Rs</td><td>";
            if($val['status']==1)
            {
              echo "Pending</td>";
            }
            if($val['status']==0)
            {
              echo "Canceled</td>";
            }
            if($val['status']==2)
            {
              echo "Completed</td>";
            }
            echo  "<td>".$val['customer_user_id']."</td>"; 

            echo "<td><a class='btn btn-info' href='invoice.php?id=".$val['ride_id']."'>Invoice</a></td>";

            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Please confirm deletion');\" href='acomride.php?action=no&id=".$val['ride_id']."'>Delete</a></td></tr></tr>";
          }
      ?>
      </tbody>
  </table>
</div>


<?php }
          
       else{
         echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
       }
          
include('adfoot.php'); ?>

