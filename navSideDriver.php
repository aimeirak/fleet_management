<?php
ob_start();
include('connexion.php');
$id_subcompany= $_SESSION['sub_company'];

?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li class="<?= preg_match('/driver_index.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="driver_index.php"><i class="fa fa-home "></i>Home</a>
            </li>
            <li class="<?= preg_match('/edituser.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="edituser.php"><i class="fa fa-users  "></i>Profile</a>
            </li>

            <li class="<?= preg_match('/my_cars.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="my_cars.php"><i class="fa fa-location-arrow "></i>Cars</a>
            </li>

            <li class="<?= preg_match('/carlocation.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="carlocation.php"><i class="fa fa-car"></i>Car location</a>
            </li>
            <li class="<?= preg_match('/carlocation.php/', $_SERVER['PHP_SELF'])?'active-link':'' ?>">
                <a href="kmscount.php"><i class="fa fa-car"></i>KMS COUNT</a>
            </li>



        </ul>
    </div>

</nav>