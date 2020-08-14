<?php
session_start();
include '../connexion.php';

if(isset($_POST['list']) && isset($_POST['plate']) ){
    $carDriver = $_SESSION['id']; 
    $carQuery = "SELECT * FROM fluid_car where id_driver = ? ";
    $stmtCar  = $connection->prepare($carQuery);
    $stmtCar->bind_param('i',$carDriver);
    $stmtCar->execute();
    $resultCar =  $stmtCar->get_result(); 
    $fetchCar =  $resultCar->fetch_assoc();
    $car =  $fetchCar['id'];  
    // (to_time >= ?  and live = ? and
    $live = 1;
    $now = date('Y-m-d H:m:s'); 
    $stmtQuery = "SELECT fluid_driver_avail.*,username,fluid_car.id as carID 
     from  fluid_driver_avail inner join fluid_user on fluid_user.id = fluid_driver_avail.creator
     inner join fluid_car on fluid_car.id_driver = fluid_user.id
      where   fluid_car.id = ? and fluid_driver_avail.live = ? and to_time >= ?";
    $stmt = $connection->prepare($stmtQuery);
    $stmt->bind_param('iis',$car,$live,$now);
    $stmt->execute();
    $result = $stmt->get_result();
    $available = $result->num_rows;
    $i = 1;
    $rand = rand(50,700);
    if(!$available){
        $yest = date('Y-m-d H:m:s',strtotime('-1day'));
        echo '<div class="lead ml-4 mt-3 "  >All day available'.$yest.'</div>';

    }else{
         echo ' <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
         <h5>Unavailable time</h5>     
        <table class="table table-striped table-responsive  table-hover display "  cellspacing="0" 
        width="100%">
     <thead>
         <tr>
             
             <th>From</th>
             <th>Until</th>   
             <th>Discription</th>                         
             <th>Action</th>
         </tr>
     </thead>
     <body>
        ';

      while($fetch = $result->fetch_assoc()){
          $i++;
                echo'
                <tr>
                  <td>'.$fetch['from_time'].'</td>
                  <td>'.$fetch['to_time'].'</td>
                  <td>'.$fetch['discription'].'</td>
                  <td><span class="btn btn-danger" data-tanker="'.$fetch['id'].'" id="'.$i.$fetch['id'].$rand.'" onClick="endAvail(this.id)" >end</span></td>
                </tr>
                ';
      }

        echo'
        </body>

        </table> 
        </div>

        '; 
    }
}

if(isset($_POST['driver']) && isset($_POST['start']) && isset($_POST['end'])){
   
     if(empty($_POST['start'])|| empty($_POST['end']) || empty($_POST['descr'])){
      echo '<div class="alert alert-danger p-4 " >
         you have empty field
      </div>';
    }else{
        $default ='';
        $live =1;
        $start = $_POST['start'];
        $end = $_POST['end'];
        $descr = $_POST['descr'];
        $creator = $_POST['driver'];
        $sql = "INSERT INTO  fluid_driver_avail VALUES(?,?,?,?,?,?) ";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('issisi',$default,$start,$end,$live,$descr,$creator);
        $stmt->execute();
        $stmt->store_result();
        $inserted = $stmt->affected_rows;
        if($inserted){
            echo "<div class='alert alert-success p-3'>it is saved</div>" ; 
        }else{
            echo "<div class='alert alert-danger p-3'>it isnot saved</div>" ; 
        }

    }

}

if(isset($_POST['d']) && $_POST['d'] == 1 && isset($_POST['dt']) && trim($_POST['dt']) != '' && isset($_POST['t'])){
    $id = $_POST['dt'];
    $live = 0;
    $stmt = $connection->prepare('UPDATE fluid_driver_avail set live = ? where id = ?');
    $stmt->bind_param('ii',$live,$id);
    $stmt->execute();
    $updated = $stmt->affected_rows;   
    if($updated){
        echo "<div class='alert alert-success p-3'>it is updated </div>" ;
    }else{
        echo "<div class='alert alert-danger p-3'>it is not updated </div>" ;
    }
}

?>