<?php
session_start();
include('../connexion.php');
if(isset($_POST['send']) && isset($_SESSION['id']) && $_SESSION['id'] == 20 || $_SESSION['id'] == 10 ){
  
    $user_id = intval($_SESSION['id']);
    $car_id = stripslashes($_POST['pl']);

    

    $start_time =stripslashes($_POST['startT']);
    $end_time = stripslashes($_POST['endT']) ;
   
    $departure = intval(stripslashes($_POST['dep']));
    //$from = mysqli_real_escape_string($connection,$from);
    $destination = intval(stripslashes($_POST['dest']));
    $status = intval(stripslashes($_POST['stat']));
    $departments_id = stripslashes($_POST['nameD']);
    $description = stripslashes($_POST['descr']);          
    $rank = 'confirmed'; 
    $now  = date("Y-m-d H:i:s");
    //is he made this booking
    $sql_check = "SELECT id FROM fluid_booking WHERE start_time = ? and end_time = ?  and id_user = ?";
    $stmt = $connection->prepare($sql_check);
    $stmt->bind_param('ssi',$start_time,$end_time,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
          echo'<div class="alert alert-success"> You already booked this time</div>';
          $stmt->close();
    }
    //=====
    else{
        
        $strSQL = "INSERT into `fluid_booking` (id_user,car_id,start_time,end_time,id_place0,id_placef,status_id,departments_id,description,rank,created_at) values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt   = $connection->prepare($strSQL);   
        $stmt->bind_param('iisssssisss',$user_id,$car_id,$start_time,$end_time,$departure,$destination,$status,$departments_id,$description,$rank,$now);        
        $stmt->execute();
        $booked = $stmt->affected_rows;
        if($booked){
            echo'<div class="alert alert-success"> booked</div>';
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