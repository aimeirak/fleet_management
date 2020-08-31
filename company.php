<?php //ob_start();
include('authenticate.php'); ?>

<?php include('connexion.php'); ?>
<?php include('include/header.php');?>

<?php //include('navSide.php');?>

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

        
      
        <div class="row" style="padding:10px;">
            <?php
            if (isset($_GET["success"])) {
                echo "<div class=\"alert alert-success alert-dismissable\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Success!</strong> successfully added.
                        </div>";
            }
            ?>
            <div class="card shadow-lg">
                <div class="card-header">
                  <h2>Companies</h2>
                </div>
                <div class="card-body">
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="datatable1">
                <thead>
                <tr>

                    <th>company</th>

                    <th>Tin_number</th>
                    <th>Email</th>
                    <th>Location</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $sql1 = "SELECT*from fluid_company";

                $result1 = mysqli_query($connection, $sql1);
                // var_dump($result);


                if (mysqli_num_rows($result1) > 0) {
                    // output data of each row

                    while ($row = mysqli_fetch_array($result1)) {
                        //var_dump($row);

                        echo(

                            '


                                    <tr>' .

                            //'<td>'.$row["id"].'</td>'.
                            '<td>' . $row["company_name"] . '</td>' .

                            '<td>' . $row["tin_number"] . '</td>' .
                            '<td>' . $row["email"] . '</td>' .

                            '<td>' . $row["location"] . '</td>' .


                            '</tr>'
                        );

                    }
                } else {
                    echo "0 results";
                }
                ?>

</tbody>
            </table>
            </div>                    
                </div>

            </div>
           
            <!-- /. ROW  -->

          

            
        </div>
    </div>
</div>


<?php include('include/footerui.php'); ?>

