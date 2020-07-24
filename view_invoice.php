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

        <!-- /. ROW  -->

        <?php
        //echo $id;
        $sql2 = "SELECT * FROM fluid_kms where id_subcompany=" . $id_subcompany . "";
        $rs2 = mysqli_query($connection, $sql2);
        ?>

        <?php
        $id = $_GET['id'];
        //echo $id;
        $sql = "SELECT * FROM fluid_kms WHERE id ='$id' and id_subcompany=" . $id_subcompany . " ";
        $rs = mysqli_query($connection, $sql);

        $row_t = mysqli_fetch_array($rs);


        ?>

        <div class="row">
            <div class="col-md-12">
                <h4>Invoice on <?= date_format(date_create($row_t['theday']), 'Y-m-d') ?></h4>

            </div>
        </div>

        <?php

       
        //var_dump( $target_file );


        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $id_car = stripcslashes($_POST['plaque']);
            //$theday = stripslashes($_POST['date']);
            $initial = stripslashes($_POST['initial']);
            $lefton = stripslashes($_POST['left']);
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $check = true;
        $target_dir = "uploads/invoices";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            //var_dump($uploadOk);
            //die();

            //$from = mysqli_real_escape_string($connection,$from);

            echo $strsql = "UPDATE `fluid_kms` SET initial='$initial',lefton='$lefton' WHERE id=$id";


            if (mysqli_query($connection, $strsql)) {
                header("Location:kmscount.php");
                die();
            }
        }
        ?>

        <div class="container">
            <div class="input-group">
                <div class="row">
                    <div class="col-12 col-lg-12">

                        <table class=" table table-responsive table-striped " style="width: 90%" >
                            <tr>
                                <td>Amount</td>
                                <td><?= $row_t['amount'] ?> Rwf</td>
                            </tr>
                            <tr>
                                <td>Qty</td>
                                <td><?= $row_t['qty'] ?> Liters</td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div>
                    <hr>
                </div>
                <div class="row">


                    <div class="col-4">

                        <img class="img-responsive" src="uploads/<?= $row_t['picture'] ?>" style="width: 100%" >

                    </div>


                </div>
            </div>
        </div>


    </div>
</div>

<?php mysqli_close($connection); ?>

<?php include('include/footerui.php'); ?> 

