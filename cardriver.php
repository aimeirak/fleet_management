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

    <div id="page-inner">
        <h2  class="ml-2">Cars</h2>
        <div class="row">


            <div class="col-md-12">
                <a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
                   data-toggle="modal"><span
                            class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-success"></span> Update</a>

            </div>
        </div>

        <div class="row" style="padding:10px;">
            <?php
            if (isset($_GET["success"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
<strong>Success!</strong>Car successfully updated.
</div>";
            }
            ?>
            <div class="table-responsive p-4">
                <table class="table table-striped table-bordered table-hover display"  id='datatable1' cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>

                       
                        <th>DRIVER</th>
                        <th>PLAQUE</th>


                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = " 
                              SELECT fluid_car.plaque, fluid_user.full_name from fluid_car inner join fluid_user on fluid_car.id_driver=fluid_user.id
                              where fluid_car.id_subcompany=".$id_subcompany."
                    ";

                    $result1 = mysqli_query($connection, $sql1);


                    if (mysqli_num_rows($result1) > 0) {
                        $sql = "SELECT id,subcompany_name FROM fluid_sub_company WHERE id=' . $id_subcompany'";
                        $subcompany = mysqli_fetch_array(mysqli_query($connection, $sql))['subcompany_name'];


                        echo 'List of cars - ' . $subcompany;

                        while ($row = mysqli_fetch_array($result1)) {


                            echo(
                                '
                                 <tr>' .
                                    '<td>' . $row["full_name"] . '</td>' .
                                    '<td>' . $row["plaque"] . '</td>' .

                                '</tr>'
                            );

                        }
                    } else if (mysqli_num_rows($result1) > 0) {
                        $effectiveDate = date('Y-m-d', strtotime("+11 months", strtotime($effectiveDate)));

                        $sql1 = "SELECT fluid_user.id,fluid_user.email,fluid_car.id_subcompany,fluid_car.insurance_date,fluid_car.control_technique_date from fluid_car 
inner join fluid_user on fluid_car.id_subcompany=fluid_user.id where insurance_date='" . $effectiveDate . "' and  control_technique_date='" . $effectiveDate . "' ";

                        $result = mysqli_query($connection, $sql1);
                        $row = mysqli_fetch_array($result);
                        $email = $row["email"];
                        $rank = $row["rank"];
                        if (mysqli_num_rows($result) > 0) {

                            $to = $row["email"];


                            $subject = "you have to check about your car docs!";

                            $message = "please either your Car insurance or your Techniqual control is going to be expired!!";
                            mail($to, $subject, $message);
                        }


                    }
                    ?>
                    <script>
                        $json = json_encode($data);
                        var data = <?= $json?>;

                        $(".myselect").select2({
                            data: data
                        });

                        $('.myselect').on('select2:select', function (e) {

                            $("#myForm").submit();

                        });
                    </script>

                    </body>
                </table>
            </div>


            <?php


            if (isset($_POST['plaque'])) {

                $id_subcompany = $_SESSION['sub_company'];

                $car=stripslashes($_POST['plaque']);
                $driver=stripslashes($_POST['driver']);



                $sql = "
                
                    UPDATE fluid_car 
                    SET id_driver=".$driver."
                    WHERE id=".$car."
                ";

                $result = mysqli_query($connection, $sql);


                if ($result > 0) {
                    header('Location: ' . "cardriver.php?success");

                }
            } else {
                header("carlist.php");

            }


            ?>

            <div class="container">

                <div class="row">


                    <div class="modal" id="addModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="card-header justify-content-between d-flex">
                                <h4 class="modal-title">Car - Driver</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                class="fa fa-times"></i></button>
                                    
                                </div>


                                <div class="modal-body">

                                    <form action="cardriver.php" method="post">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Driver</label>
                                            <select name="driver" class="form-control">
                                                <?php
                                                echo $sql2 = "SELECT id,full_name FROM fluid_user where id_subcompany='" . $id_subcompany . "' and role=30";
                                                $rs2 = mysqli_query($connection, $sql2);
                                                ?>
                                                <?php
                                                    while ($row = mysqli_fetch_array($rs2)) {
                                                        echo '<option value=' . $row['id'] . ' >  ' . $row['full_name'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Car</label>
                                            <select name="plaque" class="form-control">
                                                <?php
                                                    $standard = 'Available';
                                                    $sql2 = "SELECT id,id_subcompany,plaque,standard FROM fluid_car where id_subcompany='" . $id_subcompany . "' and standard='Available'";
                                                    $rs2 = mysqli_query($connection, $sql2);
                                                ?>
                                                <?php
                                                    while ($row = mysqli_fetch_array($rs2)) {
                                                        echo '<option value=' . $row['id'] . ' >  ' . $row['plaque'] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                </div>
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
                                                </div>

<?php include('footer.php'); ?>

