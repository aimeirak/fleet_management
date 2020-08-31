<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title></title>
    <link rel="shortcut icon" href="assets/img/icon.png" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/jquery-ui.min.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <!-- <link href="assets/css/custom.css" rel="stylesheet"/> -->
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'
          rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css">      


    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.css" rel="stylesheet"/>-->
    <link href="assets/DataTables/datatables.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="assets/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- CUSTOM SCRIPTS -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/DataTables/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/buttons.print.min.js"></script>
    <script src="assets/DataTables/pdfmake.min.js"></script>
    <script src="assets/DataTables/vfs_fonts.js"></script>
    <script src="assets/DataTables/buttons.html5.min.js"></script>
 
    <script src="assets/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<style>
 .loader{
  position: fixed;
  z-index:99;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: white;
  display: flex;
  justify-content: center;
  align-items: center;
}

.loader > img {
  width: 60%;
  height: 60%;
} 
.loader.lodh{
  animation: loadmeout 1s;
  animation-fill-mode: forwards;
}
@keyframes loadmeout {
  100% {
    opacity: 0;
    visibility: hidden;
      }
}


@media screen and (max-width:760px){
  .loader > img {
    width: 100%;
    height: 50%;
  }
   }

    </style>


<!-- 
<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if($_SESSION['role']==30):?>
                    <a class="navbar-brand" href="driver_index.php">
                        <!--<img src="assets/img/logo.png" style="width:160px; border-radius: 3px;"/>-->
                    </a>
                <?php else:?>
                    <a class="navbar-brand" href="ui.php">
                        <img src="assets/img/logo.png" style="width:160px; border-radius: 3px;"/>
                    </a>
                <?php endif;?>
            </div>

            <span class="logout-spn">
                <a href="logout.php" style="font-size:0.6em;color:#fff;">Logout( <?= $_SESSION['username'] ?> )</a>
                </span>
        </div>
    </div> -->
