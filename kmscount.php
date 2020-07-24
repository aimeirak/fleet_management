<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>


<?php $id_subcompany = $_SESSION['sub_company'];
$id_user = $_SESSION['id'];

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
        <h2>Fuel Management</h2>
        <div class="row">


            <div class="col-md-12">
               
                <span class="collapsed btn btn-primary ml-4  pull-right"  data-toggle="collapse" data-target="#kmsform" aria-expanded="true" aria-controls="joinform">
           
           <span>Add<i class="fas fa-fw fa-plus"></i></span> 
           
         </span>
            </div>
        </div>

        <div class="row p-3" style="padding:10px;">
            <?php
            if (isset($_GET["success"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Success!</strong>kilometers successfully added.
                    </div>";
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>CAR</th>
                        <th>DATE</th>
                        <!--<th>INITIAL</th>-->
                        <th>LEFT</th>
                        <th>AMOUNT</th>
                        <th>LITERS</th>
                        <?php if($_SESSION['role'] == 20 ){ ?>
                        <th>EDIT</th>
                        <?php } ?>

                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = "SELECT fluid_kms.id,fluid_kms.id_subcompany,fluid_kms.id_car,fluid_car.plaque,fluid_kms.theday,fluid_kms.initial,fluid_kms.lefton,fluid_kms.amount,fluid_kms.qty FROM fluid_kms INNER JOIN fluid_car ON fluid_kms.id_car=fluid_car.id where fluid_kms.id_subcompany=" . $_SESSION["sub_company"] . " order by fluid_kms.theday desc";

                    $result1 = mysqli_query($connection, $sql1);


                    if (mysqli_num_rows($result1) > 0) {
                        $sql = 'SELECT subcompany_name FROM fluid_sub_company WHERE id=' . $id_subcompany;
                        $subcompany = mysqli_fetch_array(mysqli_query($connection, $sql))['subcompany_name'];

                        echo 'kilometers of - ' . $subcompany;

                        while ($row = mysqli_fetch_array($result1)) {


                            echo

                                '<tr>' .

                                '<td>' . $row["plaque"] . '</td>' .
                                '<td>' . $row["theday"] . '</td>' .
                                '<td>' . $row["lefton"] . '</td>' .
                                '<td>' . $row["amount"] . '</td>' .
                                '<td>' . $row["qty"] . '</td>' ;
                               
                                if($_SESSION['role'] == 20 ){  
                                    echo '<td >' . '<a class="btn btn-success a-btn-slide-text" href="updatekms.php?id=' . $row["id"] . '"> <span class="fa fa-edit" aria-hidden="true"></span></a>'
                                .' <a class="btn btn-info a-btn-slide-text" href="view_invoice.php?id=' . $row["id"] . '"> <span class="fa fa-eye" aria-hidden="true"></span></a>'.'</td>' .

                                '</tr>'

                            ;
                            }

                        }
                    }
                    ?>

                    </body>
                </table>
            </div>


            <?php

           
            if (isset($_POST['date'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

                $id_subcompany = $_SESSION['sub_company'];
                $id_car = stripcslashes($_POST['plaque']);
                $theday = stripslashes($_POST['date']);

                //$initial = stripslashes($_POST['initial']);
                $initial=0;
                $lefton = stripslashes($_POST['left']);
                $amount = stripslashes($_POST['amount']);
                $qty= stripslashes($_POST['qty']);


                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                $check=true;
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                if ($_FILES["fileToUpload"]["size"] > 500000000000) {
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

                        $picture=$_FILES["fileToUpload"]["name"];
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }


                echo $sql = "INSERT into fluid_kms (id_subcompany,id_car,theday,initial,lefton,picture,amount,qty) values (" . $id_subcompany . "," . $id_car . ",'" . $theday . "'," . $initial . "," . $lefton . ",'" . $picture. "',".$amount.",".$qty.")";


                $result = mysqli_query($connection, $sql);


                if ($result > 0) {
                    header('Location: ' . "kmscount.php?success");

                }
            } else {
                header("kmscount.php");

            }


            ?>

            <div class="container">

                <div class="row">


                    <div class="collapse ml-5" id="kmsform" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="card-header d-flex justify-content-between">
          
                                    <h4 class="modal-title">Upload fuel invoice</h4>
                                    <button type="button" class="close" data-toggle="collapse" data-target="#kmsform" aria-expanded="true" aria-controls="joinform"><i
                                                class="fa fa-times"></i></button>
                                </div>


                                <div class="modal-body">

                                    <form action="kmscount.php" method="post" enctype="multipart/form-data" class="form-horizontal">


                                        <label>company</label>
                                        <input type="text" name="sub_company" disabled
                                               placeholder="<?php echo $_SESSION['sub_company'] ?>"
                                               class="form-control">
                                        <?php

                                        $sql2 = "SELECT id,id_subcompany,plaque FROM fluid_car where id_subcompany='" . $id_subcompany . "'";
                                        $rs2 = mysqli_query($connection, $sql2); ?>

                                        <label>select car</label>
                                        <select name="plaque" class="form-control">
                                            <?php
                                            while ($row = mysqli_fetch_array($rs2)) {
                                                echo '
                                            <option value=' . $row['id'] . ' >  ' . $row['plaque'] . '</option>
                                            ';
                                            }
                                            echo '</select>';
                                            ?>


                                            <label>Date</label>
                                            <input id="datetimepicker1" type="text" name="date" placeholder="Choose date"
                                                   class="form-control">

                                            <!--<label>initial</label>
                                            <input type="text" name="initial" placeholder="Enter initial kms"
                                                   class="form-control">-->

                                            <label>Current mileage</label>
                                            <input type="text" name="left" placeholder="Enter kms left" class="form-control">

                                            <label>Amount</label>
                                            <input type="text" name="amount" placeholder="Rwf" required class="form-control">

                                            <label>Quantity</label>
                                            <input type="text" name="qty" placeholder="Liters" required class="form-control">

                                            <label>Upload invoice</label>
                                            <input type="file" name="fileToUpload" class="form-control id="fileToUpload">


                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary pull-left">Save</button>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" role="button">
                                        Close
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

