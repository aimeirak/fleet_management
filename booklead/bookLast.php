<?php
session_start();

include('../connexion.php');
include('../include/smsender/smssender.php');
if(isset($_SESSION['role'])){ 
    $now = new DateTime();
    $id = $_SESSION['id'];
  $stmt = $connection->prepare('SELECT last_login from fluid_user where id = ?');
  $stmt->bind_param('i',$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $lastLogin = new DateTime($row['last_login']);
  // echo ;
  // echo '<br>';
  // echo ;
  if($lastLogin->format('Y m d') < $now->format('Y m d')){
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
    session_destroy();
    exit($msg);
   
  }
  
  }else{
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
   
   exit($msg);
  
   
  }
if(isset($_POST['send']) && isset($_SESSION['id']) && $_SESSION['role'] == 20 || $_SESSION['role'] == 10 ){
  
    $user_id = intval($_SESSION['id']);
    $driver = ' ';

    

    $start_time =stripslashes($_POST['startT']);
    $end_time = stripslashes($_POST['endT']) ;
   
    $departure = intval(stripslashes($_POST['dep']));
    //$from = mysqli_real_escape_string($connection,$from);
    $destination = intval(stripslashes($_POST['dest']));
    $status = intval(stripslashes($_POST['stat']));
    $departments_id = stripslashes($_POST['nameD']);
    $description = 'booking';          
    $rank = 'pending'; 
    $now  = date("Y-m-d H:i:s");
    //is he made this booking
    $sql_check = "SELECT id FROM fluid_booking WHERE start_time = ? and end_time = ?  and id_user = ?";
    $stmt = $connection->prepare($sql_check);
    $stmt->bind_param('ssi',$start_time,$end_time,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
          echo'<div class="alert alert-danger"> You already booked this time  '.$start_time.' until '. $_POST['et'] .' </div>';
          $stmt->close();
    }
    //=====
    else{
        
        $strSQL = "INSERT into `fluid_booking` (id_user,start_time,end_time,id_place0,id_placef,status_id,departments_id,description,rank,created_at,driver_id) values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt   = $connection->prepare($strSQL);   
        $stmt->bind_param('issssssisss',$user_id,$start_time,$end_time,$departure,$destination,$status,$departments_id,$description,$rank,$now,$driver);        
        $stmt->execute();
        $booked = $stmt->affected_rows;
        if($booked){
            //================getting direction ===================================]]
            $sqlfrom  = "SELECT name  FROM fluid_place where id  = ?";
            $stmtfrom = $connection->prepare($sqlfrom);
            $stmtfrom->bind_param('i',$departure);
            $stmtfrom->execute();
            $result = $stmtfrom->get_result();
            $from = $result->fetch_assoc();
            $nameFrom = $from['name'];
            //====== start to =====]]
            $sqlto  = "SELECT name  FROM fluid_place where id  = ?";
            $stmtto= $connection->prepare($sqlto);
            $stmtto->bind_param('i',$destination);
            $stmtto->execute();
            $result = $stmtto->get_result();
            $to = $result->fetch_assoc();
            $nameTo = $to['name'];
            //======= end to =====]]

            //=======================end  direction fetch ========================]]  

            //================fetching drivers ===================================]]
            //  $_SESSION['phoneNumber'] 
            $apiRuner = new apiHander();
            $enterntained = 1;
            $driver = 30;
            $company = $_SESSION['sub_company'];
            $sql  =  'SELECT  * FROM  fluid_user where live = ? and role = ? and id_subcompany = ? ';
            $stmt =  $connection->prepare($sql); 
            $stmt->bind_param('iii',$enterntained,$driver,$company);
            $stmt->execute();
            $result = $stmt->get_result();
            while($fetchedDriver = $result->fetch_assoc()){
              $smsSent = $apiRuner->sendmessage($fetchedDriver['phone_number'],'New book is pending from www.urugendo.com .'.$_SESSION['username'].' booked from '.$nameFrom.' to  '.$nameTo.'. will start on '.$start_time.' until '. $_POST['et'].' ');
            }
           //=======================end  of driver===============================]]  
           
           //km count
           $kmd  = "SELECT * FROM fluid_booking where id_user = ? order by id desc ";
           $stmtcount = $connection->prepare($kmd);
           $stmtcount->bind_param('i',$user_id);
           $stmtcount->execute();
           $krow =  $stmtcount->get_result();
           $fetchBookingId = $krow->fetch_assoc();
           $bookId = $fetchBookingId['id'];
           $startPlace = $fetchBookingId['id_place0'];
           $endPlace = $fetchBookingId['id_placef'];
           $insert = "INSERT into fluid_km_count (id_booking,id_place0,id_placef) VALUES (?,?,?) ";
           $kmi    = $connection->prepare($insert);
           $kmi->bind_param('iii',$bookId,$startPlace,$endPlace);
           $kmi->execute();
           //end_km

            echo'<div class="alert alert-success"> booked '.$start_time.' until '. $_POST['et'] .' </div>';
            $stmt->close();
        }else{
             echo'<div class="alert alert-danger"> It is not booked</div>';
            }
            
    }
           

}else{
    echo'
    <div class="container">
  <div class="card shadow mt-5">
  <div class=" alert alert-warning text-center m-5"><div class" p-5">access denied please! <a  class="btn btn-info" href="login.php">login</a>  </div> </div>
  </div>
  </div>
    ';
}


?>