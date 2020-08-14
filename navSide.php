<?php
ob_start();
include('connexion.php');
$id_subcompany= $_SESSION['sub_company'];

?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li class="<?= preg_match('/ui.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="index.php"><i class="fa fa-home "></i>Home</a>
            </li>
            <li class="<?= preg_match('/edituser.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="edituser.php"><i class="fa fa-users  "></i>Profile
                    <span class="badge"></span></a></li>

            <li class="<?= preg_match('/placelist.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="placelist.php"><i class="fa fa-location-arrow "></i>places</a>
            </li>

            <li class="<?= preg_match('/bookinglist.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="bookinglist.php"><i class="fa fa-calendar "></i>bookings<span class="//badge">
                        <?php
                        $strSQL = "SELECT fluid_sub_company.id,fluid_booking.id_user,count(*) as Total FROM fluid_booking 
            inner join fluid_user on fluid_booking.id_user=fluid_user.id
            inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id where id_subcompany='".$id_subcompany."' GROUP BY fluid_booking.id_user";


                        // Execute the query (the recordset $rs contains the result)
                        $rs = mysqli_query($connection, $strSQL);
                        $row = mysqli_fetch_array($rs);
                        //var_dump($row);
                        //echo $row['Total'];
                        ?></span></a>
            </li>



            <li class="<?= preg_match('/carlocation.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="carlocation.php"><i class="fa fa-car"></i>Car location</a>
            </li>
            <li class="<?= preg_match('/carlocation.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="KMSCOUNT.php"><i class="fa fa-car"></i>KMS COUNT</a>
            </li>



        </ul>
    </div>

</nav>