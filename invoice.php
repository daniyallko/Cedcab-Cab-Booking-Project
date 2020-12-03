<?php

include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php');

            $id=$_GET['id'];
            $adm = new adminwrk();
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

</head>

<body>
<div id="pbox">
    <div class="invoice-box" >
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
    <div class="text-center mt-3 mr-lg-5 pr-lg-5">
    <button id="prnt">Print</button>
    </div>
    
    
<?php 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">You Are not Authorised</h1>';
  }
 include('adfoot.php'); ?>
 