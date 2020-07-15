<?php if(isset($_POST['LocateCars']) && $_POST['LocateCars'] == 1){
    session_start();
    ?>
    
    <?php include('../connexion.php'); ?>


<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];        
?>




<div class="row">
            <div class="col-md-12">
                <h2>Car location</h2>
                <div class="col-md-12">
                    <!-- <a class="btn icon-btn btn-success pull-right" href="#" data-target="#addModal"
                        data-toggle="modal"><span
                                 class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add</a>-->

                </div>
            </div>
        </div>


        <?php
        if (isset($_GET["success"])) {
            echo "<div class=\"alert alert-success alert-dismissable\">
        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
        <strong>Success!</strong>Location successfully added.
        </div>";
        }
        ?>


        <div class="row" style="padding:10px">

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>company</th>
                            <th>plaque</th>

                            <th>address</th>

                        </tr>
                        </thead>
                        <?php
                        $sql = "SELECT fluid_car.id,fluid_car_location.id as pk ,id_place,fluid_sub_company.subcompany_name,fluid_car.plaque,fluid_car_location.id,fluid_place.name,comments,statusname,address from fluid_car_location 
                    inner join fluid_place on fluid_place.id=fluid_car_location.id_place inner join fluid_status on fluid_status.id=fluid_car_location.status_id 
                    inner join fluid_car on fluid_car_location.car_id=fluid_car.id
                    inner join fluid_sub_company on fluid_car.id_subcompany=fluid_sub_company.id where id_subcompany='" . $id_subcompany . "'";

                        $result = mysqli_query($connection, $sql);


                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row

                            while ($row = mysqli_fetch_array($result)) {
                                //var_dump($row);

                                echo(

                                    '<tbody>
                       

                        <tr>' .

                                    '<td>' . $row["id"] . '</td>' .

                                    '<td>' . $row["subcompany_name"] . '</td>' .
                                    '<td>' . $row["plaque"] . '</td>' .

                                    '<td>' . '<a href="javascript:;"  class="location" data-type="select2"
                                                       data-pk="'.$row['pk'].'" data-value="'.$row['id_place'].'"
                                                       data-original-title="Select place"> '.$row['name'].' </a>' . '</td>' .


                                    '</tr>
                    </tbody>'
                                );

                            }
                        } else {
                            echo "0 results";
                        }
                        ?>

                    </table>
                </div>
            </div>
            <?php


            if (isset($_POST['plaque'])) {

                //$id = $_GET['id'];
                $car_id = stripslashes($_POST['plaque']);
                $id_place = stripslashes($_POST['name']);
                $comments = stripslashes($_POST['comments']);
                $status_id = stripslashes($_POST['status']);


                $sql2 = "INSERT into fluid_car_location (car_id,id_place,comments,status_id) values ( " . $car_id . "," . $id_place . ",'" . $comments . "'," . $status_id . ")";


                $result2 = mysqli_query($connection, $sql2);


                if ($result2 > 0) {
                    header('Location: ' . "carlocation.php?success");

                }
            } else {
                header("carlocation.php");

            }


            ?>

            <div class="container">

                <div class="row">


                    <div class="modal" id="addModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <i
                                                class="fa fa-times"></i></button>
                                    <h4 class="modal-title">Location</h4>
                                </div>


                                <div class="modal-body">

                                    <form action="carlocation.php" method="post">

                                        <div class="form-group">
                                            <?php

                                            $sql2 = "SELECT id,id_subcompany,plaque FROM fluid_car where id_subcompany='" . $id_subcompany . "'";
                                            $rs2 = mysqli_query($connection, $sql2); ?>

                                            <label>plaque</label>
                                            <select name="plaque" class="form-control">
                                            <?php
                                            while ($row = mysqli_fetch_array($rs2)) {
                                                echo '
             <option value=' . $row['id'] . ' >  ' . $row['plaque'] . '</option>
                ';
                                            }
                                            echo '</select>';
                                            ?></div>
                                        <div class="form-group">
                                            <?php

                                            $sql3 = "SELECT fluid_place.id,fluid_place.id_user,fluid_user.id_subcompany,fluid_place.name FROM fluid_place inner join fluid_user on fluid_place.id_user=fluid_user.id inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id where fluid_sub_company.id='" . $id_subcompany . "'";
                                            $rs3 = mysqli_query($connection, $sql3); ?>

                                            <label>location</label>
                                            <select name="name" class="form-control">
                                            <?php
                                            while ($row = mysqli_fetch_array($rs3)) {
                                                echo '
             <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
                ';
                                            }
                                            echo '</select>';
                                            ?></div>
                                        <div class="form-group">
                                            <label>Why?</label>
                                            <input type="text" name="comments" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <?php

                                            $sql4 = "SELECT* FROM fluid_status";
                                            $rs4 = mysqli_query($connection, $sql4); ?>

                                            <label>status</label>
                                            <select name="status" class="form-control">
                                            <?php
                                            while ($row = mysqli_fetch_array($rs4)) {
                                                echo '
             <option value=' . $row['id'] . ' >  ' . $row['statusname'] . '</option>
                ';
                                            }
                                            echo '</select>';
                                            ?></div>
                                        <div class="form-group">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary pull-left">Save
                                            </button>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                            role="button">
                                        Close
                                    </button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
<?php
$sql = "SELECT fluid_place.id,name FROM fluid_place INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=" . $_SESSION['sub_company'];
$res = mysqli_query($connection, $sql);
$data = [];
while ($row = mysqli_fetch_array($res)) {
    $data[] = [
        'id' => $row['id'],
        'text' => $row['name'],
    ];
}

$json = json_encode($data);
//var_dump($json);
?>
<script>

    var data = <?= $json?>;

    $('.location').editable({
        inputclass: 'form-control input-medium',
        source: data,
        url:'update_location.php',
    });

</script>

<style>
    .select2-container {
        min-width:180px;
    }
</style>

<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
<?php } ?>

<?php include('../include/footerui.php'); ?>