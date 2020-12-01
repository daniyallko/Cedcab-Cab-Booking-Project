
<?php 
include('adhead.php');
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); 

if(isset($_GET['action']))
{
    $id=$_GET['id'];
    
    if($_GET['action']=='blk')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->yesno($ap,$id,$admc->conn);
    }

    if($_GET['action']=='app')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->yesno($ap,$id,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->yesno($ap,$id,$admc->conn);
    }
}
?>

<nav class="nav nav-pills nav-justified col-sm-10">
  <a class="nav-link btn-light active" href="allusers.php">All Users</a>
  <a class="nav-link btn-light" href="aprove.php">Pending/Blocked Users</a>
</nav>

<div class="container-fluid">
  <h3 class="text-center">All Users</h3>
    
    <table id='tbl' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>User id</th>
            <th onclick='sortTable(1,tbl)'>Name ⇩</th>
            <th onclick='sortTable(2,tbl)'>Email ⇩</th>
            <th onclick='sortTable(3,tbl)'>Date of signup ⇩</th>
            <th onclick='sortTablen(4,tbl)'>Mobile ⇩</th>
            <th>Approve/Block</th>
            <th>Delete</th>
        </thead>
        <tbody>
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $show = $adm->newuser($admc->conn);
            foreach($show as $key=>$val)
            {
              echo "<tr><td>".$val['user_id']."</td><td>".$val['name']."</td><td>".$val['user_name']."</td><td>".$val['dateofsignup']."</td><td>".$val['mobile']."</td></td>"; 
              if($val['isblock']==1)
              {
                echo "<td><a class='btn btn-warning' href='allusers.php?action=blk&id=".$val['user_id']."'>Block</a></td>";
              }
              if($val['isblock']==0)
              {
               echo "<td><a class='btn btn-success' href='allusers.php?action=app&id=".$val['user_id']."'>Approve</a></td>";
              }
              echo "<td><a class='btn btn-danger' href='allusers.php?action=no&id=".$val['user_id']."'>Delete</a></td>";
            
              echo "<td><a class='btn btn-danger' href='usrdetail.php?id=".$val['user_id']."'>Details</a></td></tr>";
            }

        ?>
        </tbody>
    </table>
  </div>

  <?php 
  
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
  
  include('adfoot.php'); ?>