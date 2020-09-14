<?php 

ob_start();
include 'include/header.php' ; 
include 'include/authant.php' ;

if(!isset($_SESSION["username"])){
    header("Location: uiupdate.php");
    exit(); }
?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>


<?php $id_subcompany = $_SESSION['sub_company'];
$id_user = $_SESSION['id'];

?>
<body  id="page-top"   >
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


            <div class="col-md-12 d-flex justify-content-between">
            <h2>Cars</h2>
            <?php if($_SESSION['role']== 20){ ?>
                <span class="btn btn-info" data-toggle="modal" data-target="#carRe">
           
                   <span  class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
                   Add</span>
<?php } ?>

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
             <?php
            if (isset($_GET["danger"])) {
                echo "<div class=\"alert alert-danger alert-dismissable\">
                <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                <strong>Success!</strong>car was not inserted 
                </div>";
            }
            
            ?>
            <div class="table-responsive" >
                <table id='datatable1' class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>

                        <th>PLAQUE</th>
                        <th>MODEL</th>
                        <th>INSURANCE</th>
                        <th>CONTROL_TECHNIQUE</th>
                        <th>STANDARD</th>
                        <th>FUEL CONSUMPTION</th>
                        
                        <th>SEATS</th>
                        <?php if($_SESSION['role'] == 20){ ?>
                            <th></th>
                             <?php } ?>
                        


                    </tr>
                    </thead>
                    <body>
                    <?php

                    $sql1 = "SELECT * from fluid_car   where fluid_car.id_subcompany=" . $_SESSION["sub_company"];

                    $result1 = mysqli_query($connection, $sql1);


                    if (mysqli_num_rows($result1) > 0) {
                        $sql = 'SELECT subcompany_name FROM fluid_sub_company WHERE id=' . $id_subcompany;
                        $subcompany = mysqli_fetch_array(mysqli_query($connection, $sql))['subcompany_name'];

                        echo 'List of cars - ' . $subcompany;

                        while ($row = mysqli_fetch_array($result1)) {


                            echo

                                '<tr>' .

                                    '<td>' . $row["plaque"] . '</td>' .
                                    '<td>' . $row["marque"] . '</td>' .
                                    '<td>' . $row["insurance_date"] . '</td>' .
                                    '<td>' . $row["control_technique_date"] . '</td>' .
                                    '<td>' .'<span style="color:white" class="lebal '.(($row['standard']=='available')?'bg-success':'bg-danger').'">'.$row["standard"].'</span>'. '</td>' .
                                    '<td>' . $row["fuel_consumption"] . '</td>' .
                                    
                                    '<td>' . $row["seats"] . '</td>' ;
                                   if($_SESSION['role'] == 20){ 
                                   
                                echo    '<td>' . '<a href="updatecarlist.php?id=' . $row["id"] . '";><input type="submit" value="Update" ></a>' .
                                    '<a href="update_car_status.php?id=' . $row["id"] . '";><input type="submit" value="Change status" ></a>'.
                                   
                                    '</td>' .
                                '</tr>';
                                  
                            }


                       

                        }
                    } 
                    ?>

                    </body>
                </table>
            </div>


            <?php


            if (isset($_POST['insertCar'])) {

                $id_subcompany = $_SESSION['sub_company'];
                $plaque = stripslashes($_POST['plaque']);
                $marque = stripslashes($_POST['marque']);
                $insurance_date = stripslashes($_POST['insurance_date']);
                $control_technique_date = stripslashes($_POST['control_technique']);
                $standard = stripslashes($_POST['standard']);
                $fuel_consumption = stripslashes($_POST['fuel_consumption']);
                $id_driver=0;
                $seats=stripslashes($_POST['seats']);


                $sql = "INSERT into fluid_car (id_subcompany,plaque,marque, insurance_date,control_technique_date,standard,fuel_consumption,id_driver,seats) values (" . $id_subcompany . ",'" . $plaque . "','" . $marque . "','" . $insurance_date . "','" . $control_technique_date . "','" . $standard . "','" . $fuel_consumption . "',".$id_driver.",'".$seats."')";


                $result = mysqli_query($connection, $sql);


                if ($result > 0) {
                    header("Location:carlist.php?success");

                }else{
                    header("Location:carlist.php?danger");
                }
            } 


            ?>
 


 <div class="modal fade" id="carRe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">car registration</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
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

                                       
                                        <label >Seats</label>
                                        <input type="text" name="seats" placeholder="number of seats" class="form-control">
                                                <div class="modal-footer">
                                                    <button name="insertCar" type="submit" class="btn btn-primary pull-left">Save</button>
                                                    
                                    </form>
        </div>
   
      </div>
    </div>
  </div>




            </div>
        </div>
    </div>


<?php include('include/footerui.php'); ?>

