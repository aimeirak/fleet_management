<?php ob_start();
include('authenticate.php'); ?>
<?php
$id_subcompany = $_SESSION['sub_company'];
$id_user = $_SESSION['username'];

include('connexion.php'); ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-7 text-center">
                <h5>You can Edit your account <?php echo $_SESSION['username']; ?></h5>
            </div>
        </div>


        <?php
        // If form submitted, insert values into the database.
        if (isset($_POST['save'])) {

            //echo 'good';
            // removes backslashes
            //escapes special characters in a strin
            $id = $_SESSION['id'];

            $username = stripslashes($_POST['username']);
            //$username = mysqli_real_escape_string($username);
            $full_name = stripslashes($_POST['full_name']);
            //$full_name = mysqli_real_escape_string($full_name);
            $phone_number = stripslashes($_POST['phone_number']);
            //$phone_number = mysql_real_escape_string($phone_number);
            //$password = stripslashes($_POST['password']);
            //$password =(mysqli_real_escape_string($password));
            $email = stripslashes($_POST['email']);

            //var_dump($_POST);
            //die();


            echo $query = "UPDATE `fluid_user` SET id_subcompany=" . $id_subcompany . ",username='" . $username . "',full_name='" . $full_name . "',phone_number=" . $phone_number . ",  email='" . $email . "' WHERE id_subcompany=" . $id_subcompany . " and id=" . $id . " ";
            //echo $query;

            $result = mysqli_query($connection, $query);
            var_dump($result);
            if ($result) {
                // Redirect user to ui.php
                header("Location: ui.php");
            }
        } else {
        }

        ?>


        <div class="col-md-12 col-lg-offset-2">
            <form name="edituser" action="edituser.php" method="post" class="form-horizontal">


                <div class="input-group">

                    <?php
                    $sql1 = 'SELECT subcompany_name from fluid_sub_company where id=' . $_SESSION['sub_company'];
                    $res = mysqli_query($connection, $sql1);
                    $row = mysqli_fetch_array($res);
                    $sub_company = $row['subcompany_name'];

                    $sql3='SELECT * from fluid_user where id='.$_SESSION['id'];
                    $res = mysqli_query($connection, $sql3);
                    $row = mysqli_fetch_array($res);


                    ?>

                    <label>company</label>
                    <input type="text" name="sub_company" class="form-control span5" disabled
                           placeholder="<?php echo $sub_company; ?>">

                    <br><label>Username</label><br>
                    <input type="text" name="username" value="<?=$row['username']?>" readonly class="form-control span5">
                    <br><label>Full name</label><br>
                    <input type="text" name="full_name" value="<?=$row['full_name']?>" class="form-control span5">
                    <br><label>Phone number</label><br>
                    <input type="text" name="phone_number" value="<?=$row['phone_number']?>" class="form-control span3">
                    <br><label>Password</label><br>
                    <input type="password" name="password" class="form-control span3">
                    <br><label>e-mail</label><br>
                    <input type="text" name="email" value="<?=$row['email']?>"  class="form-control span3">
                    <br>
                    <br><a href="login.php"><input type="submit" name='save' value="Save" class="btn btn-primary pull-right"><br>
                        <div class="clearfix"></div></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>


<?php include('footer.php'); ?> 