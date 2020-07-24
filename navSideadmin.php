<?php
//error_reporting(0);
include('connexion.php');
$id_subcompany= $_SESSION['sub_company'];
?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">


            <li class="<?= preg_match('/bookinglist.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="bookinglist.php"><i class="fa fa-calendar "></i>Bookings
                    <span class="badge">
                        <?php
             $strSQL = "
                SELECT fluid_sub_company.id,fluid_booking.id_user,count(*) as Total FROM fluid_booking 
                inner join fluid_user on fluid_booking.id_user=fluid_user.id
                inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id where id_subcompany='".$id_subcompany."' GROUP BY fluid_booking.id_user";

                        // Execute the query (the recordset $rs contains the result)
                        $rs = mysqli_query($connection, $strSQL);
                        $row = mysqli_fetch_array($rs);
                        //var_dump($row);
                        echo $row['Total'];
                        ?>
                    </span>
                </a>
            </li>

            <li class="<?= $_SERVER['PHP_SELF']=='/test_car/edituser.php'?'active-link':'' ?>">
                <a href="edituser.php"><i class="fa fa-users  "></i>Profile
                    <span class="badge"></span>
                </a>
            </li>

            <li class="<?= $_SERVER['PHP_SELF']=='/test_car/user.php'?'active-link':'' ?>">
                <a href="user.php"><i class="fa fa-users  "></i>Users
                    <span class="badge">
                       <?php
                      $SQL = "SELECT count(*) as Total FROM fluid_user where id_subcompany='".$id_subcompany."'";

                       // Execute the query (the recordset $rs contains the result)
                       $res = mysqli_query($connection, $SQL);
                       $row = mysqli_fetch_array($res);
                       //var_dump($row);
                       echo $row['Total'];
                       ?>
                    </span>
                </a>
            </li>
            <li class="<?= preg_match('/placelist.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="placelist.php"><i class="fa fa-location-arrow "></i>Places</a>
            </li>
            <li class="<?= preg_match('/distance.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="distance.php"><i class="fa fa-road "></i>Route</a>
            </li>
            <li class="<?= preg_match('/company.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="company.php"><i class="fa fa-building "></i>company</a>
            </li>

            <li class="<?= preg_match('/adminbook.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="adminbook.php"><i class="fa fa-check-square "></i>Approave<span class="badge">1</span></a>
            </li>


            <li class="dropdown <?= preg_match('/carlist.php/', $_SERVER['PHP_SELF'])||preg_match('/carlocation.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-car"></i>Cars <span
                            class="caret"></span></span></a>
                <ul class="dropdown-menu forAnimate" role="menu">
                <li><a href="carlist.php">List of Cars</a></li>
                <li><a href="carlocation.php">Car location</a></li>
                <li><a href="unavailable_car.php">Unavailable cars</a></li>
                <li><a href="cardriver.php">Drivers</a></li>


                </ul>
            </li>

            <li class="<?= preg_match('/updatekms.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="kmscount.php"><i class="fa fa-dashboard "></i>Fuel Management</a>
            </li>


            <li class="dropdown <?= preg_match('/report.php/', $_SERVER['PHP_SELF'])||preg_match('/generalreport.php/', $_SERVER['PHP_SELF'])||preg_match('/companysreport.php/', $_SERVER['PHP_SELF'])||preg_match('/distance.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i>Report <span
                            class="caret"></span></span></a>
                <ul class="dropdown-menu forAnimate" role="menu">

                    <li><a href="report.php"><i class="fa fa-database"></i>Daily report</a></li>
                    <li><a href="generalreport.php"><i class="fa fa-database"></i>General report</a></li>
                    <li><a href="generalreport_employee.php"><i class="fa fa-database"></i>General report(Employees)</a></li>
                    <li><a href="companyreport.php"><i class="fa fa-database"></i>Company report</a></li>



                </ul>
            </li>
    </div>

</nav>