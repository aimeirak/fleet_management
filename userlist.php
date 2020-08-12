<?php include('authenticate.php'); ?>
<?php include('connexion.php');?>
<?php  include('header.php'); ?>
        <!-- /. NAV TOP  -->
<?php include('navSide.php'); ?>






<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-6">
                <h2>users</h2>
            </div> 
            
        </div>
        
        <div class="row" style="padding:10px;">
        
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>phone_number</th>
                        <th>email</th>
                         <th></th>
                        

                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT full_name,phone_number,email from fluid_user";
                    $result = mysqli_query($connection, $sql);
                   

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row

                        while($row = mysqli_fetch_array( $result)) {
                            //var_dump($row);

                            echo (

                                '


                                    <tr>'.

                                       
                                        '<td>'.$row["full_name"].'</td>'.
                                        '<td>'.$row["phone_number"].'</td>'.
                                        '<td>'.$row["email"].'</td>'. 

                                
                                        
                                        
                                    '</tr>
                                '
                            );

                        }
                    } else {
                        echo "0 results";
                    }
                ?>
                </tbody>
            </table> 




<?php include('footer.php'); ?>