<?php 
include '../connexion.php';
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
if(isset($_SESSION['username']) and $_SESSION['role'] == 20 ){
    if(isset($_POST['mo'])){
       

$driverId = $_POST['d'];
$year = $_POST['db'];
$reject = [];
$done = []; 
$cancel = [];
$allBookinMonths = [];
$i = 0 ;
$info = array();
$lead = 1;
function bookcount($year,$mo,$driver){
    $sql = "SELECT * FROM fluid_booking where year(start_time) = year(?) and month(start_time) =? and driver_id = ? ";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param('ssi',$year,$mo,$driver);
    $stmt->execute();  
    $result = $stmt->get_result();
    $rows = $result->num_rows;
    return $rows;      
} 

function allbook($year,$mo){
    $allSql = "SELECT fluid_booking.*,month(start_time) as 'mo' FROM fluid_booking where  year(start_time) = ? and month(start_time)  = ?  ";  
    $allstmt = $GLOBALS['conn']->prepare($allSql);
    $allstmt->bind_param('ss',$year,$mo);
    $allstmt->execute();
    $allresult =  $allstmt->get_result();
    if($allresult->num_rows > 0){  
     
            $allBookinMonths= $allresult->num_rows;
      
    }else{
        $allBookinMonths = 0;
    }
    $allstmt->close();

    return $allBookinMonths;
}


while($i < 12){
    $all = allbook($year,$lead);
    $rows = bookcount($year,$lead,$driverId);
    $reject[$i] = 0 ;
    $done[$i] = 0 ;
    $cancel[$i] = 0 ;
    $allBookinMonths[$i] = 0;
 
    if($rows <= 0 ){
        
        $reject[$i] = 0 ;
        $done[$i] = 0 ;
        $cancel[$i] = 0 ;
        $allBookinMonths[$i] = 0;
        if($all > 0 ){
            $allBookinMonths[$i] = $all;
        }
    }
    else{
        if($all > 0 ){
            $allBookinMonths[$i] = $all;
        }
       
        
        $sql = "SELECT fluid_booking.*,month(start_time) as 'mo' FROM fluid_booking where  year(start_time) = ? and month(start_time)  = ?  and driver_id = ?  ";
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bind_param('ssi',$year,$i,$driverId);
        $stmt->execute();  
        $result = $stmt->get_result();
        $num = $result->num_rows;       
        while($row = $result->fetch_assoc()){
            if($row['rank'] == 'done' ){
                $done[$i] += 1 ;
               
            }elseif($row['rank'] == 'rejected'){
                $reject[$i] += 1 ;   
            }elseif($row['rank'] == 'canceled'){
                $cancel[$i] += 1 ;                
            }else{
                $reject[$i] += 0 ;
                $done[$i] += 0 ;
                $cancel[$i] += 0 ;    
            }
         
            
        }
       
    }
    $i++;
    $lead++;
    
}
$info = array(
    'done' => $done,
    'rejected' => $reject,
    'canceled' => $cancel, 
    'allBook'  => $allBookinMonths 
);
echo json_encode($info);

    }

}
else{
    header('location:../uiupdate.php');
}

?>