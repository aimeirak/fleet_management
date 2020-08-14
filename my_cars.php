<?php 
session_start();
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

        <h2>Cars</h2>
        <div class="row">


            <div class="col-md-12">
                <!--<a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
                   data-toggle="modal"><span
                            class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add</a>-->

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
                        <th>INSURANCE</th>
                        <th>CONTROL_TECHNIQUE</th>
                        <th>STANDARD</th>
                        <th>FUEL CONSUMPTION</th>
                        <th></th>

                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = "SELECT* from fluid_car where id_driver=" . $_SESSION["id"];

                    $result1 = mysqli_query($connection, $sql1);


                    if (mysqli_num_rows($result1) > 0) {
                        $sql = 'SELECT subcompany_name FROM fluid_sub_company WHERE id=' . $id_subcompany;
                        $subcompany = mysqli_fetch_array(mysqli_query($connection, $sql))['subcompany_name'];


                        echo 'List of cars - ' . $subcompany;

                        while ($row = mysqli_fetch_array($result1)) {


                            echo(

                                '


        <tr>' .


                                '<td>' . $row["plaque"] . '</td>' .
                                '<td>' . $row["marque"] . '</td>' .
                                '<td>' . $row["insurance_date"] . '</td>' .
                                '<td>' . $row["control_technique_date"] . '</td>' .
                                '<td>' . $row["standard"] . '</td>' .
                                '<td>' . $row["fuel_consumption"] . '</td>' .
                                '<td>' . '<a  href="updatecarlist.php?id=' . $row["id"] . '";><input class="btn btn-info" type="submit" value="Update" ></a>' . '</td>' .


                                '</tr>'
    
                            );

                        }
                    } else if (mysqli_num_rows($result1) > 0) {
                        $effectiveDate = date('Y-m-d', strtotime("+11 months", strtotime($effectiveDate)));

                        $sql1 = "SELECT fluid_user.id,fluid_user.email,fluid_car.id_subcompany,fluid_car.insurance_date,fluid_car.control_technique_date from fluid_car 
                                    inner join fluid_user on fluid_car.id_subcompany=fluid_user.id
                                     where insurance_date='" . $effectiveDate . "' and
                                       control_technique_date='" . $effectiveDate . "' ";

                        $result = mysqli_query($connection, $sql1);
                        $row = mysqli_fetch_array($result);
                        $email = $row["email"];
                        $rank = $row["rank"];
                        if (mysqli_num_rows($result) > 0) {

                            $to = 'sezeranochrisostom123@gmail.com';


                            $subject = "you have to check about your car docs!";
                            $sender = "ishyigasoftware900@gmail.com";
                            $sender_name = " Car verification";
                            $message = "please either your Car insurance or your Techniqual control is going to be expired!!";
                           include "include/emailSender.php";
                           $emailSent = sendEmail($subject,$sender,$sender_name,$to,$message);
                        if($emailSent){
                            echo"car verification sent";
                        }else{
                            echo"email not sent";
                       
                        }

                        }else{
                            echo"0 result";
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

