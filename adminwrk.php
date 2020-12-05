<?php
 include('user.php'); 
class adminwrk
{
    public $ride_id;
    public $ride_date;
    public $from_distance;
    public $to_distance;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $status;
    public $customer_user_id;
    function newuser($conn)
    {
        $sql = "SELECT * FROM user WHERE is_admin=0";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function yesno($ap,$id,$conn)
    {
        if($ap==1)
        {
            $sql = "UPDATE user SET isblock=1 WHERE user_id=$id";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==2)
        {
            $sql = "UPDATE user SET isblock=0 WHERE user_id=$id";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==0)
        {
            $sql = "DELETE FROM user WHERE user_id=$id";

            if ($conn->query($sql) === TRUE)
            {
                
            } 
            else 
            {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }

    function slocation($conn)
    {
        $sql = "SELECT * FROM location";
        $result = $conn->query($sql);
        $loc=array();
        while($row = $result->fetch_assoc()){
            array_push($loc, $row);
        }
        return $loc;
    }

    function dlocat($ap,$id,$conn)
    {
        if($ap==1)
        {
            $sql = "UPDATE location SET is_available=0 WHERE id=".$id."";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==2)
        {
            $sql = "UPDATE location SET is_available=1 WHERE id=".$id."";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==0)
        {
            $sql = "DELETE FROM location WHERE id=".$id."";

            if ($conn->query($sql) === TRUE)
            {
               
            } 
            else 
            {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }

    function alocation($location,$distance,$available,$conn)
    {
        $errors=array();
            
            $sql = "SELECT * from location WHERE name like '$location'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $errors[] = array('input' => 'result', 'msg' => 'Username already exists');
                echo '<p class="bg-danger text-center">Location already Exists</p>';
            }
        if(count($errors)==0 )
        {   
            $sql = "INSERT INTO location(`name`, `distance`, `is_available`) VALUES('".$location."', '".$distance."', '".$available."')";
            
            if ($conn->query($sql) === true) {
                echo '<p class="bg-success text-center">Location Added Successful</p>';
            }
             else {
               echo '<p class="bg-danger text-center">Something Went wrong</p>';

            }
        }
    }

    function fetloc($conn)
    {
        $sql = "SELECT * FROM location WHERE is_available=1";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function book($pickup,$drop,$cabtype,$dist,$far,$lugg,$datetime,$id,$conn)
    {
        echo $sql = "INSERT INTO ride(`ride_date`,`from_distance`,`to_distance`,`cab_type`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) VALUES('".$datetime."','".$pickup."','".$drop."','".$cabtype."','".$dist."','".$lugg."','".$far."',1,'".$id."')";
        
        if ($conn->query($sql) === TRUE)
            {
               return;
            } 
            else 
            {
                $conn->error;
            }
    }

    function allride($conn)
    {
        $sql = "SELECT * FROM ride";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        
        return $appr;
    }

    function rideup($ap,$id,$conn)
    {
        if($ap==1)
        {
            $sql = "UPDATE ride SET status=2 WHERE ride_id=".$id."";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==2)
        {
            $sql = "UPDATE ride SET status=0 WHERE ride_id=".$id."";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        if($ap==0)
        {
            $sql = "DELETE FROM ride WHERE ride_id=".$id."";

            if ($conn->query($sql) === TRUE)
            {
               
            } 
            else 
            {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }

    function elocation($location,$distance,$available,$id,$conn)
    {
        $errors=array();
            
            $sql = "SELECT * from location WHERE name like '$location' AND id!='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $errors[] = array('input' => 'result', 'msg' => 'Username already exists');
                echo '<p class="bg-danger text-center">Location already Exists</p>';
            }
        if(count($errors)==0 )
        {   
            $sql = "UPDATE location SET name='".$location."', distance='".$distance."', is_available='".$available."' WHERE id=$id";
                
                if ($conn->query($sql) === true) {
                    echo '<p class="bg-success text-center">Location Edited Successful</p>';
                }
                else {
                echo '<p class="bg-danger text-center">Something Went wrong</p>';

                }
        }
    }

    function aprove($conn)
    {
        $sql = "SELECT * FROM user WHERE is_admin=0 AND isblock=0";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function aproved($conn)
    {
        $sql = "SELECT * FROM user WHERE is_admin=0 AND isblock=1";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function canride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=0";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function comride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }
    function penride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=1";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function earn($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2";
        $result = $conn->query($sql);
        $appr=0;
        while($row = $result->fetch_assoc()){
            $appr=$appr+$row['total_fare'];
        }
        return $appr;
    }

    function sort($sot,$id,$conn)
    {
       if($sot=='week'){
        $sql="SELECT * FROM ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
       }
       elseif($sot=='month')
       {
        $sql="SELECT * FROM ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
       }
       elseif($sot=='none')
       {
        $sql = "SELECT * FROM ride";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        
        return $appr;
       }
        
    }
    
    function sortu($sot,$id,$conn)
    {
       if($sot=='week'){
        $sql="SELECT * FROM ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 7 DAY) AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
       }
       elseif($sot=='month')
       {
        $sql="SELECT * FROM ride WHERE ride_date > DATE_SUB(NOW(), INTERVAL 30 DAY) AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
       }
       elseif($sot=='none')
       {
        $sql = "SELECT * FROM ride WHERE customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        
        return $appr;
       }
        
    }

    function countride($conn)
    {
        $sql = "SELECT * FROM ride";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function pcountride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=1";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function cocountride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function cacountride($conn)
    {
        $sql = "SELECT * FROM ride WHERE status=0";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function countuser($conn)
    {
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function acountuser($conn)
    {
        $sql = "SELECT * FROM user WHERE isblock=1";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function pcountuser($conn)
    {
        $sql = "SELECT * FROM user WHERE isblock=0";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function countloc($conn)
    {
        $sql = "SELECT * FROM location";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function iallride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE ride_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function ialluser($cid,$conn)
    {
        $sql = "SELECT * FROM user WHERE user_id='$cid'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function allrideu($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        
        return $appr;
    }

    function penrideu($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=1 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function canrideu($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=0 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function comrideu($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function earnu($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=0;
        while($row = $result->fetch_assoc()){
            $appr=$appr+$row['total_fare'];
        }
        return $appr;
    }


}
?>