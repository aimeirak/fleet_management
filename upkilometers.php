<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>  
<body id="page-top"  >
<div id="wrapper">
<!--sidbar start -->
<?php include 'include/navbar.php'; ?>


<!--sidbar end-->
<div id='content-wrapper' class="d-flex flex-column">
    <?php
    require_once('include/topbon.php');
    ?>
    
    <div id="page-inner">
        <div class="row">
            <div class="col-md-4">
                <h2>Update route</h2>

            </div>
        </div>
        <!-- /. ROW  -->

        <?php
        $sql2 = "SELECT * FROM fluid_distance";
        $rs2 = mysqli_query($connection, $sql2);
        ?>

        <?php
        $username = $_SESSION['username'];


        if (isset($_POST['km'])) {



            $id_user = $_SESSION['id'];
            $id_sector0 = intval(stripslashes($_POST['from']));
            $id_sectorf = intval(stripslashes($_POST['to']));
            $kilometers = stripslashes($_POST['km']);


            $sql = "SELECT kilometers FROM fluid_distance WHERE id_sector0=" . $id_sector0 . " AND id_sectorf=" . $id_sectorf;
            $res = mysqli_query($connection, $sql);


            $count = mysqli_num_rows($res);


            if($count==0)
            {

                //var_dump($_POST);
                 $strsql = "INSERT INTO `fluid_distance` (id_user,id_sector0,id_sectorf,kilometers) VALUES(".$id_user.",".$id_sector0.",".$id_sectorf.",".$kilometers.") ";

            }
            else
            {
                //$row = mysqli_fetch_array($res);
                 $strsql = "UPDATE `fluid_distance` SET `kilometers`='" . $kilometers . "' where `id_sector0`=" . $id_sector0 . " and `id_sectorf`=" . $id_sectorf ;

            }

            if (mysqli_query($connection, $strsql)) {
                //echo 'good';
                header("Location: distance.php");
            }
        }


        ?>


        
            <div class="row">
                <div class="col-lg-9 p-4">
                    <form class="card p-5"action="upkilometers.php" method="post">

                        <?php

                        $sql = "SELECT name from fluid_sector WHERE id=" . $_GET['from_id'];
                        $res = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_array($res);
                        $sector1 = $row['name'];

                        ?>

                        <?php

                        $sql = "SELECT name from fluid_sector WHERE id=" . $_GET['to_id'];
                        $res = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_array($res);
                        $sector2= $row['name'];


                        ?>

                        <input type="hidden" class="form-control" id="km" name="from" value="<?=$_GET['from_id']?>">
                        <input type="hidden" class="form-control" id="km" name="to" value="<?=$_GET['to_id']?>">

                        <div class="form-group">
                            <label for="km">From - <?= $sector1 ?></label>
                            <input type="text" disabled class="form-control" id="km" name="to_text" value="<?=$_GET['from']?>">
                        </div>

                        <div class="form-group">
                            <label for="km">To - <?= $sector2 ?></label>
                            <input type="text" disabled class="form-control" id="km" name="to_text" value="<?=$_GET['to']?>">
                        </div>

                        <div class="form-group">
                            <label for="km">Miles (Km)</label>
                            <input type="text" class="form-control" id="km" name="km">
                        </div>

                        </br>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
              
            </div>
        </div>
        </div>
    </div>
    </div>



<?php include('footer.php'); ?> 

