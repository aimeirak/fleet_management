<?php 
session_start();
ob_start();
include 'include/header.php' ; 

if(!isset($_SESSION["username"])){
    header("Location: uiupdate.php");
    exit(); }
?>

<?php include('connexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php $id_subcompany = $_SESSION['sub_company']; ?>

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

            <div class="col-md-12 m-2">
               


                <?php
                if (isset($_GET["success"])) {
                    echo "<div class=\"alert alert-success alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Success!</strong> Distance successfully added.
                        </div>";
                }
                ?>
               

                <h5><bold>Please select departure</bold></h5>


                <form id="myForm "  method="post" action="distance.php" class=" d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    
                    <label for="search" class="sr-only">Select depart</label>
                    <div class="input-group">
                        
                        <select class="myselect form-control bg-light border-0 small" name="place" class="col-lg-12 col-xs-12">
    
                        </select>
                        <div class="input-group-append">
                            
                         
                           <button type="submit" name="search" class="btn btn-primary btn-sm" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    
                
                </form>

                <hr>


                <div class="row  " >
                    <div class="col-12 col-md-8">
                    <div class="card m-3 shadow-lg">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3>Routes</h3> 
                                <button class="btn  btn-info btn-sm " data-toggle="modal" data-target="#kmaddform">
                                    <span    class="fas  fa-plus fa-sm text-white"></span>
                                     Add
                                </button>

                            </div>
                           
                        </div>
                      
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
            
                                        <th>From</th>
                                        <th>to</th>
                                        <th>Km</th>
                        <?php if($_SESSION['role']==20 ){?>  <th>Modify</th> <?php } ?> 
            
            
                                    </tr>
                                    </thead>
                                    <tbody>
            
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        //var_dump($_POST);
                                        $name = stripslashes($_POST['search']);
                                        //var_dump($name);
            
            
                                        $sql1 = "SELECT fluid_distance.id,place1.name AS a,place2.name AS b,kilometers 
                            FROM fluid_distance               
                            INNER JOIN fluid_place AS place1 on fluid_distance.id_sector0=place1.id
                            INNER JOIN fluid_place AS place2 on fluid_distance.id_sectorf=place2.id
                            

                            where a=" . $name . " ORDER BY fluid_distance.id ASC";
                                        $result1 = mysqli_query($connection, $sql1);
                                        //$row = mysqli_fetch_assoc($result1);
                                        //var_dump($row);
                                        if (mysqli_num_rows($result1) > 0) {
                                            // output data of each row
                                            while ($row = mysqli_fetch_assoc($result1)) {
            
            
                                                echo'                                     
            
                                                <tr>' .
            
                                                    '<td>' . $row["id"] . '</td>' .
                                                    '<td>' . $row["a"] . '</td>' .
                                                    '<td>' . $row["b"] . '</td>' .
                                                    '<td>' . $row["kilometers"] . '</td>';
                                                    if($_SESSION['role']==20 ){
                                                        echo   '<td>' . '<a class="btn btn-success" href="upkilometers.php?id=' . $row["id"] . '"; >update</a>' . '</td>';                                          
                                                    };
                                                    echo  '</tr>';
                                                
                                           
            
                                            }
            
            
                                        }
                    } else {
            
                        //$result1 = mysqli_query($connection, $sql1);
                        if (isset($_POST['place'])) {
                            $place = $_POST['place'];
                            $sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0 FROM fluid_place INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany . " and fluid_place.id=" . $place;
                            $res = mysqli_query($connection, $sql3);
                            $rows1 = [];
                            while ($row = mysqli_fetch_array($res)) {
                                $rows1[] = $row;
                            }
            
                        } else {
                            $sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0,fromsector.name as 'fromname'  FROM fluid_place inner join fluid_sector as fromsector on fromsector.id = fluid_place.id_sector0   INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany . " ORDER BY fluid_place.id LIMIT 1";
                            $res = mysqli_query($connection, $sql3);
                            $rows1 = [];
                            while ($row = mysqli_fetch_array($res)) {
                                $rows1[] = $row;
                            }
                        }
            
            
                        $sql3 = "SELECT fluid_user.id_subcompany,fluid_place.id,fluid_place.id_user,fluid_place.name,fluid_place.id_sector0 ,tosector.name as 'toname' FROM fluid_place 
                        inner join fluid_sector as tosector on tosector.id = fluid_place.id_sector0
                          INNER JOIN fluid_user on fluid_place.id_user=fluid_user.id where id_subcompany=" . $id_subcompany;
                        $res = mysqli_query($connection, $sql3);
                        $rows = [];
                        while ($row = mysqli_fetch_array($res)) {
                            $rows[] = $row;
                        }
            
                        $routes = [];
                        foreach ($rows1 as $from) {
                            foreach ($rows as $to) {
                                if ($from != $to) {
                                    $sql = "SELECT kilometers  FROM fluid_distance                                   
                                    
                                      WHERE id_sector0=" . $from['id_sector0'] . " AND id_sectorf=" . $to['id_sector0'];
                                    $res = mysqli_query($connection, $sql);
                                    $row = mysqli_fetch_array($res);
                                    $km = $row['kilometers'];
                                    $routes[] = [
                                        'from' => $from['name'],
                                        'from_id' => $from['id_sector0'],
                                        'to' => $to['name'],
                                        'to_id' => $to['id_sector0'],
                                        'km' => $km,
                                        'fromname' => $from['fromname'],
                                        'toname' => $to['toname'],

                                    ];
            
                                }
                            }
                        }
            
                        foreach ($routes as $row) {
            
            
                            echo
            
                                '
            
            
                 <tr>' .
                                '<td>' . $row["from"] . ' (' . $row["fromname"] . ')</td>' .
                                '<td>' . $row["to"] . ' (' . $row["toname"] . ')</td>' .
                                '<td>' . $row["km"] . '</td>';   
            
                                if($_SESSION['role'] == 20){
                                    echo '<td class="text-center">' . '<a href="upkilometers.php?from_id=' . $row["from_id"] . '&to_id=' . $row['to_id'] . '&from=' . $row['from'] . '&to=' . $row['to'] . '"; class="btn btn-info">update</a>' . '</td>';
                                                    
                                };
                              
                            echo   '</tr>';
                           
            
                        }
            
                    }
            
            
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
   

        <!-- /. ROW  -->


        <?php

        if (isset($_POST['submit'])) {

            $id_user = $_SESSION['id'];
            $id_sector0 = stripslashes($_POST['sector1']);
            $id_sectorf = stripslashes($_POST['sector2']);
            $kilometers = stripslashes($_POST['kilometers']);

            //$from = mysqli_real_escape_string($connection,$from);

            $sql = "INSERT into fluid_distance (id_user,id_sector0,id_sectorf,kilometers) values(" . $id_user . ",'" . $id_sector0 . "'," . $id_sectorf . ",'" . $kilometers . "')";

            $result = mysqli_query($connection, $sql);
            //var_dump($result);


            if ($result) {
                header("Location: distance.php?success");
            }
        } else {

        }


        ?>

       
<div class="modal fade" id="kmaddform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD KM</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

                        
                <form action="distance.php" method="post">

                    <label>sector1</label>
                        <?php

                        $sq = "SELECT id,name FROM fluid_sector";
                        $rslt = mysqli_query($connection, $sq); ?>

                        
                        <select name="sector1" class="form-control">
                            <?php
                            while ($row = mysqli_fetch_array($rslt)) {
                                echo '
                                         <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
                                        ';
                            }
                            ?>

                        </select>

                  
                  
                        <?php

                        $sq = "SELECT id,name FROM fluid_sector";
                        $rslt = mysqli_query($connection, $sq); ?>

                        <label>sector2</label>
                          <select name="sector2" class="form-control">
                            <?php
                            while ($row = mysqli_fetch_array($rslt)) {
                                echo '
                                 <option value=' . $row['id'] . ' >  ' . $row['name'] . '</option>
                                           ';
                            }
                            ?>

                        </select>


                    <label>kilometers</label>
                    <input type="text" name="kilometers" class="form-control" required><br>
                  
                    <div class="modal-footer">
                        <input type="submit" name="submit" class="btn btn-info " value="Add">
            </form>
        </div>
   
      </div>
    </div>
  </div>



                </div>


<?php


function dd()
{
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    die;
}

?>

<?php
 $sql = "SELECT fluid_place.id,name FROM fluid_place INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=".$_SESSION['sub_company'];
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
    $(".myselect").select2({
        data: data
    });

    $('.myselect').on('select2:select', function (e) {
        $("#myForm").submit();
    });
   
    
</script>
<script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
   

   


    <!-- Bootstrap core JavaScript -->
  
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>  
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>

    
    <script src="assets/DataTables/datatables.min.js"></script>
 
 
<script>
    window.addEventListener('load',()=>{
            const loader = document.querySelector('.loader');
            loader.classList.add('lodh'); 
        })
       
     var bur = document.getElementById('sidebarToggleTop'); 
      var sider =  document.getElementById('accordionSidebar');
      var clearb =  document.getElementById('returnB');
      var page =  document.getElementById('page-top');
      page.addEventListener('mouseover',()=>{
        if(window.outerWidth >= 768){
          sider.style.display = '';
        }
     });
     if(window.innerWidth >= 768){
          sider.style.display = '';
        }else{
            sider.style.display = 'none'
        }
       
      bur.addEventListener('click',()=>{
          if(sider.style.display == 'none'){
            sider.style.display = '';
            if(clearb){
                clearb.style.display = 'none';
            }
            
          }else{
            if(clearb){
                clearb.style.display = '';
            }            
            sider.style.display = 'none';
          }
       
      })

    $(document).ready(function() {
        $('#datatable1').DataTable( {
            
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
