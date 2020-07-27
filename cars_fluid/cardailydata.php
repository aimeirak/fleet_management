
<?php
session_start();
include '../connexion.php';
function carlistOnly(){
  $sql1 = "SELECT fluid_car.id as carid ,fluid_car.plaque,fluid_car.marque,fluid_car.insurance_date,fluid_car.control_technique_date,fluid_car.standard,fluid_car.fuel_consumption,fluid_car.id_driver,fluid_user.username,fluid_car.seats from fluid_car
  INNER JOIN fluid_user on fluid_user.id=fluid_car.id_driver
   where fluid_car.id_subcompany=" . $_SESSION["sub_company"];
  
  $result1 = mysqli_query($GLOBALS['conn'], $sql1);
  while($row = mysqli_fetch_array($result1)){
    echo'
    <div class="col-6 col-sm-4   col-md-3 mt-3  " id="'.$row["plaque"].'"  onClick="getvalue(this.id)" >
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

function carsInfo($carId){

  $today = date('Y-m-d');
  $tomorrow = date("Y-m-d H:m:s",strtotime("tomorrow"));
 
 
   //making sure that there is date any bookin to day 
   $rank = 'confirmed';
   $done = 'done';
  $sqlStmt = "  SELECT fluid_car.plaque ,fluid_car.id,fluid_car.fuel_consumption  FROM fluid_booking  inner join fluid_car on fluid_car.id = fluid_booking.car_id  where start_time between ? and ? and rank = ? or rank =  ? ";
  $stmt = $GLOBALS['conn']->prepare($sqlStmt);
  $stmt->bind_param('ssss',$today,$tomorrow,$rank,$done);
  $stmt->execute();
  $result = $stmt->get_result();
 
  $wehaveBookToday =  $result->num_rows;

  if($wehaveBookToday){
    $allPlates = $result->fetch_assoc();
    $carConsuption = $allPlates['fuel_consumption'];
        //if there is any car which with the plate given
    $hasCarOnceBooked = finder($allPlates,$carId);
    if($hasCarOnceBooked){
      
      // car km count
      $live = 1;
      $kmcounQuery = " SELECT fluid_car.plaque,fluid_booking.start_time,fluid_booking.end_time,startp.name as startPlace,fluid_km_count.id_booking ,startp.id_sector0,endp.name,endp.id_sector0 
      ,kilometers,fluid_car.fuel_consumption  from fluid_km_count
       inner join fluid_place as startp on  startp.id = fluid_km_count.id_place0
       inner join fluid_place  as endp  on endp.id=fluid_km_count.id_placef
       inner join fluid_distance on (fluid_distance.id_sector0 = startp.id_sector0 and endp.id_sector0 = fluid_distance.id_sectorf) 
       inner join fluid_booking on fluid_km_count.id_booking = fluid_booking.id 
       inner join fluid_car on fluid_booking.car_id= fluid_car.id 
       WHERE start_time between ?  and ? and fluid_km_count.live = ? AND plaque = ?  group by id_booking ; ";
      $stmt = $GLOBALS['conn']->prepare($kmcounQuery);
      $stmt->bind_param('ssis',$today,$tomorrow,$live,$carId);
      $stmt->execute();
      $fetch = $stmt->get_result();      
      $kmst  = 0;
      $v = 24 ;
      
      echo '<div class="card border shadow mt-3 ml-2" >' ;   
      while($fetchCar = $fetch->fetch_assoc()){
        $kmst += $fetchCar['kilometers'];
        $cost = round(960 *($kmst/$carConsuption));
      } 

      echo '
      <div class="card-header" > Fuel consumption from  '.$today.' until '.$tomorrow.'</div>
        <div class="card-body" >
           <div class="row">
            <div class="col p-2" >
             KM = '.$kmst.'
             </div>
             <div class="col p-2 text-info" >
             Cost = '.$cost .' rwf 
             </div>           
           
             </div>
             

        </div>
        <div class="card-footer" >
             <div class="col p-2 " >
             this car has '.$wehaveBookToday. ' confirmed or done bookings
            
             </div>
             </div>
      </div> ';
     
      



    }else{
      echo'<div class="card ml-2 mt-3">   <div class="card-header" > there is no booking record of this car today '.$today.' </div> </div>';
    }

  }else{
    echo 'no book was made today '.$today.' until tomorrow '.$tomorrow ;
  }
}


//for driver

function Booking($rank){
  $now = date('Y-m-d H:m:s');
  $tomorrow = date('Y-m-d H:m:s',strtotime('tomorrow') );


  //my car
  $DriverId = $_SESSION['id'];
  
  $sql = "SELECT fluid_booking.rank,fluid_car.id_driver,plaque,d.username as driver,p.username as passenger ,fluid_booking.id as bookId,fluid_booking.start_time, 
           fluid_booking.end_time,a.name AS 'departure',b.name AS 'destination',statusname,name_dep from fluid_booking 
          JOIN fluid_place AS a ON fluid_booking.id_place0=a.id
          JOIN fluid_place AS b ON fluid_booking.id_placef=b.id 
          inner join fluid_status on fluid_status.id=fluid_booking.status_id 
          inner join fluid_departments on fluid_departments.id=fluid_booking.Departments_id 
          inner join fluid_car on fluid_booking.car_id = fluid_car.id 
          inner join fluid_user as d on d.id = fluid_car.id_driver 
          inner join fluid_user as p  on p.id = fluid_booking.id_user
          where   start_time between ? and ? and rank = ? and fluid_car.id_driver = ?";
   $stmt = $GLOBALS['conn']->prepare($sql);
   $stmt->bind_param('sssi',$now,$tomorrow,$rank,$DriverId);
   $stmt->execute();
   $result = $stmt->get_result();
   $isThereMyAnyTrip = $result->num_rows;
   if($isThereMyAnyTrip){
      if($rank == 'confirmed'){
        echo ' <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
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
          echo (
            '


                <tr>'.

                    
                    '<td>'.$fetchBooking["start_time"].'</td>'.
                    '<td>'.$fetchBooking["end_time"].'</td>'.
                   
                    '<td>'.$fetchBooking["passenger"].'</td>'. 
            
                    '<td>'.$fetchBooking["departure"].'</td>'.
                    '<td>'.$fetchBooking["destination"].'</td>'.
                   
                   
                    '<td>'.'<span id="'.$fetchBooking["bookId"].'"   onClick ="action(this.id)" class="btn btn-primary">Yes</span>
                    <span id="'.$fetchBooking["bookId"].'" onClick ="dismiss(this.id)" class="btn btn-danger">NO</span>
                    '.'</td>'.

                    
                    
                '</tr>
            '
        ); 
        }
        echo'
        </body>

        </table> 
        </div>

        ';   

      }else{
        echo ' <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
        '.$now.' until '.$tomorrow.'        
        <table class="table table-striped table-responsive table-bordered table-hover display " id="datatable1" cellspacing="0" 
        width="100%">
     <thead>
         <tr>
             <th>#</th>
             <th>Start time</th>
             <th>End time</th>
             
             <th>Passenger(m)</th>
             <th>Depature</th>
             <th>Destination</th>
            
             <th>Rank</th>
             <th>Action</th>
         </tr>
     </thead>
     <body>
        ';
        while($fetchBooking =  $result->fetch_assoc()){
          echo (
            '


                <tr>'.

                    '<td>'.$fetchBooking["bookId"].'</td>'.
                    '<td>'.$fetchBooking["start_time"].'</td>'.
                    '<td>'.$fetchBooking["end_time"].'</td>'.
                   
                    '<td>'.$fetchBooking["passenger"].'</td>'. 
            
                    '<td>'.$fetchBooking["departure"].'</td>'.
                    '<td>'.$fetchBooking["destination"].'</td>'.
                   
                    '<td>'.$fetchBooking["rank"].'</td>'.
                    '<td>'.'<span id="'.$fetchBooking["bookId"].'"   onClick ="restore(this.id)" class="btn btn-primary">restore</span>
                   
                    '.'</td>'.

                    
                    
                '</tr>
            '
        ); 
        }
        echo'
        </body>

        </table> 
        </div>

        ';  
        }
   }else{
    if($rank == 'confirmed'){
      echo 'no trip to day fo';
    }else{
      echo 'there is no rejeted booking in up comming hours';
    }
   }
  
}

function carDriverPageInfo(){
  echo '<div class="col-12 col-md-9 mt-4" >
           <div class="card shadow p-4">
               <div class="card-header">
                <h6>Not available from and to</h6>
               </div>
               <label>From</label>
                                <div class=" d-block d-sm-flex">
                                <div  class="input-group "  >
                                    <input type="date"  autocomplete="off" autocorrect="off" class="form-control mb-2"  />
                                    
                                </div>
                                    <input type="time"  autocomplete="off" autocorrect="off"class="form-control mb-3"    />
                                               
                                </div>
                               
                                <label>To</label>
                                <div class="d-block d-sm-flex">
                                <div class="input-group " >
                                <input  type="date"  autocomplete="off" autocorrect="off"  class="form-control mb-2"   />
                                     
                                </div>
                                    <input  type="time"  autocomplete="off" autocorrect="off" class="form-control mb-3 "    />
                                               
                                </div>

                </div>

           </div>
      </div>';
}

if(isset($_POST['carListOnly']) and $_SESSION['role'] == 20 ){
  carlistOnly();
}
if(isset($_POST['dataSent']) and isset($_POST['carIdentity']) and $_SESSION['role'] == 20){
  carsInfo($_POST['carIdentity']);
}

if(isset($_POST['carDriver']) && isset($_POST['plate'])  and $_SESSION['role'] == 30 ){
  carDriverPageInfo();
}
if($_SESSION['role'] == 30 and isset($_POST['booking'])  ){
  Booking('confirmed');
}
if($_SESSION['role'] == 30 and isset($_POST['rejected'])  ){
  Booking('rejected');
}

?>
 




 
 