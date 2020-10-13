
<?php 
session_start();
include '../connexion.php';
if(!isset($_SESSION['username'])){
  $msg = '
  <div class="container">
      <div class="card shadow mt-5">
      <div class=" alert alert-warning text-center m-5"><div class" p-5">access denied.  <a  class="btn btn-info" href="login.php">login</a> please!  </div> </div>
      </div>
  </div>

 ';
  echo '<script> window.open("login.php","_self") </script>';
  exit($msg);

}
function getCarInfo(){
   //response array
   $cars = array();
   $i = 0;
   //============== 
  $sql  = "SELECT * from fluid_car where fluid_car.id_subcompany= ? ";
  $stmt = $GLOBALS['conn']->prepare($sql);
  $stmt->bind_param('i', $_SESSION["sub_company"]); 
  $stmt->execute();
  $result = $stmt->get_result();
  while($fetchCar = $result->fetch_assoc()){
      $cars[$i] = array(
          'id' => $fetchCar['id'],
          'plaque' => $fetchCar['plaque'],
          'marque' => $fetchCar['marque'],
          'live' => $i
      );
      $i++;
  }
echo json_encode($cars);
}
function getDriverInfo(){
   $driver = 30 ; 
   $driverInfo = array();
   $sql  = "SELECT username,id,live from fluid_user where role = ? ";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('i',$driver);
   $stmt->execute();
   $result = $stmt->get_result();
   while($row = $result->fetch_assoc()){
       $driverInfo[] = $row;
   }
   echo json_encode($driverInfo);
 }
 function getUserReport($id){
   $sql = "SELECT * FROM fluid_user  where id = ? ";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('i',$id);
   $stmt->execute();
   $result = $stmt->get_result();
   $fetchUser = $result->fetch_assoc();
   $userAllInfo = array();
   $username = $fetchUser['username'];
   $fullName = $fetchUser['full_name'];
   $email = $fetchUser['email'];
   $phone_number = $fetchUser['phone_number'];
   $role = $fetchUser['status'];
  if($fetchUser['role'] == 20 and $fetchUser['status'] == 'MASTER'){
    $role  = 'MASTER';
  }else if($fetchUser['role'] == 20 and $fetchUser['status'] != 'MASTER'){
    $role  = 'ADMIN';
  }else if( $fetchUser['role'] == 10){
    $role = 'LEBOUR';    
  }else{
    $role = 'DRIVER'; 
  }

  if($fetchUser['live'] == 1){
    $dis = 'Entertained'; 
  }else{
    $dis = 'Dismissed'; 
  }
   $stmt->close();
  //===== booking
   $bookMade = 0; 
   $con = 0;
   $rej = 0;
   $done = 0;
   $pend = 0 ; 
   $canceled =  0 ;
   $sqlBook = "SELECT * FROM fluid_booking where id_user = ? ";
   $stmt = $GLOBALS['conn']->prepare($sqlBook);
   $stmt->bind_param('i',$id);
   $stmt->execute();
   $result = $stmt->get_result();
   while($fetchBook = $result->fetch_assoc()){
      $bookMade = $bookMade + 1;
      if($fetchBook['rank'] == 'confirmed'){
         $con++; 
      }
      elseif($fetchBook['rank'] == 'canceled'  ){
        $canceled++;  
       }
      elseif($fetchBook['rank'] == 'rejected'){
         $rej++;  
      }elseif($fetchBook['rank'] == 'done'){
         $done++;
      }else{
        $pend++;
      }
     

   }
   $stmt->close();
   $userAllInfo = array(
     'username'=>$username,
     'fullname'=>$fullName,
     'email'=>$email,
     'pend'=>$pend,
     'done'=>$done,
     'rej'=>$rej,
     'conf'=>$con     
   );
   //========
echo '
<div class="segment-lines">
<div class="segment-title">Personal info</div>
<div class="seg-list">
    <div class="each-record">
        <div class="desc">username: </div>
        <div class="content">'.$userAllInfo['username'].'</div>
    </div>
    <div class="each-record">
        <div class="desc">fullname: </div>
        <div class="content">'.$userAllInfo['fullname'].'</div>
    </div>
    <div class="each-record">
        <div class="desc">email: </div>
        <div class="content">'.$userAllInfo['email'].'</div>
    </div>
    <div class="each-record">
        <div class="desc">Contact: </div>
        <div class="content">'.$phone_number.'</div>
    </div>
    <div class="each-record">
      <div class="desc">ROLE: </div>
      <div class="content">'.$role.'</div>
    </div>
    <div class="each-record">
        <div class="desc">Status: </div>
        <div class="content">'.$dis.'</div>
      </div>
</div>
</div>
</div>';

if($fetchUser['role'] != 30){
  echo '<div class="segment-lines">
    <div class="segment-title">Bookings info</div>
    <div class="seg-list">
        <div class="each-record">
            <div class="desc"> Trips: </div>
            <div class="content">'.$bookMade.'</div>
        </div>
        <div class="each-record">
            <div class="desc text-warning">pending: </div>
            <div class="content text-warning">'.$pend.'</div>
        </div>
        <div class="each-record">
            <div class="desc text-danger">Canceled: </div>
            <div class="content text-danger">'.$canceled.'</div>
        </div>
        <div class="each-record">
            <div class="desc text-danger">rejected: </div>
            <div class="content text-danger">'.$rej.'</div>
        </div>
        <div class="each-record">
          <div class="desc text-success">confirmed: </div>
          <div class="content text-success">'.$con.'</div>
        </div>

      <div class="each-record">
        <div class="desc text-info">Done: </div>
        <div class="content text-info">'.$done.'</div>
      </div>
    </div>
  </div>
  ' ;
 }else{

  $sqlBook = "SELECT * FROM fluid_booking ";
  $stmt = $GLOBALS['conn']->prepare($sqlBook);
  $stmt->execute();
  $result = $stmt->get_result();
  while($fetchBook = $result->fetch_assoc()){
     $bookMade = $bookMade + 1;
     if($fetchBook['rank'] == 'confirmed' && $fetchBook['driver_id'] == $id){
        $con++; 
     }elseif($fetchBook['rank'] == 'rejected'  && $fetchBook['driver_id'] == $id){
        $rej++;  
     }
     elseif($fetchBook['rank'] == 'canceled'  && $fetchBook['driver_id'] == $id){
      $canceled++;  
     }
     elseif($fetchBook['rank'] == 'done' && $fetchBook['driver_id'] == $id){
        $done++;
     }
     if($fetchBook['rank'] == 'pending'){
       $pend++;
     }
   

  }

  echo '<div class="segment-lines">
  <div class="segment-title">Driving info</div>
  <div class="seg-list">
      <div class="each-record">
          <div class="desc"> Trips: </div>
          <div class="content">'.$bookMade.'</div>
      </div>
     <div class="each-record">
      <div class="desc text-warning">pending: </div>
      <div class="content text-warning">'.$pend.'</div>
     </div>
      <div class="each-record">
          <div class="desc text-danger">reject: </div>
          <div class="content text-danger">'.$rej.'</div>
      </div>
      <div class="each-record">
      <div class="desc text-danger">Canceled: </div>
      <div class="content text-danger">'.$canceled.'</div>
  </div>
      <div class="each-record">
        <div class="desc text-success">confirmed: </div>
        <div class="content text-success">'.$con.'</div>
      </div>

    <div class="each-record">
      <div class="desc text-info">Done: </div>
      <div class="content text-info">'.$done.'</div>
    </div>
  </div>
</div>
' ;
 }
 
 }

 if(isset($_POST['sd3453']) && isset($_SESSION['userStatus']) && ($_SESSION['userStatus'] == 'admin' || $_SESSION['userStatus'] == 'MASTER') ){
    getCarInfo();
  }
 if(isset($_POST['ngty789d3453']) && isset($_SESSION['userStatus']) && ($_SESSION['userStatus'] == 'admin' || $_SESSION['userStatus'] == 'MASTER') ){
    getDriverInfo();
  }
  if(isset($_POST['ngtvajsdnkf45_53']) && isset($_SESSION['userStatus']) && ($_SESSION['userStatus'] == 'admin' || $_SESSION['userStatus'] == 'MASTER') ){
    $id_user = $_POST['ngtvajsdnkf45_53'];
    getUserReport($id_user);
  } 
  
?>