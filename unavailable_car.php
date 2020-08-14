<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<?php //include('header.php');?>

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
        <h2>Unavailable cars</h2>
        <div class="row">
            <div class="col-md-12">
                <a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
                   data-toggle="modal"><span
                            class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add</a>

            </div>
        </div>

        <div class="row" style="padding:10px;">
            <?php
            if (isset($_GET["success"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Success!</strong>car successfully added.
                        </div>";
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>

                        <th>PLAQUE</th>
                        <th>MODEL</th>
                        <th>DEPARTURE_TIME</th>
                        <th>ASSUMED_ARRIVAL_TIME</th>
                        <th>REASON</th>
                        <th>STATUS</th>
                        <th></th>

                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = "SELECT* from fluid_unavailable_car inner join fluid_car on fluid_unavailable_car.id_car=fluid_car.id where id_subcompany=" . $_SESSION["sub_company"];

                    $result1 = mysqli_query($connection, $sql1);


                    if ($result1) {

                        while ($row = mysqli_fetch_array($result1)) {


                            echo(

                                '<tr>' .
                                '<td>' . $row["plaque"] . '</td>' .
                                '<td>' . $row["marque"] . '</td>' .
                                '<td>' . $row["departure_time"] . '</td>' .
                                '<td>' . $row["assumed_arrival_time"] . '</td>' .
                                '<td>' . $row["reason"] . '</td>' .
                                '<td>' . $row["status"] . '</td>' .
                                '</tr>'

                            );

                        }
                    } else {
                        echo "wapi";
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
            </div>

            <?php


            if (isset($_POST['plaque'])) {

                $id_subcompany = $_SESSION['sub_company'];
                $plaque = stripslashes($_POST['plaque']);
                $marque = stripslashes($_POST['marque']);
                $insurance_date = stripslashes($_POST['insurance_date']);
                $control_technique_date = stripslashes($_POST['control_technique']);
                $standard = stripslashes($_POST['standard']);
                $fuel_consumption = stripslashes($_POST['fuel_consumption']);


                $sql = "INSERT into fluid_car (id_subcompany,plaque,marque, insurance_date,control_technique_date,standard,fuel_consumption) values (" . $id_subcompany . ",'" . $plaque . "','" . $marque . "','" . $insurance_date . "','" . $control_technique_date . "','" . $standard . "','" . $fuel_consumption . "')";


                $result = mysqli_query($connection, $sql);


                if ($result > 0) {
                    header('Location: ' . "carlist.php?success");

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

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                                class="fa fa-times"></i></button>
                                    <h4 class="modal-title">car registration</h4>
                                </div>


                                <div class="modal-body">

                                    <form action="carlist.php" method="post">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">company</label>
                                            <input type="text" name="plaque" disabled
                                                   placeholder="<?php echo $_SESSION['sub_company'] ?>"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">plaque</label>
                                            <input type="text" name="plaque" placeholder="Enter plaque"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">model</label>
                                            <input type="text" name="marque" placeholder="Enter model"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Insurance</label>
                                            <input type="text" name="insurance_date" placeholder="Enter date"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Control technique</label>
                                            <input type="text" name="control_technique" placeholder="Enter date"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">standard</label>
                                            <select id="cmbMake" name="standard">
                                                <option value="Control Technique">Control Technique</option>
                                                <option value="mechanical issue">Mechanical issue</option>
                                                <option value="poor docs">poor docs</option>
                                                <option value="smart">Available</option>
                                            </select></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">fuel consumption</label>
                                            <input type="text" name="fuel_consumption" placeholder="km/l"></div>

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


<?php include('include/footerui.php'); ?>

