<?php
include('../connexion.php');
session_start();
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
    $bootOwener = $connection->prepare('SELECT username,fluid_user.id as "owner" from fluid_booking inner join fluid_user on fluid_user.id = fluid_booking.id_user where fluid_booking.id = ?');
    $bootOwener->bind_param('i',$bookiID);   
    $bootOwener->execute();
    $result  = $bootOwener->get_result();
    $row = $result->fetch_assoc();
    $date = date('Y-m-d h:m:s');
    $boOwner = $row['owner'];
    $username =  $row['username'];
    $msg = $username.', your booking have been started  by '.$_SESSION['username'].' ';

    $note = $connection->prepare('INSERT INTO fluid_notification_lead(note,userId,created_at) values (?,?,?) ');
    $note->bind_param('sss',$msg,$boOwner,$date);
    $note->execute();
    $bootOwener->close();
    $note->close();
    //===== notification =====
   }else{
    echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not completed </div>' ;
   
   }
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
   $bootOwener = $connection->prepare('SELECT username,fluid_user.id as "owner" from fluid_booking inner join fluid_user on fluid_user.id = fluid_booking.id_user where fluid_booking.id = ?');
   $bootOwener->bind_param('i',$bookiID);   
   $bootOwener->execute();
   $result  = $bootOwener->get_result();
   $row = $result->fetch_assoc();
   $date = date('Y-m-d  h:m:s');
   $boOwner = $row['owner'];
   $username =  $row['username'];
   $msg = $username.', your booking have been completed  by '.$_SESSION['username'].' ';

   $note = $connection->prepare('INSERT INTO fluid_notification_lead(note,userId,created_at) values (?,?,?) ');
   $note->bind_param('sss',$msg,$boOwner,$date);
   $note->execute();
   $bootOwener->close();
   $note->close();
   //===== notification =====
  $stmt->close();
 }else{
  echo '<div class="alert alert-danger p-3 m-2 ml-3" > was not completed </div>' ;
 
 }
//=======================
}

?>