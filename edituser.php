<?php ob_start();
session_start();
include 'include/header.php' ; ?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php

$id_subcompany = $_SESSION['sub_company'];
$id_user = $_SESSION['username'];
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
           $password = stripslashes($_POST['password']);
            //$passwor =(mysqli_real_escape_string($password));
           $passwordh = md5($password);
            $email = stripslashes($_POST['email']);

            //var_dump($_POST);
            //die();
            


            echo $query = "UPDATE `fluid_user` SET id_subcompany=" . $id_subcompany . ",username='" . $username . "',full_name='" . $full_name . "',phone_number=" . $phone_number . ",  password='" . $passwordh . "' WHERE id_subcompany=" . $id_subcompany . " and id=" . $id . " ";
            //echo $query;

            $result = mysqli_query($connection, $query);
            var_dump($result);
            if ($result) {
                // Redirect user to ui.php
                header("Location: uiupdate.php");
            }
        } else {
        }

        ?>


        <div class="col-md-12 col-lg-offset-2">
            <form name="edituser" class="col-6 card shadow p-3" action="edituser.php" method="post" class="card shadow p-3">


               

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
                    <input readonly disabled type="text" name="email" value="<?=$row['email']?>"  class="form-control span3">
                    <br>
                    <br><a href="logout.php"><input type="submit" name='save' value="Save" class="btn btn-primary pull-right"><br>
                        <div class="clearfix"></div>
            </form>
        </div>
        </div>
    
    
    
</div>
<script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    
<script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/DataTables/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/buttons.print.min.js"></script>
    <script src="assets/DataTables/pdfmake.min.js"></script>
    <script src="assets/DataTables/vfs_fonts.js"></script>
    <script src="assets/DataTables/buttons.html5.min.js"></script>
   
<script>
    
    $(document).ready(function() {
        $('#datatable1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print',
            ],
            exclude:'ex',
            proccesing:true,
            responsive:true
              } );
    } )
    
  
  
  $(function () {
      "use strict";
      var mainApp = {
  
          main_fun: function () {
             
              /*====================================
                LOAD APPROPRIATE MENU BAR
             ======================================*/
              $(window).bind("load resize", function () {
                  if ($(this).width() < 768) {
                      $('div.sidebar-collapse').addClass('collapse')
                  } else {
                      $('div.sidebar-collapse').removeClass('collapse')
                  }
              });
          },
          initialization: function () {
              mainApp.main_fun();
  
          }
      }
      // Initializing ///
  
      $(document).ready(function () {
          var currentdate = new Date();
          var datetime = currentdate.getDate() + "/"
              + (currentdate.getMonth()+1)  + "/"
              + currentdate.getFullYear() + " @ "
              + currentdate.getHours() + ":"
              + currentdate.getMinutes() + ":"
              + currentdate.getSeconds();
          mainApp.main_fun();
          $('#datatable1').DataTable();        
          $('#printable').DataTable( {
              order: [[ 3, "desc" ]],
              dom: 'Bfrtip',
              buttons: [
                 
                  'print',
                  {   extend: 'pdfHtml5',
                      title: 'Booking report on '+ datetime,
                      exportOptions: {
                          columns: [ 0, 1, 2, 3,4,5,6,7 ],
                          stripNewlines: false
                      },
                      messageBottom: function () {
                          return $('#total').text();
                      },
  
  
                  }
  
      ]
          } );
  
          $('#printable_car').DataTable( {
              order: [[ 3, "desc" ]],
              dom: 'Bfrtip',
              buttons: [
                  'print',
                  {   extend: 'pdfHtml5',
                      title: 'Car report on '+datetime,
                      exportOptions: {
                          columns: [ 0, 1, 2, 3,4,5,6,7 ],
                          stripNewlines: true
                      },
                      messageBottom: function () {
                          return "\n"+$('#total').text();
                      },
                      messageTop: function () {
                          return "\n"+$('#top').text();
                      },
  
  
                  }
  
              ]
          } );
  
      });
  
  }(jQuery));
  
  
      </script>
</body>
</html>


