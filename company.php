<?php //ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>
<?php //include('header.php');?>

<?php //include('navSide.php');?>


<div id="page-wrapper">
    <div id="page-inner">
        <h2>Companies</h2>
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
          <strong>Success!</strong> successfully added.
          </div>";
            }
            ?>
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th>company</th>

                    <th>Tin_number</th>
                    <th>Email</th>
                    <th>Location</th>

                </tr>
                </thead>
                <?php
                $sql1 = "SELECT*from fluid_company";

                $result1 = mysqli_query($connection, $sql1);
                // var_dump($result);


                if (mysqli_num_rows($result1) > 0) {
                    // output data of each row

                    while ($row = mysqli_fetch_array($result1)) {
                        //var_dump($row);

                        echo(

                            '<tbody>


                                    <tr>' .

                            //'<td>'.$row["id"].'</td>'.
                            '<td>' . $row["company_name"] . '</td>' .

                            '<td>' . $row["tin_number"] . '</td>' .
                            '<td>' . $row["email"] . '</td>' .

                            '<td>' . $row["location"] . '</td>' .


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
            <!-- /. ROW  -->

            <?php


            if (isset($_POST['tin_number'])) {
                //var_dump($_POST);
                //die();
                // removes backslashes

                //$id= intval($_POST['id']);
                //$username = mysqli_real_escape_string($connection, $username);
                //$id_company =intval(stripslashes($_POST['id_company']));
                $subcompany_name = stripslashes($_POST['subcompany_name']);
                $company_name = stripslashes($_POST['company_name']);
                $tin_number = stripslashes($_POST['tin_number']);
                $email = stripslashes($_POST['email']);
                $location = stripslashes($_POST['location']);

                //$from = mysqli_real_escape_string($connection,$from);

                $sql = "INSERT into fluid_company(company_name,tin_number,email,location) values ('$company_name','$tin_number','$email','$location')";
                //echo $sql;

                $result = mysqli_query($connection, $sql);
                if ($result) {

                    $last_id = mysqli_insert_id($connection);
                    //var_dump($result);
                    //die();


                    $sql2 = "INSERT into fluid_sub_company(id_company,subcompany_name,tin_number,email,Location) values ('$last_id','$subcompany_name','$tin_number','$email','$location')";
                    echo $sql2;

                    $result = mysqli_query($connection, $sql2);
                    //var_dump($result);
                    //die();
                }


                if ($result > 0) {
                    header('Location: ' . "company.php?success");

                }
            } else {
                header("company.php");

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
                                    <h4 class="modal-title">company registration</h4>
                                </div>


                                <div class="modal-body">

                                    <form action="company.php" method="post">


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">company</label>
                                            <input type="text" name="company_name" placeholder="company_name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Branch</label>
                                            <input type="text" name="subcompany_name" placeholder="branch name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tin_number</label>
                                            <input type="text" name="tin_number" placeholder="Enter tin"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email</label>
                                            <input type="text" name="email" placeholder="Enter email"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Location</label>
                                            <input type="text" name="location" placeholder="Enter location"></div>

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


<?php include('footer.php'); ?>

