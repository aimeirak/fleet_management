<?php 
include 'include/authant.php';
ob_start();
include 'include/header.php' ; ?>
<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<?php $id_subcompany = $_SESSION['sub_company'];  //include('navSide.php');
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

        <div class="row">
            <div class="col-md-6">
                <h2>List of places</h2>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary pull-right" style="bottom: opx;">
                    <a href="place.php"><span class="btn btn-primary">add</span></a>
                </button>
            </div>
        </div>

        <div class="container">


        </div>

        <div class="row" style="padding:10px;">

            <table class="table table-striped table-bordered table-hover display" id="datatable1" cellspacing="0"
                   width="100%">
                <thead>
                <tr>

                    <th>client</th>
                    <th>sector</th>
                    <th>about contract</th>
                    <th></th>


                </tr>
                </thead>

                <tbody>
                <?php

                if (isset($_POST['submit'])) {
                    //var_dump($_POST);
                    $name = stripslashes($_POST['search']);
                    //var_dump($name);
                    $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_sector.name as 'sector',aboutcontract from fluid_place
                     inner join fluid_user on fluid_place.id_user=fluid_user.id
                     inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                     inner join fluid_sector on fluid_sector.id=fluid_place.id_sector0  where id_subcompany='" . $id_subcompany . "' AND fluid_place.name=" . $name . "";
                    $result = mysqli_query($connection, $sql);


                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row

                        while ($row = mysqli_fetch_array($result)) {
                            //var_dump($row);

                            echo(

                                '


                                    <tr>' .


                                '<td>' . $row["name"] . '</td>' .
                                '<td>' . $row["sector"] . '</td>' .
                                '<td>' . $row["aboutcontract"] . '</td>' .
                                '<td class="text-center">' . '<a href="placeupdate.php?id=' . $row["id"] . '"; class="btn btn-primary">update</a>' . '</td>' .


                                '</tr>
                                '
                            );

                        }
                    }
                } else {

                    $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_sector.name as 'sector',aboutcontract from fluid_place
                     inner join fluid_user on fluid_place.id_user=fluid_user.id
                     inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                     inner join fluid_sector on fluid_sector.id=fluid_place.id_sector0  where id_subcompany='" . $id_subcompany . "'";
                    $result = mysqli_query($connection, $sql);


                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row

                        while ($row = mysqli_fetch_array($result)) {
                            //var_dump($row);

                            echo(

                                '


                                    <tr>' .

                                '<td>' . $row["name"] . '</td>' .
                                '<td>' . $row["sector"] . '</td>' .
                                '<td>' . $row["aboutcontract"] . '</td>' .
                                '<td class="text-center">' . '<a href="placeupdate.php?id=' . $row["id"] . '"; class="btn btn-primary">update</a>' . '</td>' .


                                '</tr>
                                '
                            );


                        }
                    }
                }

                //$json = json_encode($data);
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


                </tbody>
            </table> 
        </div>
    </div>
</div>



<?php include('include/footerui.php'); ?> 
   


