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
include('header.php');
include('user.php');
include('navs.php');
if($_SESSION['userdata']['is_admin']==0){
include('ussidebar.php');

            $id=$_GET['id'];
            $adm = new user();
            $admc = new dbcon();
            $shor = $adm->iallride($id,$admc->conn);
            foreach($shor as $key=>$val)
            {
                $rid = $val['ride_id'];
                $cid = $val['customer_user_id'];
                $date = $val['ride_date'];
                $cab = $val['cab_type'];
                $pic = $val['from_distance'];
                $drop = $val['to_distance'];
                $lugg = $val['luggage'];
                $fare = $val['total_fare'];
                $dist = $val['total_distance'];
            }
            $usr = $adm->ialluser($cid,$admc->conn);
            foreach($usr as $key1=>$val1)
            {
                $name = $val1['name'];
                $email = $val1['user_name'];
                $mob = $val1['mobile'];
            }

?>
<!-- <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style> -->
</head>

<body>
<div id="pbox">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <a style="width:100%; max-width:300px;">Ced<span class="gree">Cab</span>
                            </td>
                            
                            <td>
                                Ride id : <?php echo $rid;?><br>
                                Ride Date: <?php echo $date;?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Name<br>
                                E-Mail<br>
                                Mobile
                            </td>
                            
                            <td>
                            <?php echo $name;?><br>
                            <?php echo $email;?><br>
                            <?php echo $mob;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                Cab Type
                </td>
                
                <td>
                <?php echo $cab;?>
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Total Distance
                </td>
                
                <td>
                <?php echo $dist;?> Km
                </td>
            </tr>
            
 
            
            <tr class="item">
                <td>
                    Pickup Location
                </td>
                
                <td>
                <?php echo $pic;?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Drop Location
                </td>
                
                <td>
                <?php echo $drop;?>
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                   Luggage
                </td>
                
                <td>
                <?php echo $lugg;?> Kg
                </td>
            </tr>
            
            <tr class="total">
                <td>Total Fare</td>
                
                <td>Rs 
                <?php echo $fare;?>                
                </td>
            </tr>
        </table>
        
    </div>
    </div>
    <button id="prnt">Print</button>

    





<?php 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
 include('adfoot.php'); }?>