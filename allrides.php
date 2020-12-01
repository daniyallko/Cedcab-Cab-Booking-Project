<?php 
include('adhead.php');
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
    <button class="nav-link btn btn-light " id="allrid">All Rides</button>
    <button class="nav-link btn btn-light " id="penrid">Pending Rides</button>
    <button class="nav-link btn btn-light " id="canrid">Cancelled Rides</button>
    <button class="nav-link btn btn-light " id="comrid">Completed Rides</button>
    <button class="nav-link btn btn-light " id="ernrid">Total Earning</button>
  </nav>
  <div id="srt">
  <label for="filter">FILTER BY</label>
  <select name="sort" id="sort">
  <option value="" selected hidden disabled>FILTER BY</option>
  <option value="week">Week</option>
  <option value="month">Month</option>
  </select>
  </div>

  <div id="cfilt">
  <label for="filter">FILTER BY CAB</label>
  <select name="cfil" id="cfil">
  <option value="" selected hidden disabled>FILTER BY</option>
  <option value="CedMini">CedMini</option>
  <option value="CedMicro">CedMicro</option>
  <option value="CedRoyal">CedRoyal</option>
  <option value="CedSUV">CedSUV</option>
  </select>
  </div>
  

<div id="allr">

  <h3 class="text-center">All Rides</h3>
    
    <table id='tbl' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>Ride id</th>
            <th onclick="sortTable(1,tbl)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(5,tbl)">Distance ⇩</th>
            <th>Luggage</th>
            <th onclick="sortTablen(7,tbl)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Cancel</th>
            <th>Approve</th>
            <th>Invoice</th>
            <th>Delete</th>
        </thead>
        <tbody id="tblc">
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $show = $adm->allride($admc->conn);
            foreach($show as $key=>$val)
            {
              echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
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

              if($val['status']==1)
              {
                echo "<td><a class='btn btn-warning' href='allrides.php?action=blk&id=".$val['ride_id']."'>Cancel</a></td>";
              
               echo "<td><a class='btn btn-success' href='allrides.php?action=app&id=".$val['ride_id']."'>Approve</a></td>";
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Cancel</a></td>";
              
                echo "<td><a class='btn btn-success disabled' >Approve</a></td>";
              }
              if($val['status']==2)
              {
                echo "<td><a class='btn btn-info' href='invoice.php?id=".$val['ride_id']."'>Invoice</a></td>";
              }
              else{
                echo "<td><a class='btn btn-info disabled'>Invoice</a></td>";
              }
              echo "<td><a class='btn btn-danger' href='allrides.php?action=no&id=".$val['ride_id']."'>Delete</a></td></tr></tr>";
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="penr">

  <h3 class="text-center">Pending Rides</h3>
    
    <table id='tbl1' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>Ride id</th>
            <th onclick="sortTable(1,tbl1)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(5,tbl1)">Distance ⇩</th>
            <th>Luggage</th>
            <th onclick="sortTablen(7,tbl1)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Cancel</th>
            <th>Approve</th>
            <th>Delete</th>
        </thead>
        <tbody id="tbl1c">
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $pen = $adm->penride($admc->conn);
            foreach($pen as $key=>$val)
            {
              echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
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

              if($val['status']==1)
              {
                echo "<td><a class='btn btn-warning' href='allrides.php?action=blk&id=".$val['ride_id']."'>Cancel</a></td>";
              
               echo "<td><a class='btn btn-success' href='allrides.php?action=app&id=".$val['ride_id']."'>Approve</a></td>";
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Cancel</a></td>";
              
                echo "<td><a class='btn btn-success disabled' >Approve</a></td>";
              }
              echo "<td><a class='btn btn-danger' href='allrides.php?action=no&id=".$val['ride_id']."'>Delete</a></td></tr></tr>";
            }
        ?>
        </tbody>
    </table>
  </div>

  <div id="canr">

  <h3 class="text-center">Cancelled Rides</h3>
    
    <table id='tbl2' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>Ride id</th>
            <th onclick="sortTable(1,tbl2)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(5,tbl2)">Distance ⇩</th>
            <th>Luggage</th>
            <th onclick="sortTablen(7,tbl2)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Delete</th>
        </thead>
        <tbody id="tbl2c">
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $can = $adm->canride($admc->conn);
            foreach($can as $key=>$val)
            {
              echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
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

              echo "<td><a class='btn btn-danger' href='allrides.php?action=no&id=".$val['ride_id']."'>Delete</a></td></tr></tr>";
            }
        ?>
        </tbody>

    </table>
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
              echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
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

              echo "<td><a class='btn btn-danger' href='allrides.php?action=no&id=".$val['ride_id']."'>Delete</a></td></tr></tr>";
            }
        ?>
        </tbody>
    </table>
  </div>

  <div id="ernr">

<h3 class="text-center">Total Earnings</h3>
<?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $en = $adm->earn($admc->conn);
            ?>
  <h1 class="text-center font-weight-bold text-dark">₹<?php echo $en; ?></h1>
</div>

<?php }
          
       else{
         echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
       }
          
include('adfoot.php'); ?>

