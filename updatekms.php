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
            <div class="col-md-8 col-lg-offset-2">
                <h2>update kilometers</h2>

            </div>
        </div>
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
        //var_dump($row_t);
        //die();

        ?>

        <?php




        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $id_car = stripcslashes($_POST['plaque']);
            //$theday = stripslashes($_POST['date']);
            $initial = stripslashes($_POST['initial']);
            $lefton = stripslashes($_POST['left']);
            $amount=stripcslashes($_POST['amount']);
            $qty=stripslashes($_POST['qty']);
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            $check=true;
        $target_dir = "uploads/invoices";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($check !== false) {
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
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            //var_dump($uploadOk);
            //die();

            //$from = mysqli_real_escape_string($connection,$from);

            echo $strsql = "UPDATE `fluid_kms` SET lefton='$lefton',amount='$amount',qty='$qty' WHERE id=$id";


            if (mysqli_query($connection, $strsql)) {
                header("Location:kmscount.php");
                die();
            }
        }
        ?>
    <div class="col-md-8 col-lg-offset-2">
        <div class="container">
            <div class="input-group">
                <div class="row">
                    <form method="post" enctype="multipart/form-data">

                        <?php

                        $sql2 = "SELECT plaque FROM fluid_car where id='" . $row_t['id_car'] . "'";
                        $rs2 = mysqli_query($connection, $sql2);
                        $row_c = mysqli_fetch_array($rs2);

                        ?>

                        <label>Car</label>
                        <input class="form-control" type="text" name="left" value="<?= $row_c['plaque'] ?>">
                        <br><label>theday</label><br>
                        <input id="datetimepicker1" type="text" name="date" value="<?= $row_t['theday'] ?>"
                               class="form-control">
                        <label>Lefton</label>
                        <input type="text" name="left" value="<?= $row_t['lefton'] ?>" class="form-control">
                         <br><label>amount</label><br>
                        <input type="text" name="amount" value="<?= $row_t['amount'] ?>" class="form-control">
                         <br><label>liters</label><br>
                        <input type="text" name="qty" value="<?= $row_t['qty'] ?>" class="form-control">
                        <input type="file" name="fileToUpload" id="fileToUpload">

                        <br><a href="kmscount.php"><input type="submit" class="bt btn-primary" name="submit"
                                                          value="update"></a><br>
                    </form>
                </div>
            </div>
        </div>


    </div></div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker
        (
            {
                format: "YYYY-MM-DD",
            }
        );
    });
</script>


<?php include('include/footerui.php'); ?> 

