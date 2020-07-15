<?php if(isset($_POST['NewPlace']) && $_POST['NewPlace'] == 1){
    session_start();
    ?>
    
    <?php include('../connexion.php'); ?>


<?php $id_subcompany = $_SESSION['sub_company'];
        $id_user = $_SESSION['id'];

        
?>

 <div  class=" col-12  align-items-center">
<div class="text-center">
                <h2>Add place</h2>

            </div>

            <!-- /. ROW  -->

            <?php


            if (isset($_POST['registerPlace'])) {
                // removes backslashes

                $id_user = intval($_SESSION['id']);
                //$username = mysqli_real_escape_string($connection, $username);
                $name = stripslashes($_POST['departure']);
                $id_sector0 = stripslashes($_POST['name']);
                $aboutcontract = stripslashes($_POST['aboutcontract']);

                //$from = mysqli_real_escape_string($connection,$from);

                $sql = "INSERT into fluid_place (id_user,name,id_sector0,aboutcontract) values(" . $id_user . ",'" . $name . "'," . $id_sector0 . ",'" . $aboutcontract . "')";

                $result = mysqli_query($connection, $sql);
                //var_dump($result);


                if ($result) {
                    header("Location: placelist.php");
                }
            } else {

            }


            ?>

            <div class="col-md-8 align-items-center">

                    <form class="row" style="padding:10px">

                       


                                <br><label >Client</label><br>
                                <input class="form-control" type="text" name="departure" value="client">



                            <?php

                            $sq = "SELECT id,name FROM fluid_sector";
                            $rslt = mysqli_query($connection, $sq);
                            ?>

                            <br><label>Sector</label><br>
                            <select name="name" class="form-control">

                                <?php
                                while ($row = mysqli_fetch_array($rslt)) {
                                    echo '
                     <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
                        ';
                                }
                                echo '</select>';
                                ?>

                                <br><label>Contract status</label><br><input type="text" name="aboutcontract" class="form-control" ><br>

                                <br><span class="btn btn-info btn-lg" id="registerPlace"> register </span><br>

                   

                            </form>
                </div>
            </div>
       
            </div>
       

<?php } else{?>
   <div class="alert alert-warning" >
      <p>you need to be authorized </p>
   </div>
<?php } ?>

<?php include('../include/footerui.php'); ?>