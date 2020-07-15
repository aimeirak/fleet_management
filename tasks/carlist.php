
<?php if(isset($_POST['carlist']) && $_POST['carlist'] == 1){
    session_start();
    ?>

    <?php include('../connexion.php'); ?>
<?php //include('header.php');?>

<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];

?>


        <h2>Cars</h2>
        <div class="row">


            <div class="col-md-12">
                <a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
                   data-toggle="modal"><span
                            class="fa fa-plus img-circle mr-2"></span>Add</a>

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
                        <th>DRIVER</th>
                        <th>SEATS</th>
                        <th>Modify</th>
                        <th>Change status</th>
                        <th>Private usage</th>


                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = "SELECT fluid_car.id,fluid_car.plaque,fluid_car.marque,fluid_car.insurance_date,fluid_car.control_technique_date,fluid_car.standard,fluid_car.fuel_consumption,fluid_car.id_driver,fluid_user.username,fluid_car.seats from fluid_car INNER JOIN fluid_user on fluid_user.id=fluid_car.id_driver where fluid_car.id_subcompany=" . $_SESSION["sub_company"];

                    $result1 = mysqli_query($connection, $sql1);


                    if (mysqli_num_rows($result1) > 0) {
                        $sql = 'SELECT subcompany_name FROM fluid_sub_company WHERE id=' . $id_subcompany;
                        $subcompany = mysqli_fetch_array(mysqli_query($connection, $sql))['subcompany_name'];

                        echo 'List of cars - ' . $subcompany;

                        while ($row = mysqli_fetch_array($result1)) {


                            echo(

                                '<tr>' .

                                    '<td>' . $row["plaque"] . '</td>' .
                                    '<td>' . $row["marque"] . '</td>' .
                                    '<td>' . $row["insurance_date"] . '</td>' .
                                    '<td>' . $row["control_technique_date"] . '</td>' .
                                    '<td>' .'<span class="label '.(($row['standard']=='available')?'label-success':'label-danger').'">'.$row["standard"].'</span>'. '</td>' .
                                    '<td>' . $row["fuel_consumption"] . '</td>' .
                                    '<td>' . $row["username"] . '</td>' .
                                    '<td>' . $row["seats"] . '</td>' .
                                    '<td class="ex" >' . '<a  href="updatecarlist.php?id=' . $row["id"] . '";><input class="btn btn-success" type="submit" value="Update" ></a>' .
                                    '</td>' .
                                    '<td class="ex" >'.'<a href="update_car_status.php?id=' . $row["id"] . '";><input class="btn btn-warning"  type="submit" value="Change status" ></a>'.                                   
                                    '</td>' .
                                    '<td class="ex" >'. '<a  href="schedule_private_usage.php?id=' . $row["id"] . '";><input class="btn btn-info" type="submit" value="Private usage" ></a>'.
                                    '</td>' .
                                '</tr>'

                            );

                        }
                    } 
                    ?>

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
                $id_driver=stripslashes($_POST['driver']);
                $seats=stripslashes($_POST['seats']);


               echo $sql = "INSERT into fluid_car (id_subcompany,plaque,marque, insurance_date,control_technique_date,standard,fuel_consumption,id_driver,seats) values (" . $id_subcompany . ",'" . $plaque . "','" . $marque . "','" . $insurance_date . "','" . $control_technique_date . "','" . $standard . "','" . $fuel_consumption . "',".$id_driver.",'".$seats."')";


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

                                    <form action="carlist.php" method="post" class="form-horizontal">

                                        
                                            <label >company</label>
                                            <input type="text" name="plaque" disabled
                                                   placeholder="<?php echo $_SESSION['sub_company'] ?>" class="form-control">
                                        
                                            <label >plaque</label>
                                            <input type="text" name="plaque" placeholder="Enter plaque" class="form-control">
                                        
                                            <label>model</label>
                                            <input type="text" name="marque" placeholder="Enter model" class="form-control">
                                        
                                            <label >Insurance</label>
                                            <input type="text" name="insurance_date" placeholder="Enter date" class="form-control">
                                        
                                            <label >Control technique</label>
                                            <input type="text" name="control_technique" placeholder="Enter date" class="form-control">
                                        
                                            <label >standard</label>
                                            <select id="cmbMake" name="standard" class="form-control">
                                                <option value="Control Technique">Control Technique</option>
                                                <option value="mechanical issue">Mechanical issue</option>
                                                <option value="poor docs">poor docs</option>
                                                <option value="smart">Available</option>
                                            </select>
                                        
                                            <label>fuel consumption</label>
                                            <input type="text" name="fuel_consumption" placeholder="km/l" class="form-control">

                                
                        <?php
                        $sqlu1 = "SELECT * from fluid_user where role='30'";
                        $rst1 = mysqli_query($connection, $sqlu1); 
                        ?>

                        <label>driver</label>
                        <select name="driver" class="form-control">
                        <?php
                        while ($row = mysqli_fetch_array($rst1)) {
                            echo '
                        <option value=' . $row['id'] . ' > ' . $row['username'] . '</option>';

                        }
                        echo '</select>';
                        ?>
                        <label >Seats</label>
                        <input type="text" name="seats" placeholder="number of seats" class="form-control">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary pull-left">Save</button>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" role="button">
                                        Close
                                    </button>
                                </div></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   



<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
<?php } ?>

<?php include('../include/footerui.php'); ?>