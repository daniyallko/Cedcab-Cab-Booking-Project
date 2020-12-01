<?php

include('adhead.php');
$id= $_GET['id'];
if(isset($_GET['action']))
{
    $d=$_GET['d'];
    
    if($_GET['action']=='blk')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }

    if($_GET['action']=='app')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }
}


include('adsidebar.php');


?>
<nav class="nav nav-pills nav-justified col-sm-10">
    <button class="nav-link btn btn-light " id="allridu">All Rides</button>
    <button class="nav-link btn btn-light " id="penridu">Pending Rides</button>
    <button class="nav-link btn btn-light " id="canridu">Cancelled Rides</button>
    <button class="nav-link btn btn-light " id="comridu">Completed Rides</button>
    <button class="nav-link btn btn-light " id="ernridu">Total Spending</button>
  </nav>

<div class="row">

<div class="mr-2" id="srt">
  <label for="sorting">FILTER BY</label>
  <select name="sortu" id="sortu">
  <option value="" selected hidden disabled>FILTER BY</option>
  <option value="week">Week</option>
  <option value="month">Month</option>
  </select>
  </div>

  <div class="mr-2" id="cfilt">
  <label for="filter">FILTER BY CAB</label>
  <select name="cfil" id="cfil">
  <option value="" selected hidden disabled>FILTER BY</option>
  <option value="CedMini">CedMini</option>
  <option value="CedMicro">CedMicro</option>
  <option value="CedRoyal">CedRoyal</option>
  <option value="CedSUV">CedSUV</option>
  </select>
  </div>
</div>
  

<div id="allru">

  <h3 class="text-center">All Rides</h3>
    
    <table id="tbl" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(4,tbl)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl)">Luggage ⇩</th>
            <th onclick="sortTablen(6,tbl)">Ride Fare ⇩</th>
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
            $showr = $adm->allrideu($id,$admc->conn);
            foreach($showr as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
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
                echo "<td><a class='btn btn-warning' href='usrdetail.php?action=blk&id=".$id."&d=".$val['ride_id']."'>Cancel</a></td>";
              
               echo "<td><a class='btn btn-success' href='usrdetail.php?action=app&&id=".$id."&d=".$val['ride_id']."'>Approve</a></td>";
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
              echo "<td><a class='btn btn-danger' href='usrdetail.php?action=no&id=".$id."&d=".$val['ride_id']."'>Delete</a></td></tr></tr>";
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="penru">

  <h3 class="text-center">Pending Rides</h3>
    
    <table id="tbl1" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl1)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(4,tbl1)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl1)">Luggage ⇩</th>
            <th onclick="sortTablen(6,tbl1)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Cancel</th>
        </thead>
        <tbody id="tbl1c">
        <?php 


            $showp = $adm->penrideu($id,$admc->conn);
            foreach($showp as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
              
                echo "Pending</td>";
        
              echo  "<td>".$val['customer_user_id']."</td>"; 

              if($val['status']==1)
              {
                echo "<td><a class='btn btn-warning' href='usrride.php?action=blk&id=".$val['ride_id']."'>Cancel</a></td>";
            
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Cancel</a></td>";
              }
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="canru">

  <h3 class="text-center">Cancelled Rides</h3>
    
    <table id="tbl2" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl2)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(4,tbl2)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl2)">Luggage ⇩</th>
            <th onclick="sortTablen(6,tbl2)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
        </thead>
        <tbody id="tbl2c">
        <?php 


            $showc = $adm->canrideu($id,$admc->conn);
            foreach($showc as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
              
                echo "Canceled</td>";
              
              echo  "<td>".$val['customer_user_id']."</td>"; 

            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="comru">

  <h3 class="text-center">Completed Rides</h3>
    
    <table id="tbl3" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl3)">Ride Date ⇩</th>
            <th>Pickup Point</th>
            <th>Drop Point</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(4,tbl3)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl3)">Luggage ⇩</th>
            <th onclick="sortTablen(6,tbl3)">Ride Fare ⇩</th>
            <th>Status</th>
            <th>User id</th>
            <th>Invoice</th>
        </thead>
        <tbody id="tbl3c">
        <?php 

            $showm = $adm->comrideu($id,$admc->conn);
            foreach($showm as $key=>$val)
            {
                echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."</td><td>";
              
                echo "Completed</td>";
              
                echo  "<td>".$val['customer_user_id']."</td>"; 

                echo "<td><a class='btn btn-info' href='invoice.php?id=".$val['ride_id']."'>Invoice</a></td></tr>";


            }
        ?>
        </tbody>

    </table>
  </div>

    <div id="ernru">

    <h3 class="text-center">Total Spending</h3>
    <?php 
        $en = $adm->earnu($id,$admc->conn);
        ?>
    <h1 class="text-center font-weight-bold text-dark">₹<?php echo $en; ?></h1>
    </div>


  <?php include('adfoot.php'); ?>