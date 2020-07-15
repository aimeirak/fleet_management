<?php ob_start();include('authenticate.php');?>

<?php include('connexion.php');?>

  



<div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>please update car_location</h2>
                       
                    </div>
                </div>
                <!-- /. ROW  -->
               
                <?php


                      if(isset($_POST['destination'])){


                              // removes backslashes

                          $id= intval($_POST['id']);
                          //$username = mysqli_real_escape_string($connection, $username); 
                          $id_place = intval(stripslashes($_POST['destination']));
                          $comments = stripslashes($_POST['description']);
                          $status_id=intval(stripslashes($_POST['statusname']));

                         
                          //$from = mysqli_real_escape_string($connection,$from);
                         
                          $sql="UPDATE fluid_car_location SET id_place=".$id_place.", status_id=".$status_id.", comments='".$comments."' WHERE
                          `id`=". $id.""; 
                          $result=mysqli_query($connection,$sql);

                           //var_dump($result);
                      //die();
                        
                            if (($result)>0) {
                             header("location:carlocation.php");
                            } else {
                                echo "Error updating record: " . mysqli_error($connection);

                            }
                          }

              ?>



<?php
    
    $sql="SELECT id,name FROM fluid_place";
    $rs=mysqli_query($connection,$sql);

   //var_dump(mysqli_fetch_array($rs));
   //die();

?>
<form action="updatecarloc.php" method="post">
<br><input type="hidden" name="id"   value="<?php echo isset($_GET['id']) ?  $_GET['id'] : '' ?>"><br>

    <br><label>location</label><br>
    <select name="destination" class="form-control">
    <?php
          while($row = mysqli_fetch_array($rs))
          {
            echo '
             <option value='.$row['id'].' >  '.$row['name'].'</option>
                ';
          }
          echo  '</select>';
    ?>

    <div class="input-group">
        <div class="row">
              <br><label>description</label><br><input type="text" name="description"  required ><br>

              <?php  
                    $sq="SELECT id, statusname FROM fluid_status";
                    $result=mysqli_query($connection,$sq);
              ?>

              <br><label>status</label><br>
              <select name="statusname" class="form-control">
              
              <?php
                    while($row = mysqli_fetch_array($result))
                    {
                    echo '
                     <option value='.$row['id'].' >  '.$row['statusname'].'</option>
                        ';
                    }
                    echo  '</select>';
              ?>

              <br><a href="ui.php"><input type="submit" name="submit" value="update"></a><br>
        </div>
    </div>
</form>


</div>
</div>
</body>
</html>
<?php mysqli_close($connection);?>

<?php include('footer.php'); ?> 

