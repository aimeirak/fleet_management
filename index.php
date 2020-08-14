<?php ob_start();
include('connexion.php');
header("Location: login.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'
          rel='stylesheet' type='text/css'/>


    <link rel="stylesheet" type="text/css"
          href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <script src="assets/js/jquery-1.10.2.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
</head>

<body>

<?php
//error_reporting(0);
include('connexion.php');
?>


<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">

                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo.png" style="width:160px;"/>
                </a>


            </div>
            <button class="btn btn-default btn-lg pull-right" style="margin:10px" data-target="#loginModal"
                    data-toggle="modal"><STRONG>LOGIN</STRONG>
            </button>
        </div>

    </div>
</div>


<div class="container">

    <div class="" style="margin-top:50px; ">
        <div class="alert alert-info">
            <a href="login.php"><strong>Most welcome !</a></strong> get today's bookings.
        </div>
        <div class="row">

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="assets/img/ishyiga.jpg" style="width: 99%;" alt="">
                        <div class="carousel-caption">
                            <h3>ishyiga software</h3>
                            <p>work hard,much fun!</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="assets/img/fun.jpg" style="width: 99%;" alt="">
                        <div class="carousel-caption">
                            <h3>fluid management</h3>
                            <p>if you wake up without goal,go back to sleep!</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="assets/img/staff.jpg" style="width: 99%;" alt="">
                        <div class="carousel-caption">
                            <h3>software management</h3>
                            <p>We love what we do!</p>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="modal" id="loginModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                        class="fa fa-times"></i></button>
                            <h4 class="modal-title">Please Login</h4>
                        </div>
                        <div class="modal-body">

                            <form action="index.php" method="post" class="form-signin">

                                <h2 class="form-signin-heading">Please Login</h2>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">@</span>
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                           required>
                                </div>
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" name="password" id="inputPassword" class="form-control"
                                       placeholder="Password" required>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                                <a class="btn btn-lg btn-primary btn-block" href="registrationform.php">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php //Start the Session
    session_start();
    require('connexion.php');
    //3. If the form is submitted or not.
    //3.1 If the form is submitted
    if (isset($_POST['username']) and isset($_POST['password'])) {
        //3.1.1 Assigning posted values to variables.

        $username = $_POST['username'];
        $password = $_POST['password'];
        //3.1.2 Checking the values are existing in the database or not
        $query = "SELECT * FROM `fluid_user` WHERE username='$username' and password='$password'";
        //echo $query;

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        $count = mysqli_num_rows($result);
        //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
        if ($count == 1) {
            $row = mysqli_fetch_array($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['sub_company'] = $row['id_subcompany'];
            $sql = "UPDATE fluid_user SET last_login=NOW() WHERE id=" . $row['id'];
            if (mysqli_query($connection, $sql)) {
                //echo "Record updated successfully";
                header("Location: ui.php");
            } else {
                echo "Error updating record: " . mysqli_error($connection);

            }


        } else {
            $msg = "Wrong Username or Password. Please retry";
            header("location:login.php?msg=Wrong Username or Password. Please retry");
        }
    }
    ?>

    <script>
        $(document).ready(function () {

            $(#'login-button'
        ).
            click(function () {
                var username = $(#'username'
            ).
                val()
                var password = $(#'password'
            ).
                val()
                if (username != '' && password != '') {
                    $.ajax({
                        url: "action.php"
                        method: "post"
                        data: {username: username, password: password},
                        success: function (data) {
                            if (data == 'no') {
                                alert("wrong data");
                            }
                            else {
                                $('#loginModal').hide();
                                location.reload()
                            }

                        }

                    });

                }
                else {
                    alert("both fields are required");
                }

            });

        });
    </script>


</div>
</div>
</body>

