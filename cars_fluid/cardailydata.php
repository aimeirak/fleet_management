
<?php
session_start();
include '../connexion.php';


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

$id_comany =  $_SESSION["sub_company"];
function carlistOnly(){
  $sql1 = "SELECT * from fluid_car 
   where fluid_car.id_subcompany=" . $_SESSION["sub_company"];
  
  $result1 = mysqli_query($GLOBALS['conn'], $sql1);
  while($row = mysqli_fetch_array($result1)){
    echo'
    <div class=" col-md-4 col-xl-3 mt-1  " id="'.$row["plaque"].'"  onClick="getvalue(this.id)" >
              <div class="card  shadow h-100 py-2">
                  <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1 carId" id="carId">' . $row["plaque"] . '<sup class="badge '.(($row['standard']=='available')?'badge-success':'badge-danger').'" >*</sup></div>
                      <div class="row no-gutters align-items-center">
                                      
                      </div>
                      </div>
                      <div class="col-auto">
                      <span class="fa fa-car"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>   
    </div>     
    ';
  }
}


//cars info 
function finder($Plaques,$carplaque){
 foreach($Plaques as $plate){
   if($plate === $carplaque){
     return true;
   }else{
     return false;
   }
 } 
}

function getCarFuelConsuption($plate){
  $car = array();
  $sql  = "SELECT * FROM fluid_car where plaque = ? and id_subcompany = ? ";
  $stmt = $GLOBALS['conn']->prepare($sql);
  $stmt->bind_param('si',$plate,$_SESSION["sub_company"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $fetchCar = $result->fetch_assoc();
  
  $car = array(
    'id' => $fetchCar['id'],
    'fuel' => $fetchCar['fuel_consumption']
  );
  return $car;
  $stmt->close();
}
function getAllBooking($from,$until,$id){
  $done = 'done';
  $book = array();
  $sql = "SELECT start_time,end_time,car_id,startP.id_sector0 as sectorIdFrom,endP.id_sector0 as sectorIdto  from fluid_booking
   inner join fluid_driver_logs on (fluid_booking.driver_id = fluid_driver_logs.driver_id and date(fluid_driver_logs.date_log) between date(?) and date(?) )
   inner join fluid_place as startP on startP.id = fluid_booking.id_place0 inner join fluid_place as endP on endP.id = fluid_booking.id_placef   
   where  date(start_time) between date(?) and date(?) and fluid_booking.rank = ? and car_id = ?";
  $stmt = $GLOBALS['conn']->prepare($sql);
  $stmt->bind_param("sssssi",$from,$until,$from,$until,$done,$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $i = 0;
  while($fetchBook = $result->fetch_assoc()){
    $book[$i] = array(
      'start_time'=> $fetchBook['start_time'],
      'end_time'=> $fetchBook['end_time'],
      'car_id' => $fetchBook['car_id'],
      'from' => $fetchBook['sectorIdFrom'],
      'to' => $fetchBook['sectorIdto'],
      
    );
   $i++;
  }
  return $book;
  $stmt->close();
};
function getKm($allBookings){
    //  we may add joined booking
     $km = 0;
     $i = 0;
     $sql  = "SELECT * FROM fluid_distance where id_sector0 = ? and id_sectorf = ?";
     $stmt = $GLOBALS['conn']->prepare($sql);
     while($i < sizeof($allBookings)){
       $from = $allBookings[$i]['from'];
       $to = $allBookings[$i]['to'];
       $stmt->bind_param('ii',$from,$to);
       $stmt->execute();
       $result = $stmt->get_result();
       $fetchKm = $result->fetch_assoc();
      // echo $from .' to '. $to .'<br>';
       $km += $fetchKm['kilometers'];       
       $i++;
     }
    return $km;
    $stmt->close();
}

function getCost($km,$carConsuption){
    $live= 1;
    $company = $_SESSION['sub_company'];
    $sql = "SELECT * FROM fuel_cost where id_subcompany = ? and live = ?";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bind_param('ii',$company,$live);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      $fuelCost = $result->fetch_assoc();
      $costs =  ($km/$carConsuption) * $fuelCost['cost'] ;
    }else{
      $costs =  ($km/$carConsuption) * 960;
    }       
    return round($costs);
    $stmt->close();
}


function carsInfo($carId,$from,$to){

 //call consuption and id
 $fuelInfo = getCarFuelConsuption($carId);   
 //=======

 //start place and destination and bookid in return
 $bookInfos = getAllBooking($from,$to,$fuelInfo['id']);
 //=======      
 
 //counting km
 $kmSpent = getKm($bookInfos);    
 //====

 //count cost fuel_consuption ($fuelInfo['fuel'])
 $cost =  getCost($kmSpent,$fuelInfo['fuel']);    
 //====
      
      echo '
      
      <div class="col-12  m-2">
      <div class="row">
                <div class="form-group col-9 col-sm-6 ">
                    <div class="input-group " >
                        <input id="start_date" type="date" format="Y-m-d" class="form-control"/>
                        <span class="input-group-addon input-group-append btn btn-info">
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class="form-group col-9 col-sm-6">
                    <div class="input-group " >
                        <input id="end_date" type="date" class="form-control"/>
                        <span class="input-group-addon input-group-append btn btn-primary">
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <span id="process"  class="btn btn-outline-info pull-right ">Process</span>
                </div>
           </div>
      </div>
      <div class="card border shadow mt-3 ml-2" >' ;   
  
      echo  '
      <div class="card-header" >'.$carId.'  Fuel consumption from  '.$from.' until '.$to.'</div>
        <div class="card-body" >
           <div class="row">
            <div class="col p-2" >
             KM = '.$kmSpent.'
             </div>
             <div class="col p-2 text-info" >
             Cost = '.$cost .' rwf 
             </div>           
           
             </div>
             

        </div>
        <div class="card-footer" >
             <div class="col p-2 " >
             complited bookings            
             </div>
             </div>
      </div> ';
     
}


//daily book for driver

function Booking(){
  $now = date('Y-m-d');
  $tomorrow = date('Y-m-d',strtotime('tomorrow'));

  $rank = 'pending';
  //my car
  $DriverId = $_SESSION['id'];
  
  
  $i = 1;
  $sql = "SELECT p.username as passenger,fluid_booking.rank,fluid_booking.id as bookId,fluid_booking.start_time, 
           fluid_booking.end_time,a.name AS 'departure',b.name AS 'destination',statusname,name_dep from fluid_booking 
          JOIN fluid_place AS a ON fluid_booking.id_place0=a.id
          JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
          inner join fluid_status on fluid_status.id=fluid_booking.status_id 
          inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id                  
          inner join fluid_user as p  on p.id = fluid_booking.id_user
          where  date(start_time) between  ? and ?  and rank = ? order by start_time asc";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('sss',$now,$tomorrow,$rank);
   $stmt->execute();
   $result = $stmt->get_result();
   $isThereMyAnyTrip = $result->num_rows;
   if($isThereMyAnyTrip){

     
        echo ' <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4 mb-6 ">
        '.$now.' until '.$tomorrow.'        
        <table class="table table-striped table-responsive table-bordered table-hover  " id="datatable1" cellspacing="0" 
        width="100%">
     <thead>
         <tr>
             <th>Passenger(m)</th>
             <th>StartTime</th>
             <th>EndTime</th> 
             <th>Depature</th>
             <th>Destination</th>
             <th>Action</th>
         </tr>
     </thead>
     <body>
        ';
        $active ='';
        while($fetchBooking =  $result->fetch_assoc()){
          if($fetchBooking["rank"] == 'rejected' && isset($_POST['rejected']) && $_POST['rejected']){
            $active ='class="bg-danger text-white-100 text-gray-900"';
          }else{
            $active ='class="text-gray-900"';            
          }
         $i++;
          echo 
            '


                <tr '.$active.' >'.

                   '<td>'.$fetchBooking["passenger"].'</td>'.             
                    '<td>'.$fetchBooking["start_time"].'</td>'.
                    '<td>'.$fetchBooking["end_time"].'</td>'.  
                    '<td>'.$fetchBooking["departure"].'</td>'.
                    '<td>'.$fetchBooking["destination"].'</td>';
                   
                  if($rank == 'pending'){
                  echo  '<td>'.'<span id="bl546'.$i.'23"  dta-b ="'.$fetchBooking["bookId"].'"  onClick ="action(this.id)" class="btn btn-primary btn-sm">Yes</span>
                       <span id="bl5ji564'.$i.'j256jk-3"  dta-b ="'.$fetchBooking["bookId"].'" onClick ="reject(this.id)"  data-toggle="modal" class="btn btn-danger btn-sm" data-target="#reject">NO</span>
                    
                    ';
                  }else{
                  echo  '<td>'.'<span id="bl546'.$i.'23"  dta-b ="'.$fetchBooking["bookId"].'"  onClick =" class="btn btn-primary btn-sm">send to yego</span>
                    
                    
                    ';
                  } 
                    
                    
                  echo  '</td>'.                   
                    
                '</tr>'; 
        }
        echo'
        </body>

        </table> 
        </div>

        ';   

     
   }else{
    if($rank == 'pending'){
      echo '<div class="alert alert-primary m-3"  >No trip is pending </div> ';
    }else{
      echo '<div class="alert alert-info m-3"  >There is no rejeted booking in up comming hours</div>';
    }
   }
  
}
//rejection



function BookingRe($rank){
  $now = date('Y-m-d');
  $tomorrow = date('Y-m-d',strtotime('tomorrow'));
  //my car
  $DriverId = $_SESSION['id']; 
  
  $i = 1;
  $sql = "SELECT p.username as passenger,fluid_booking.rank,fluid_booking.id as bookId,fluid_booking.start_time, 
           fluid_booking.end_time,a.name AS 'departure',b.name AS 'destination',statusname,name_dep from fluid_booking 
          JOIN fluid_place AS a ON fluid_booking.id_place0=a.id
          JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
          inner join fluid_status on fluid_status.id=fluid_booking.status_id 
          inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id                  
          inner join fluid_user as p  on p.id = fluid_booking.id_user
          where start_time between ? and ? and rank = ? order by start_time asc";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('sss',$now,$tomorrow,$rank);
   $stmt->execute();
   $result = $stmt->get_result();
   $isThereMyAnyTrip = $result->num_rows;
   if($isThereMyAnyTrip){

     
        echo ' <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4 mb-6">
        '.$now.' until '.$tomorrow.'        
        <table class="table table-striped table-responsive table-bordered table-hover display " id="datatable1" cellspacing="0" 
        width="100%">
     <thead>
         <tr>
      
             <th>StartTime</th>
             <th>EndTime</th>
             
             <th>Passenger(m)</th>
             <th>Depature</th>
             <th>Destination</th>
             <th>Action</th>
         </tr>
     </thead>
     <body>
        ';
       
        while($fetchBooking =  $result->fetch_assoc()){
          
         $i++;
          echo 
            '


                <tr  >'.

             
                    '<td>'.$fetchBooking["start_time"].'</td>'.
                    '<td>'.$fetchBooking["end_time"].'</td>'.
                   
                    '<td>'.$fetchBooking["passenger"].'</td>'. 
            
                    '<td>'.$fetchBooking["departure"].'</td>'.
                    '<td>'.$fetchBooking["destination"].'</td>';
                   
                  if($rank == 'pending'){
                  echo  '<td>'.'<span id="bl546'.$i.'23"  dta-b ="'.$fetchBooking["bookId"].'"  onClick ="action(this.id)" class="btn btn-primary btn-sm">Yes</span>
                    <span id="bl5ji564'.$i.'j256jk-3"  dta-b ="'.$fetchBooking["bookId"].'" onClick ="dismiss(this.id)" class="btn btn-danger btn-sm">NO</span>
                    
                    ';
                  }else{
                  echo  '<td>'.'<span id="bl546'.$i.'23"  dta-b ="'.$fetchBooking["bookId"].'"  onClick ="restore(this.id)" class="btn btn-primary btn-sm">send to yego</span>
                    
                    
                    ';
                  } 
                    
                    
                  echo  '</td>'.                   
                    
                '</tr>'; 
        }
        echo'
        </body>

        </table> 
        </div>

        ';   

     
   }else{
    if($rank == 'pending'){
      echo '<div class="alert alert-info m-3"  >No trip is left </div> ';
    }else{
      echo '<div class="alert alert-danger m-3"  >there is no rejeted booking in up comming hours</div>';
    }
   }
  
}


//====================

function carDriverPageInfo(){
  echo '<div class="col-12 col-md-9 mt-4" >
           <div class="card shadow p-4">
               <div class="card-header">
                <h6>Not available from and to</h6>
               </div>
               <label>From</label>
                                <div class=" d-block d-sm-flex">
                                <div  class="input-group "  >
                                    <input type="date" id="fromDate" autocomplete="off" autocorrect="off" class="form-control mb-2"  />
                                    
                                </div>
                                    <input type="time" id="fromTime" autocomplete="off" autocorrect="off"class="form-control mb-3"    />
                                               
                                </div>
                               
                                <label>To</label>
                                <div class="d-block d-sm-flex">
                                <div class="input-group " >
                                <input  type="date" id="toDate"  autocomplete="off" autocorrect="off"  class="form-control mb-2"   />
                                     
                                </div>
                                    <input  type="time" id="toTime" autocomplete="off" autocorrect="off" class="form-control mb-3 "    />
                                              
                                </div>
                                <label>description </label>
                                <input type="text"  autocomplete="off" autocorrect="off" placeholder ="description" id="description"  class="form-control mb-3"/>
                                
                                <input type="button"  autocomplete="off" autocorrect="off" value="save" id="saveAvail" onClick="getV(this.id)"  class="btn btn-success"/>
                                
                                    

                </div>

           </div>
      </div>';
}
//confirmed book
function BookingCo($conf){
  $now = date('Y-m-d');
  $tomorrow = date('Y-m-d',strtotime('tomorrow'));
  $active = 'active';

  //my car
  $DriverId = $_SESSION['id'];
  
  
  $i = 1;
  $sql = "SELECT p.username as passenger,fluid_booking.rank,fluid_booking.id as bookId,fluid_booking.start_time, 
           fluid_booking.end_time,a.name AS 'departure',b.name AS 'destination',statusname,name_dep from fluid_booking 
          JOIN fluid_place AS a ON fluid_booking.id_place0=a.id
          JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
          inner join fluid_status on fluid_status.id=fluid_booking.status_id 
          inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id                  
          inner join fluid_user as p  on p.id = fluid_booking.id_user
          where date(start_time) = ? and rank IN( ?,?) and fluid_booking.driver_id = ? order by start_time asc";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('sssi',$now,$conf,$active,$DriverId);
   $stmt->execute();
   $result = $stmt->get_result();
   $isThereMyAnyTrip = $result->num_rows;
   if($isThereMyAnyTrip){
    echo ' 
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4 mb-6">
    '.$now.'        
    <table class="table table-striped table-responsive table-bordered table-hover display " id="datatable1" cellspacing="0" 
    width="100%">
 <thead>
     <tr>
   
         <th>StartTime</th>
         <th>EndTime</th>
         
         <th>Passenger(m)</th>
         <th>Depature</th>
         <th>Destination</th>
         <th>Action</th>
     </tr>
 </thead>
 <body>
    ';
    while($fetchBooking =  $result->fetch_assoc()){
      if($fetchBooking["rank"] == 'active' ){
        $active ='class="bg-success text-white-100 text-gray-900"';
      }else{
        $active ='class="text-gray-900"';            
      }
      $i++;
       echo 
         '


             <tr '.$active.' >'.

    
                 '<td>'.$fetchBooking["start_time"].'</td>'.
                 '<td>'.$fetchBooking["end_time"].'</td>'.
                
                 '<td>'.$fetchBooking["passenger"].'</td>'. 
         
                 '<td>'.$fetchBooking["departure"].'</td>'.
                 '<td>'.$fetchBooking["destination"].'</td>';
                
               if($fetchBooking["rank"] == 'active'){
                echo  '<td>'.'
                <span class="btn btn-primary btn-icon-split m-2" id="be15546'.$i.'23"  dta-b ="'.$fetchBooking["bookId"].'"  onClick ="endTrip(this.id)">  
                <span class="icon text-white-70">
                    <i class="fas fa-check"></i>
                  </span>              
                   <span  class="text">complete</span>             
                 </span>
                 '.'<span id="bl4554'.$i.'22"  dta-b="'.$fetchBooking["bookId"].'"  onClick ="cancel(this.id)" class="btn btn-warning btn-sm m-2"  data-toggle="modal"  data-target="#diss">Cancel</span> 
                 
                 ';
               }
               
               if($fetchBooking["rank"] == 'confirmed'){
               echo  '<td>'.'<span id="bl546'.$i.'23"  dta-b="'.$fetchBooking["bookId"].'"  onClick ="startTrip(this.id)" class="btn btn-success btn-sm m-2">Start</span>  
                    '.'<span id="bl4546'.$i.'22"  dta-b="'.$fetchBooking["bookId"].'"  onClick ="cancel(this.id)" class="btn btn-warning btn-sm m-2"  data-toggle="modal"  data-target="#diss" >Cancel</span> 
                 
                 ';
               } 
                 
                 
               echo  '</td>'.                  
                 
             '</tr>'; 
     }
     echo'
        </body>

        </table> 
        </div>

        '; 
   }else{
      echo'<div class="alert alert-success m-3"  >There is not left confirmed booking today </div>';
   }

}
//=====end of confirmed book
if(isset($_POST['carListOnly'])  and $_SESSION['role'] == 20 ){
  carlistOnly();
}



if(isset($_POST['dataSent']) and isset($_POST['carIdentity']) and $_SESSION['role'] == 20){
  $today = date('Y-m-d');
  $tomorrow = date("Y-m-d H:m:s",strtotime("tomorrow"));
  carsInfo($_POST['carIdentity'],$today,$tomorrow);
}

if(isset($_POST['from']) and isset($_POST['until']) and isset($_POST['plate']) and $_SESSION['role'] == 20){

  $today = $_POST['from'];
  $tomorrow = $_POST['until'];

   carsInfo($_POST['plate'],$today,$tomorrow);
}

if(isset($_POST['carDriver']) && isset($_POST['plate'])  and $_SESSION['role'] == 30 ){
  carDriverPageInfo();
}
if($_SESSION['role'] == 30 and isset($_POST['booking'])  ){
  Booking();
}
if($_SESSION['role'] == 30 and isset($_POST['rejected'])  ){
  BookingRe('rejected');
}
if($_SESSION['role'] == 30 and isset($_POST['confirmedb'])  ){
  BookingCo('confirmed');
}

//car selection

if(isset($_POST['s']) && isset($_POST['d']) && isset($_POST['r'])){
  
  //check if to day driver chosse car 
  
  $live   = 1;
  $now    = date('Y-m-d');
  $driver = $_POST['d']; 
  $id_comany =  $_SESSION['sub_company'];
  $stmt = $connection->prepare("SELECT fluid_driver_logs.id as log_id,car_id,fluid_car.plaque from fluid_driver_logs 
  inner join fluid_car on fluid_car.id = fluid_driver_logs.car_id where driver_id = ? and date(date_log) = ?  and live = ? and id_subcompany = ?");
  $stmt->bind_param('isii',$driver,$now,$live,$id_comany);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows >= 1){
   $fetchCarId = $result->fetch_assoc();
   echo '
   <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"> This is recomended for you </h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">
       <div class="row">
         <div class="col-12 text-center ">
           
               <div class="text-center text-info">
                 Cars <i class="fa fa-car text-info" ></i>
                 </div>                   
                    
           ';
  echo'<span class="btn btn-success btn-icon-split m-1 btn-sm" >
  <span class="icon text-white-70">
      <i class="fas fa-car"></i>
    </span>
    <span  class="text" tank-data="'.$fetchCarId['car_id'].'" id="kgl26'.$live.'17" onClick="getCar(this.id)">'.$fetchCarId['plaque'].' </span>
     ';  

       
 echo'   
 </span>
 
 
       </div> 
          <div class="col-12" id="carInfo">
            
            </div> 
        </div> 
                
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" type="button" id="carSelect"  data-dismiss="modal">select</button>
           </div>
      </div>  

' ;



   $stmt->close();
  }else{
      //if he/she didn't
      $id_comany =  $_SESSION['sub_company'];
  $i = 1;
  $dateL = date('Y-m-d');
  $live  = 1;
  $stmt  = $connection->prepare('SELECT * from fluid_car where id not in (select  car_id as id from fluid_driver_logs where date(date_log) = ? and live = ?) and id_subcompany = ?');
  $stmt->bind_param('sii',$dateL,$live,$id_comany);
  $stmt->execute();
  $result = $stmt->get_result();
  echo '
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Car selection </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row">
          <div class="col-12 text-center ">
            
                <div class="text-center text-info">
                  Cars <i class="fa fa-car text-info" ></i>
                  </div>
                    
                     
            ';
  while($fetchCarInfo = $result->fetch_assoc()){
    $i++;
    if($fetchCarInfo['standard'] == 'available'){
      echo'<span class="btn btn-success btn-icon-split m-1 btn-sm" >
            <span class="icon text-white-70">
                <i class="fas fa-car"></i>
              </span>
              <span  class="text" tank-data="'.$fetchCarInfo['id'].'" id="kgl26'.$i.'17" onClick="getCar(this.id)">'.$fetchCarInfo['plaque'].' </span>
      ';
    }else{
      echo' <span class="btn btn-danger btn-icon-split m-1 btn-sm" >
              <span class="icon text-white-70">
                <i class="fas fa-close"></i>
              </span>
              <span  class="text"> '.$fetchCarInfo['plaque'].' </span>
      
      ';
    }   

     echo '';
     echo'</span>';
  }


  
 echo'   

 
 
       </div> 
          <div class="col-12" id="carInfo">
            
            </div> 
        </div> 
                
        </div>
        <div class="modal-footer">
          <button class="btn btn-info" type="button" id="carSelect"  data-dismiss="modal">select</button>
           </div>
      </div>  

' ;
}   
 }


//========================
//book confirmation
if(isset($_POST['u']) && isset($_POST['dp']) && $_SESSION['role'] == 30){
  $id = $_POST['dp'];
  $color = '';
  

  if($_POST['re'] == 0){
    //send email   
    $confirmed = 'confirmed';
    $color = 'green';
  }
  elseif($_POST['re'] == 2){
    $confirmed = 'canceled';
    $color = 'brown';
  }
  else{
    //send email
    $confirmed = 'rejected';
    $color = 'red';
  }
  if($confirmed == 'rejected' || $confirmed == 'canceled' ){
    
    if(!isset($_POST['ks']) || trim($_POST['ks']) == ''){     
      echo '<div class="alert alert-danger mt-3" style="margin:auto">Please mention your reason</div>';
      exit(BookingCo('confirmed'));
    }else{
      $ks = $_POST['ks'];
      $now = new DateTime;
      $rejDate = $now->format('Y-m-d H:m');
      $stmt = $connection->prepare('INSERT INTO fluid_rejection(bookid,reason,rejectDate) values (?,?,?)');
      $stmt->bind_param('iss',$id,$ks,$rejDate);
      $stmt->execute();
      $stmt->close();
    }
    
  }
 
  $updatedAt = date('Y-m-d'); 
  $driver = $_SESSION['id'];
  $sql  = "UPDATE fluid_booking set rank = ?, updated_at = ?,driver_id =? where id = ?";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param('ssii',$confirmed,$updatedAt,$driver,$id);
  $stmt->execute();
  $updated = $stmt->affected_rows;
  if($updated > 0){ 
     //notification
    $bookiID = $_POST['dp'];
   
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
   $msg = $username.', your booking have been '.$confirmed.'  by '.$_SESSION['username'].' ';

   $note = $connection->prepare('INSERT INTO fluid_notification_lead(note,userId,created_at) values (?,?,?) ');
   $note->bind_param('sss',$msg,$boOwner,$date);
   $note->execute();
   if($note->affected_rows > 0){
       include '../include/deplicatSolver/emailSender.php';
       $sender = "ishyigasoftware900@gmail.com";
       $sender_name = "Booking activation";
       $msg .= "
       <table >
     
       <tbody>
           
       <tr><span style='font-size:16px;font-size:bold;color:".$color .";' >Driver: </span> ". $_SESSION['username'] ."</td> </tr>
       <tr><span style='font-size:16px;font-size:bold;color:".$color .";'>From: </span>". $from ."</td> </tr>
       <tr><span style='font-size:16px;font-size:bold;color:".$color .";'>To</span>: ". $to ." </td> </tr>
       <tr><span style='font-size:16px;font-size:bold;color:".$color .";'>start time</span>: ". $start ."</td>  </tr>        
       <tr><span style='font-size:16px;font-size:bold;color:".$color .";'>End time</span>: ". $end ."</td>  </tr>
          
       </tbody>
   </table>
       ";
       sendEmail($username,$sender,$sender_name,$email,'<h2 color='.$color .'; >Your trip is '.$confirmed.' </h2> <br> '.$msg.'');
   }
   //===== notification =====
   $bootOwener->close();
   $note->close();
   
   if($_POST['re'] == 0){     
    Booking();
  }
  elseif($_POST['re'] == 2){
    BookingCo('confirmed');
  }
  else{    
    Booking();
  }

  }else{    
    echo'<div class="alert alert-danger">Booking was not confirmed</div>';
  }
}
//==========
//car progress

function carProgress($date){
  $id_comany = $_SESSION['sub_company'];
  $date = new DateTime();
  $now = $date->format('Y-m-d');
  $rank = 'done'; 
  $stmt = $GLOBALS['conn']->prepare('SELECT fluid_booking.id FROM fluid_booking inner join fluid_user on fluid_user.id  = fluid_booking.id_user  where date(start_time) = date(?) and fluid_user.id_subcompany = ? ');
  $stmt->bind_param('si',$now,$id_comany);
  $stmt->execute();
  $stmt->store_result();  
  $returnedRow = $stmt->num_rows; 
  $stmt->close();
  if($returnedRow > 0){
    $role = 30;
    $live = 1;
    $stmtu = $GLOBALS['conn']->prepare('SELECT  id,username,role  ,live,id_subcompany from fluid_user where fluid_user.live = ? and fluid_user.role = ? and fluid_user.id_subcompany = ?');
    // $stmtu->bind_param('iii',$role,$live,$id_company);
    $stmtu->bind_param('iii',$live,$role,$id_comany);
    $stmtu->execute();
    $results = $stmtu->get_result();
    if(  $results->num_rows < 1){
    
    }else{
      echo '<div class="col-9  m-2">
      <div class="row">
                <div class="form-group col-9 col-sm-6 ">
                    <div class="input-group " >
                        <input id="start_date" type="date" format="Y-m-d" class="form-control"/>
                        <span class="input-group-addon input-group-append btn btn-info">
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class="form-group col-9 col-sm-6">
                    <div class="input-group " >
                        <input id="end_date" type="date" class="form-control"/>
                        <span class="input-group-addon input-group-append btn btn-primary">
                                    <span class="fa fa-calendar"></span>
                                </span>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <span id="processPro"  class="btn btn-outline-info pull-right ">Process</span>
                </div>
           </div>
      </div>';
      
        //bookin should be done 
        $done = 'done';
        $rejected = 'rejected';
        $i = 1;
        $ran = rand(5000,10000);
        echo '<div class="col-12  m-2">
        <div class="card shadow">
                  <div class="card-header">
                    Progress of  ('.$now.') 
                  </div>
                  <div class="card-body">
               <div class="row">
               
                  
             ';
      while($fetchDriver = $results->fetch_assoc()){
        $diverid = $fetchDriver['id'];
        $stmtp = $GLOBALS['conn']->prepare('SELECT count(fluid_booking.id) as num FROM fluid_booking where date(start_time) = date(?)  and driver_id = ?');
        $stmtp->bind_param('si',$now,$diverid);
        $stmtp->execute();
        $result = $stmtp->get_result();
        $fecthBprog = $result->fetch_assoc();
         
        $re = 'SELECT id from fluid_booking where driver_id = ? and rank = ?';
        $stmtRe =  $GLOBALS['conn']->prepare($re);
        $stmtRe->bind_param('is',$diverid,$rejected); 
        $driverRejects = $stmtRe->num_rows;

          $progress = round((($fecthBprog['num'] - $driverRejects) * 100) / $returnedRow);

          echo '<div class="col-xl-3 col-md-6 mb-2">
          <div class="card border-left-info shadow h-100 py-2"   >
            <div class="card-body" dt-y="'.$now.'" data-tank="'.$diverid  .'" onClick="prog(this.id)" id="'.$i.'jks'.$i++.$ran.'">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">'. $fetchDriver['username'] .' -('.$now.')- </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">'. $progress .'% </div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: '.$progress.'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>';
      
     
      } 
      echo'
      </div>
      </div>
      </div>
      </div>
      ';
    }
 

  
  
   
  
 
  }else{
    echo '<div class="col-12 col-sm-9  m-2">
    <div class="row">
              <div class="form-group col-9 col-sm-6 ">
                  <div class="input-group " >
                      <input id="start_date" type="date" format="Y-m-d" class="form-control"/>
                      <span class="input-group-addon input-group-append btn btn-info">
                                  <span class="fa fa-calendar"></span>
                              </span>
                  </div>
              </div>
              <div class="form-group col-9 col-sm-6">
                  <div class="input-group " >
                      <input id="end_date" type="date" class="form-control"/>
                      <span class="input-group-addon input-group-append btn btn-primary">
                                  <span class="fa fa-calendar"></span>
                              </span>
                  </div>
              </div>
              <div class="form-group col-md-2">
                  <span id="processPro"  class="btn btn-outline-info pull-right ">Process</span>
              </div>
         </div>
    </div>';
    echo '<div class="col-12 m-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">NO BOOKINGS IS DONE ON '.$now.'</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-warning">0 </div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>';
  }
 

}

//modified date 

function carProgressMod($from,$to){
  
  $id_comany = $_SESSION['sub_company'];
  $now = $from;
  $rank = 'done'; 
  $stmt = $GLOBALS['conn']->prepare('SELECT fluid_booking.id FROM fluid_booking inner join fluid_user on fluid_user.id  = fluid_booking.id_user  where date(start_time) between date(?) and date(?) and fluid_user.id_subcompany = ? ');
  $stmt->bind_param('ssi',$now,$to,$id_comany);
  $stmt->execute();
  $stmt->store_result();  
  $returnedRow = $stmt->num_rows; 
  $stmt->close();
  if($returnedRow > 0){
    $role = 30;
    $live = 1;
    $stmtu = $GLOBALS['conn']->prepare('SELECT  id,username,role  ,live,id_subcompany from fluid_user where fluid_user.live = ? and fluid_user.role = ? and fluid_user.id_subcompany = ?');
    // $stmtu->bind_param('iii',$role,$live,$id_company);
    $stmtu->bind_param('iii',$live,$role,$id_comany);
    $stmtu->execute();
    $results = $stmtu->get_result();
    if(  $results->num_rows < 1){
    
    }else{
      echo '<div class="col-12  m-2">
      <div class="card shadow">
                <div class="card-header">
                 Progress from  ('.$now.') until ('.$to.')
                </div>
                <div class="card-body">
             <div class="row">
             
                
           ';
      
      //bookin should be done 
      $done = 'done';
      $rejected = 'rejected';
      $i = 1;
      $ran = rand(5000,10000);
      while($fetchDriver = $results->fetch_assoc()){
        $i++;
        $diverid = $fetchDriver['id'];
        $stmtp = $GLOBALS['conn']->prepare('SELECT count(fluid_booking.id) as num FROM fluid_booking where date(start_time) between date(?) and (?) and rank = ?  and driver_id = ?');
        $stmtp->bind_param('sssi',$now,$to,$done,$diverid);
        $stmtp->execute();
        $result = $stmtp->get_result();
        $fecthBprog = $result->fetch_assoc();

        $re = 'SELECT id from fluid_booking where driver_id = ? and rank = ?';
        $stmtRe =  $GLOBALS['conn']->prepare($re);
        $stmtRe->bind_param('is',$diverid,$rejected); 
        $driverRejects = $stmtRe->num_rows;

          $progress = round((($fecthBprog['num'] - $driverRejects) * 100) / $returnedRow);
          echo '<div class="col-xl-3 col-md-6 mb-2"  ">
          <div class="card border-left-info shadow h-100 py-2" dt-y="'.$from.'"   data-tank="'. $diverid  .'" onClick="prog(this.id)" id="'.$i.'jks'.$i++.$ran.'">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">'. $fetchDriver['username'] .' </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">'. $progress .'% </div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: '.$progress.'%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>';
      
     
      } 
      echo'
      </div>
      </div>
      </div>
      </div>
      ';
    }
 

  
  
   
  
 
  }else{
    echo '<div class="col-xl-3 col-md-6 m-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">NO BOOKINGS was made ON '.$now.' which is done</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-warning">0 </div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>';
  }
 

}
//====

//end car progress
if(isset($_POST['pro']) and $_POST['pro'] == 12 and $_SESSION['role'] == 20){
  $date = date('Y-m-d');
  carProgress($date);
}
if(isset($_POST['pro']) and $_POST['pro'] == 1 and $_SESSION['role'] == 20 and isset($_POST['from']) and isset($_POST['until'])){
  $date = $_POST['from'];
  carProgressMod($date,$_POST['until']);
}
   
?>
 




 
 