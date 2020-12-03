<?php 
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); 

if(isset($_GET['action']))
{
    $id=$_GET['id'];
    if($_GET['action']=='yes')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }

    if($_GET['action']=='apr')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }

    if($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }
}
?>

<nav class="nav nav-pills col-sm-10 nav-justified">
  <a class="nav-link btn-light active" href="addlocation.php">All Location</a>
  <a class="nav-link btn-light" href="locat.php">Add Location</a>
</nav>

<div>
  <h3 class="text-center">All locations</h3>
  </div>
  <table id="tbl" class="container-fluid col-lg-10 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>Location id</th>
            <th onclick="sortTable(1,tbl)">Name ⇩</th>
            <th onclick="sortTablen(2,tbl)">Distance ⇩</th>
            <th>Available</th>
            <th>Enable/Disable</th>
            <th>Delete</th>
            <th>Edit</th>
        </thead>
        <tbody>
        <?php 
           $adm = new adminwrk();
           $loc = new dbcon();
           $sloc = $adm->slocation($loc->conn);
           foreach($sloc as $key=>$val)
           {
               echo "<tr><td>".$val['id']."</td><td>".$val['name']."</td><td>".$val['distance']."</td>";
               if($val['is_available']==1)
               {
                    echo "<td>YES</td>";
               }
               if($val['is_available']==0)
               {
               echo "<td>NO</td>";
               }
            
               if($val['is_available']==1)
               {
                    echo "<td><a class='btn btn-warning' href='addlocation.php?action=yes&id=".$val['id']."'>Disable</a></td>";
               }
               if($val['is_available']==0)
               {
               echo "<td><a class='btn btn-success' href='addlocation.php?action=apr&id=".$val['id']."'>Enable</a></td>";
               }
               echo "<td><a class='btn btn-danger' href='addlocation.php?action=no&id=".$val['id']."'>Delete</a></td>";

               echo "<td><a class='btn btn-info' href='editloc.php?action=edit&id=".$val['id']."&name=".$val['name']."&distance=".$val['distance']."&is_available=".$val['is_available']."'>Edit</a></td></tr>"; 
           }
            ?>
        </tbody>
    </table>


  

<?php 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
include('adfoot.php'); ?>