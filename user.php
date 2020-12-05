<?php

require('dbcon.php');

class user{


    public $user_id;
    public $user_name;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $isblock;
    public $password;
    public $is_admin;
    

    function login($user_name,$password,$conn)
    {
        $errors = array();

        
        if(sizeof($errors)==0 )
        {
            $password = md5($password);
             $sql = "SELECT * FROM user WHERE
              `user_name`='$user_name' AND `password`='$password'";
             $result = $conn->query($sql);
 
            
             if ($result->num_rows > 0) {
 
                 while($row = $result->fetch_assoc()){
                     
                     if ($row['is_admin']==1){

                     $_SESSION['userdata'] = array('username'=>$row['name'],'user_id'=>$row['user_id'],'is_admin'=>$row['is_admin']);
                     header('Location: admin.php');
                     }
                     if($row['isblock']==0)
                     {
                        echo '<p class="bg-danger text-center">You are not approved by ADMIN</p>';
                     }
                     if($row['isblock']==1 && $row['is_admin']==0){
                        $_SESSION['userdata'] = array('username'=>$row['name'],'user_id'=>$row['user_id'],'is_admin'=>$row['is_admin']);
                        if(isset($_SESSION['book']))
                        {
                            $pickup = $_SESSION['book']['pickup'];
                            $drop = $_SESSION['book']['drop'];
                            $cabtype = $_SESSION['book']['cabtype'];
                            $lugg = $_SESSION['book']['lugg'];
                            $far = $_SESSION['book']['fare'];
                            $dist= $_SESSION['book']['dist'];
                          
                            date_default_timezone_set('asia/kolkata');
                            $datetime = date("Y-m-d h:i");
                            $id = $_SESSION['userdata']['user_id'];
                            $user = new user();
                            $dbcon = new dbcon();
                            $save=$user->book($pickup,$drop,$cabtype,$dist,$far,$lugg,$datetime,$id,$dbcon->conn);
                            

                            echo '<script>alert("Your Ride request from '.$pickup.' to '.$drop.' BY '.$cabtype.' has been sent");
                            window.location.href = "dash.php";</script>';
                        }
                        else{
                             header('Location: dash.php');
                        }
                        
                       
                     }
                     
                 } 
             }
             
             else 
            {
                $errors[] = array('input'=>'form','msg'=>'Invalid Login Details');
                echo '<p class="bg-danger text-center">Invalid Login Details</p>';
                

            }
         }
         
    }

    function register($username,$password,$password2,$email,$mobile,$datetime,$conn)
     {
        $message = '';
        $errors=array();
        if ($password != $password2) {
            $errors[] = array('input'=>'password','msg'=>'password should be same');
            echo '<p class="bg-danger text-center">password should be same</p>';
        }

        if ($password == $password2) {
            
            $sql = "SELECT * from user WHERE user_name like '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $errors[] = array('input' => 'result', 'msg' => 'Username already exists');
                echo '<p class="bg-danger text-center">E-mail id already registered</p>';
                
            }
        }
        

        if(count($errors)==0 )
        {
            setcookie("email", $email, time() + 60 * 60 * 24);
            $password = md5($password);
            $sql = "INSERT INTO user(`name`, `password`, `user_name`,`mobile`,`dateofsignup`,`isblock`,`is_admin`) VALUES('".$username."', '".$password."', '".$email."', '".$mobile."', '".$datetime."',0, 0)";

            if ($conn->query($sql) === true) {
                echo '<script>alert("Registration Successful, Going to Login Page");
                     window.location.href = "login.php";</script>';
            }
             else {
               // $errors[] = array('input'=>'form','msg'=>$conn->errors);
            }
        }
           
     }

     function allride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function ridec($ap,$id,$conn)
    {
        if($ap==1)
        {
            $sql = "UPDATE ride SET status=0 WHERE ride_id=".$id."";

            if ($conn->query($sql) === TRUE) {
                
              } else {
                echo "Error updating record: " . $conn->error;
              }
        }
    }

    function penride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=1 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function canride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=0 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function comride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }

    function earn($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $appr=0;
        while($row = $result->fetch_assoc()){
            $appr=$appr+$row['total_fare'];
        }
        return $appr;
    }

    function uprof($name,$mobile,$ida,$conn)
    {
        $sql = "UPDATE user SET name='".$name."', mobile='".$mobile."' WHERE user_id=$ida";
            
            if ($conn->query($sql) === true) {
                $_SESSION['userdata']['username'] = $name;
                echo '<script>alert("Profile Updated Successfully");
                window.location.href = "usrprofile.php"</script>';
                
               // echo '<p class="bg-success text-center">Profile Edited Successful</p>';
            }
             else {
               echo '<p class="bg-danger text-center">Something Went wrong</p>';

            }
    }

    function prof($id,$conn)
    {
        $sql = "SELECT * FROM user WHERE user_id='$id'";
        $result = $conn->query($sql);
        $appr=array();
        while($row = $result->fetch_assoc()){
            array_push($appr, $row);
        }
        return $appr;
    }


    function changep($old,$new,$rnew,$idp,$conn)
    {

        $sql = "SELECT * FROM user WHERE user_id='$idp'";
        $result = $conn->query($sql);
        $pass="";
        while($row = $result->fetch_assoc()){
            $pass=$row['password'];
        }
        $old = md5($old);
        
        if($pass==$old)
        {
            $errors=array();
            if ($new != $rnew) {
                $errors[] = array('input'=>'password','msg'=>'password should be same');
                echo '<p class="bg-danger text-center">New password and re-password should be same</p>';
            }

            if(count($errors)==0 )
            {
                $new = md5($new);
                $sql = "UPDATE user SET password='$new' WHERE user_id='$idp'";

                if ($conn->query($sql) === true) {
                    echo '<script>alert("Password Changed Successfuly please Login Again");
                    window.location.href = "logout.php";</script>';
                }
                else {
                echo $conn->errors;
                }
            }
        }
        else{
            echo '<p class="bg-danger text-center">Old Password Does Not Match</p>';
        }
    }

    function countride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function pcountride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=1 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function cocountride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=2 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function cacountride($id,$conn)
    {
        $sql = "SELECT * FROM ride WHERE status=0 AND customer_user_id='$id'";
        $result = $conn->query($sql);
        $count = $result->num_rows;
    
        return $count;
    }

    function sort($sot,$id,$conn)
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
}

?>