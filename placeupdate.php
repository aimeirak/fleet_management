<?php ob_start();include('authenticate.php'); ?>
<?php include('connexion.php'); ?>


<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>update client/place</h2>

            </div>
        </div>
        <!-- /. ROW  -->

        <?php

        //echo $id;
        $sql2 = "SELECT * FROM fluid_place";
        $rs2 = mysqli_query($connection, $sql2);


        ?>

        <?php


        if (isset($_POST['submit'])) {

            


            $id = intval(stripslashes($_POST['idd']));
            //$username = mysqli_real_escape_string($connection, $username);
            $name = stripslashes($_POST['client']);
            $id_sector0 = intval(stripslashes($_POST['name']));
            $aboutcontract = stripslashes($_POST['aboutcontract']);


            //$from = mysqli_real_escape_string($connection,$from);

           echo $strsql = "UPDATE `fluid_place` SET `name`='" . $name . "',`id_sector0`=" . $id_sector0 . ",`aboutcontract`='$aboutcontract' WHERE
                          `id`=" . $id . "";


            if (mysqli_query($connection, $strsql)) {
                header("Location:placelist.php");
                die();
            }
        }
        ?>

        <div class="container">
            <div class="input-group">
                <div class="row">
                    <form action="placeupdate.php" method="post">


                        <?php
                        $id = $_GET['id'];
                        //echo $id;
                        $sql = "SELECT * FROM fluid_place WHERE id ='$id' ";
                        $rs = mysqli_query($connection, $sql);

                        $row = mysqli_fetch_array($rs);
                        //var_dump($row);
                        //die();

                        ?>


                        <br><label>client</label><br>
                        <input type="text" name="client" value="<?php echo $row ['name']; ?>" class="form-control">
                        <input type="hidden" name="idd" value="<?php echo $row['id']; ?>">


                        <br><label>sector</label><br>
                        <?php
                        $id = $row['id_sector0'];
                        // $name=stripslashes('name');

                        $sq1 = "SELECT id,name FROM fluid_sector where id='$id'";

                        $result1 = mysqli_query($connection, $sq1);
                        $row1 = mysqli_fetch_array($result1);
                        // var_dump($row1);
                        ?>

                        <select name="name" class="form-control">


                            <?php
                            $sql = "SELECT id,name FROM fluid_sector";
                            $rs = mysqli_query($connection, $sql);
                            ?>

                            <?php
                            echo '
                    <option value=' . $row1['id'] . ' > ' . $row1['name'] . '</option>';
                            while ($row = mysqli_fetch_array($rs)) {
                                echo '
                     <option value=' . $row['id'] . '>' . $row['name'] . '</option>
                        ';
                            }
                            echo '</select>';
                            ?>
                            <?php
                            $i = $_GET['id'];

                            //echo $id;
                            $sql3 = "SELECT * FROM fluid_place WHERE id ='$i' ";
                            $rs3 = mysqli_query($connection, $sql3);

                            $row = mysqli_fetch_array($rs3); ?>

                            <br><label>aboutcontract</label><br>
                            <input type="text" name="aboutcontract" value="<?php echo $row["aboutcontract"]; ?>"
                                   class="form-control">

                            <br><a href="placelist.php"><input type="submit" name="submit" value="update"></a><br>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<?php mysqli_close($connection); ?>

<?php include('footer.php'); ?> 

