<?php 
if(isset($_SESSION['book'])){
 $p = $_SESSION['book']['pickup'];
 $d = $_SESSION['book']['drop'];
 $c = $_SESSION['book']['cabtype'];
 $l = $_SESSION['book']['lugg'];
}
?>
<body>
<div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Book a City Taxi to your destination in town</h1>
    <h5 class="text-center ">Choose from a range of categories and prices</h5>
    <section class="container-fluid box col-lg-4 col-sm-10 col-xs-12 col-md-7 ml-lg-5 ml-md-5 pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <div class="tup1">
          <button class="btn btn-primary green btn-sm tup font-weight-bold">CITY TAXI</button><hr>
        </div>
        <h4 class="font-weight-bold">Your everyday travel partner</h4>
        <h6>AC cabs for point to point travel</h6>
      </div>
        <form action="body.php" method="post">
            <div class="form-group  row feilds ">
                <label class="col-sm-3"  for="pickup">PICKUP</label>
                <select  class="form-control-plaintext col-sm-9 arro choose" id="pickup">
                <option <?php if(isset($id)){ echo "value= ".$p; } ?> hidden><?php if(isset($p)){ echo $p; } ?></option>
                  <option value="" class="text-secondary" selected disabled hidden>Current Location</option>
                  <?php
                  $adm = new adminwrk();
                  $admc = new dbcon();
                  $show = $adm->fetloc($admc->conn); 
                  ?>
                  <?php foreach($show as $key=>$val){?>
                  <option value="<?php echo $val['name']; ?>"<?php if(isset($p)){ if($p== $val['name']) { ?>selected<?php } }?> ><?php echo $val['name']; ?></option>
                  <?php } ?>
                </select>
            </div>
            <p id="ep" class="bg-danger text-center">Enter pickup point</p>
            <div class="form-group  row feilds ">
              <label class="col-sm-3"  for="drop">DROP</label>
              <select  class="form-control-plaintext col-sm-9 arro choose" id="drop">
              <option <?php if(isset($id)){ echo "value= ".$d; } ?> hidden><?php if(isset($d)){ echo $d; } ?></option>
                <option value=""  selected disabled hidden>Enter drop for ride estimate</option>
                <?php
                  $adm = new adminwrk();
                  $admc = new dbcon();
                  $show = $adm->fetloc($admc->conn); 
                  ?>
                  <?php foreach($show as $key=>$val){?>
                  <option value="<?php echo $val['name']; ?>" <?php if(isset($d)){ if($d== $val['name']) { ?>selected<?php } }?>><?php echo $val['name']; ?></option>
                  <?php } ?>
              </select>
          </div>
          <p id="ed" class="bg-danger text-center">Enter Droping point</p>
          <div class="form-group  row feilds ">
            <label class="col-sm-3"  for="cabtype">CAB TYPE</label>
            <select  class="form-control-plaintext col-sm-9 arro" id="cabtype">
              <option value=""  selected disabled hidden>Drop down to select CAB type</option>
              <option <?php if(isset($id)){ echo "value= ".$c; } ?> hidden><?php if(isset($c)){ echo $c; } ?></option>
              <option value="CedMicro" <?php if(isset($c)){ if($c== 'CedMicro') { ?>selected<?php } }?>>CedMicro</option>
              <option value="CedMini" <?php if(isset($c)){ if($c== 'CedMini') { ?>selected<?php } }?>>CedMini</option>
              <option value="CedRoyal" <?php if(isset($c)){ if($c== 'CedRoyal') { ?>selected<?php } }?>>CedRoyal</option>
              <option value="CedSUV" <?php if(isset($c)){ if($c== 'CedSUV') { ?>selected<?php } }?>>CedSUV</option>
            </select>
        </div>
        <p id="ec" class="bg-danger text-center">Enter Cabtype</p>
        <div class="form-group  row feilds ">
          <label class="col-sm-3" for="luggage">LUGGAGE</label>
          <input type="text"  class="form-control-plaintext col-sm-9 arrow" id="lugg" <?php if(isset($l)){ echo "value= ".$l; } ?> placeholder="Enter weight in KG">
          <p id="err" class="text-danger h6">*Luggage is not available in CedMicro</p>
        </div>
        <p id="nu" class="bg-danger text-center">Enter Numeric Weight Value</p>
        <p id="fare" class="green text-center"></p>
        <input type="hidden" id="far" name="fare" value="" >
      
            <div class="form-group ">
                <input type="button" class="btn green btn-primary btn-lg btn-block" id="button4" name="submit" value="Calculate Fare">
            </div>
            <div class="form-group ">
            <a  class="btn btn-success btn-lg btn-block disabled" id="rbook" name="rbook" >Ride Booked Successfully</a>
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="book" name="book" value="Book Now">
            </div>
        </form>
    </div>
    </section>
  </div>
  <?php if(isset($_SESSION['book']))
  {
    unset($_SESSION['book']);
    } ?>