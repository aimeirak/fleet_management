<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<?php $id_subcompany = $_SESSION['sub_company']; ?>

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
        <div class="row">
           

            <!-- /. ROW  -->

            <?php


            if (isset($_POST['submit'])) {
                // removes backslashes

                $id_user = intval($_SESSION['id']);
                //$username = mysqli_real_escape_string($connection, $username);
                $name = stripslashes($_POST['departure']);
                $id_sector0 = stripslashes($_POST['name']);
                $aboutcontract = stripslashes($_POST['aboutcontract']);

                //$from = mysqli_real_escape_string($connection,$from);

                $sql = "INSERT into fluid_place (id_user,name,id_sector0,aboutcontract) values(" . $id_user . ",'" . $name . "'," . $id_sector0 . ",'" . $aboutcontract . "')";

                $result = mysqli_query($connection, $sql);
                //var_dump($result);


                if ($result) {
                    header("Location: placelist.php");
                }
            } else {

            }


            ?>

  
            <div class="col-12 col-md-9 " >

                    <div class="card shadow" style="margin: auto;">
                        <div class="card-header d-flex">
                            <h2>Adding place</h2>
                        </div>
                        <div class="card-body ">
                            <form action="place.php" method="post" >


                                <br><label >place(hotpoint)</label><br>
                                <input class="form-control" type="text" name="departure" placeholder="place(hotpoint)" required>



                            <?php

                            $sq = "SELECT id,name FROM fluid_sector";
                            $rslt = mysqli_query($connection, $sq);
                            ?>

                            <br><label>Sector</label><br>
                            <select name="name" class="form-control">

                                <?php
                                while ($row = mysqli_fetch_array($rslt)) {
                                    echo '
                     <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
                        ';
                                }
                                echo '</select>';
                                ?>

                                <br><label>Contract status</label><br><input type="text" name="aboutcontract" class="form-control" required><br>

                                <br><input class="btn btn-success form-control"type="submit" name="submit" value="register"></a><br>


                        </form>
                        </div>
                        <div class="card-footer text-info d-flex">
                            <p>Please make sure you mention well hotpoint or write hot point only: <code> Muhire(town) or town </code>  </p>
                        </div>
                        

                    </div>

                   

                    </div>
                
            </div>
        </div>
    </div>
</div>


<?php include('include/footerui.php'); ?>

