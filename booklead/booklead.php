<?php
include('../connexion.php');
session_start();
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
if(isset($_POST['strt'])){
 //if we  have active one
 $bookiID = $_POST['dt'];
 $active ='active';
 $driver = $_SESSION['id'];
$stmt = $connection->prepare('SELECT rank from fluid_booking where rank = ? and driver_id = ?');
$stmt->bind_param('si',$active,$driver);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    echo '<div class="alert alert-danger p-3 m-2 " > please complete the current trip </div>' ;
    $stmt->close();
}else{
   $stmt = $connection->prepare("UPDATE fluid_booking SET  rank = ?  where id = ? ");
   $stmt->bind_param('si',$active,$bookiID);
   $stmt->execute();
   if($stmt->affected_rows){
    echo '<div class="alert alert-success p-3 m-2 ml-3 " >it is started </div>' ;
    $stmt->close();
    //notification
    $bootOwener = $connection->prepare('SELECT username,fluid_user.id as "owner",email,start_time,end_time,startP.name as nameFrom,endP.name as nameto from fluid_booking 
     inner join fluid_place as startP on startP.id = fluid_booking.id_place0 inner join fluid_place as endP on endP.id = fluid_booking.id_placef   
     inner join fluid_user on fluid_user.id = fluid_booking.id_user where fluid_booking.id = ?');
    $bootOwener->bind_param('i',$bookiID);   
    $bootOwener->execute();
    $result  = $bootOwener->get_result();
    $row = $result->fetch_assoc();
    $date = date('Y-m-d h:m:s');
    $boOwner = $row['owner'];
    $username =  $row['username'];
    $email =  $row['email'];
    $from =  $row['nameFrom'];
    $to =  $row['nameto'];
    $start =  $row['start_time'];
    $end =  $row['end_time'];
    $msg = $username.', your booking have been started  by '.$_SESSION['username'].' ';

    $note = $connection->prepare('INSERT INTO fluid_notification_lead(note,userId,created_at) values (?,?,?) ');
    $note->bind_param('sss',$msg,$boOwner,$date);
    $note->execute();
    if($note->affected_rows > 0){
        include '../include/deplicatSolver/emailSender.php';
        $sender = "ishyigasoftware900@gmail.com";
        $sender_name = "Booking activation";
        $msg = "
        <table >
      
        <tbody>
            
        <tr><span style='font-size:16px;font-size:bold;color:orange;' >Driver: </span> ". $_SESSION['username'] ."</td> </tr>
        <tr><span style='font-size:16px;font-size:bold;color:orange;'>From: </span>". $from ."</td> </tr>
        <tr><span style='font-size:16px;font-size:bold;color:orange;'>To</span>: ". $to ." </td> </tr>
        <tr><span style='font-size:16px;font-size:bold;color:orange;'>start time</span>: ". $start ."</td>  </tr>        
        <tr><span style='font-size:16px;font-size:bold;color:orange;'>End time</span>: ". $end ."</td>  </tr>
           
        </tbody>
    </table>
        ";
        sendEmail($username,$sender,$sender_name,$email,'<h2>Your trip is activated </h2> <br> '.$msg.'');
       
    }   
    $bootOwener->close();
    $note->close();
   }else{
    echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not Activated </div>' ;
   
   }
     //===== notification =====
}
 //=======================
}
if(isset($_POST['endb'])){
    $active = 'done';
    $bookiID = $_POST['dt'];
 //if this booking was confirmed once  
 $stmt = $connection->prepare("UPDATE fluid_booking SET  rank = ?  where id = ? ");
 $stmt->bind_param('si',$active,$bookiID);
 $stmt->execute();
 if($stmt->affected_rows){
  echo '<div class="alert alert-success p-3 m-2 ml-3 " > The trip is completed </div>' ;
   //notification
   $bootOwener = $connection->prepare('SELECT username,fluid_user.id as "owner",email,start_time,end_time,startP.name as nameFrom,endP.name as nameto from fluid_booking 
     inner join fluid_place as startP on startP.id = fluid_booking.id_place0 inner join fluid_place as endP on endP.id = fluid_booking.id_placef   
     inner join fluid_user on fluid_user.id = fluid_booking.id_user where fluid_booking.id = ?');
    $bootOwener->bind_param('i',$bookiID);   
    $bootOwener->execute();
    $result  = $bootOwener->get_result();
    $row = $result->fetch_assoc();
    $date = date('Y-m-d h:m:s');
    $boOwner = $row['owner'];
    $username =  $row['username'];
    $email =  $row['email'];
    $from =  $row['nameFrom'];
    $to =  $row['nameto'];
    $start =  $row['start_time'];
    $end =  $row['end_time'];
   $msg = $username.', your booking have been completed  by '.$_SESSION['username'].' ';

   $note = $connection->prepare('INSERT INTO fluid_notification_lead(note,userId,created_at) values (?,?,?) ');
   $note->bind_param('sss',$msg,$boOwner,$date);
   $note->execute();
   if($note->affected_rows > 0){
    include '../include/deplicatSolver/emailSender.php';
    $sender = "ishyigasoftware900@gmail.com";
    $sender_name = "Booking termination";
    $msg = "
    <table >
  
    <tbody>
        
    <tr><span style='font-size:16px;font-size:bold;color:green;' >Driver: </span> ". $_SESSION['username'] ."</td> </tr>
    <tr><span style='font-size:16px;font-size:bold;color:green;'>From: </span>". $from ."</td> </tr>
    <tr><span style='font-size:16px;font-size:bold;color:green;'>To</span>: ". $to ." </td> </tr>
    <tr><span style='font-size:16px;font-size:bold;color:green;'>start time</span>: ". $start ."</td>  </tr>        
    <tr><span style='font-size:16px;font-size:bold;color:green;'>End time</span>: ". $end ."</td>  </tr>
       
    </tbody>
</table>
    ";
    sendEmail($username,$sender,$sender_name,$email,'<h2>Your trip is complited </h2> <br> '.$msg.'');
   
} 
   $bootOwener->close();
   $note->close();
   //===== notification =====
  $stmt->close();
 }else{
  echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not completed </div>' ;
 
 }
//=======================
}

if(isset($_POST['lo']) && isset($_POST['la']) && $_SESSION['role'] == 30 && isset($_POST['pt'])){
  $bookiID = $_POST['pt'];
  $lon = $_POST['lo'];
  $la  = $_POST['la'];
  $car = $_SESSION['CAR'];
  $sql  = "INSERT INTO fluid_endTrack(bookId,lo,la,carId) VALUES(?,?,?,?)";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('issi',$bookiID,$lon,$la,$car);
  $stmt->execute();
 
  if($stmt->affected_rows){
    echo'good to go';
  }else{
    echo'try again';
  }

}

?>