<?php

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
  echo'<script> window.open("logout.php","_self") </script>'; 
}

}

?>

<?php $id_subcompany = $_SESSION['sub_company'] ?>
<div class="loader">
     <img src="assets/bootstrap3-editable/img/Loading-Image.gif" alt="" srcset="">
   </div>
<ul  class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion " id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="uiupdate.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <img src="assets/img/icon.png" alt="" srcset="">
  </div>
  <div class="sidebar-brand-text mx-3"><?= $_SESSION['blancName'] ?><sup>2</sup></div>
</a>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="uiupdate.php">
    <i class="fas fa-fw fa-forward"></i>
    <span>SHORTCUT</span></a>
</li>

<hr class="sidebar-divider">


<div class="sidebar-heading">
  Modification
</div>

<li class="nav-item">  
  <a class="nav-link" href="edituser.php" id="Profile" >
    <i class="fas fa-fw fa-user"></i>
    <span>Profile</span></a>
</li>
<?php  if($_SESSION['role'] == 20){ ?>
  <li class="nav-item">
  <a class="nav-link" href="user.php" >
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span></a>
</li>

<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">
<?php  if($_SESSION['role'] === 30 ){ ?>
<div class="sidebar-heading">
  Cars
</div>
  <li class="nav-item" style='cursor:pointer' >
  <a class="nav-link" id="LocateCars" href="carlocation.php" >
    <i class="fa fa-location-arrow "></i>
    <span> Car location</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="my_cars.php">
    <i class="fa fa-car "></i>
    <span> My Car </span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="kmscount.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span> KMS count </span></a>
</li>


<?php } ?>

<?php  if($_SESSION['role'] == 10 || $_SESSION['role'] == 20 ){ ?>

  
 <!-- Heading -->
<div class="sidebar-heading">
  Bookings
</div>

<?php if($_SESSION['role'] == 20 || $_SESSION['role'] == 10 ){  ?>
<!-- Nav Item - Bookings -->

<li class="nav-item">
  <a class="nav-link" href="bookinglist.php" id="AllBookings">
    <i class="fas fa-fw fa-table"></i>
    <span>Bookings <sup class="badge badge-danger">
                        <?php
             $strSQL = "SELECT fluid_sub_company.id,fluid_booking.id_user,count(*) as Total FROM fluid_booking 
                inner join fluid_user on fluid_booking.id_user=fluid_user.id
                inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id where id_subcompany='".$id_subcompany."' and rank != 'rejected' and rank != 'done'   GROUP BY fluid_booking.id_user";

                        // Execute the query (the recordset $rs contains the result)
                        $rs = mysqli_query($connection, $strSQL);
                        $row = mysqli_fetch_array($rs);
                        //var_dump($row);
                        echo $row['Total'];
                        ?>
                    </sup></span>   </a>
</li>
<?php } ?>


<li class="nav-item">
  <a class="nav-link" href="handshake.php" >
    <i class="fas fa-fw fa-handshake"></i>
    <span>Joined booking</span></a>
</li>
<!-- end of book -->

<hr class="sidebar-divider d-md-block">

<div class="sidebar-heading">
  place & routs
</div>


<!-- Nav Item - company  -->
<li class="nav-item mb-2">
  <a class="nav-link" href="distance.php" id="OurRouts" >
    <i class="fas fa-fw fa-road " ></i>
    <span>Routs</span></a>
</li>

<!-- Nav Item - report -->
<li class="nav-item">
  <a class="nav-link" href="placelist.php" id="avaible">
    <i class="fa fa-location-arrow "></i>
    <span>Place </span></a>
</li>
<hr class="sidebar-divider  d-md-block">
<?php if($_SESSION['role'] != 10){ ?>



<div class="sidebar-heading">
  Campany
</div>


<!-- Nav Item - company  -->
<li class="nav-item mb-2">
  <a class="nav-link" href="company.php">
    <i class="fa fa-building "></i>
    <span>Company</span></a>
</li>

<!-- Nav Item - report -->


<?php } ?>
<hr class="sidebar-divider d-md-block">

<div class="sidebar-heading">
  Cars<?php if($_SESSION['role'] != 10){ ?> & report <?php } ?>
</div>

<!-- Nav Item - report -->
<?php if($_SESSION['role'] == 110){ ?>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRepo" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-database"></i>
    <span>Report</span>
  </a>
  <div id="collapseRepo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">General</h6>
      <a class="collapse-item" href="generalreport.php">General report</a>
      <a class="collapse-item" href="generalreport_employee.php">General report(employees)</a>
      
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Report</h6>
      
      <a class="collapse-item" href="report.php">Daily Report </a>
      <a class="collapse-item" href="companyreport.php">Company Report <sup class="badge badge-danger badge-counter">3</sup><sup></a>
      
    </div>
  </div>
</li>
<?php } ?>
<!-- Nav Item - cars -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-car"></i>
    <span>Cars</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <?php if($_SESSION['role'] != 10){ ?>
        <h6 class="collapse-header">Cars info:</h6>
        <a class="collapse-item" href="carlist.php" id="OurCars">Car list</a>
        <a class="collapse-item" href="carlocation.php" id="LocateCars" >Car location</a>
        <a class="collapse-item" href="cardriver.php">Drivers </a>
       
        <div class="collapse-divider"></div>

     <?php } ?>
     <?php if($_SESSION['role'] != 20){ ?>
      <h6 class="collapse-header">Cars info:</h6>
      <a class="collapse-item" href="carlist.php" id="OurCars">Car list</a>
      <a class="collapse-item" href="cardriver.php" id="Drivers" >Drivers </a>

      <?php } ?>
      <h6 class="collapse-header">Car ploblems:</h6>
      <a class="collapse-item" href="unavailable_car.php" id="Unavailable" >Unavailable cars <sup class="badge badge-danger badge-counter">
        <?php $query =" SELECT plaque from fluid_car where standard != ?";
             $status = 'available';
             $stmt  = $connection->prepare($query);
              $stmt->bind_param('s',$status);
              $stmt->execute();
              $stmt->store_result();
              $unavailbaleCar = $stmt->num_rows;
              echo $unavailbaleCar ;

        ?>
      </sup><sup></a>
      
    </div>
  </div>
</li>

<!-- Nav Item - report -->

<?php if($_SESSION['role'] != 10){ ?>
<li class="nav-item">
  <a class="nav-link" href="kmscount.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Fuel management</span></a>
</li>

<?php } ?>


<?php } ?>



</ul>