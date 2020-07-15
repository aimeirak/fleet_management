<?php include('authenticate.php'); ?>
<?php include('connexion.php'); ?>

<?php $id_subcompany = $_SESSION['sub_company'];
if ($_SESSION['role'] != 20) {
    header("location: ui.php");
}
?>


    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-6">
                    <h2>Users</h2>
                </div>

            </div>

            <div class="row" style="padding:10px;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>name</th>
                            <th>phone_number</th>
                            <th>email</th>


                        </tr>
                        </thead>
                        <?php
                        $sql = "SELECT id_subcompany,full_name,phone_number,email from fluid_user where id_subcompany='" . $id_subcompany . "'";
                        $result = mysqli_query($connection, $sql);


                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row

                            while ($row = mysqli_fetch_array($result)) {
                                //var_dump($row);

                                echo(

                                    '<tbody>


                                    <tr>' .


                                    '<td>' . $row["full_name"] . '</td>' .
                                    '<td>' . $row["phone_number"] . '</td>' .
                                    '<td>' . $row["email"] . '</td>' .


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
        </div>
    </div>


<?php include('footer.php'); ?>