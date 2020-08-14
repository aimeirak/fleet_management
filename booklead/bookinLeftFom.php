<?php 
session_start();
$id_subcompany = $_SESSION['sub_company'];
include '../connexion.php';
if(isset($_POST['s']) &&  isset($_POST['st'])){
    $fullStartdate = $_POST['s'];
    $fullEnddate = $_POST['e'];
    $confirmed ='confirmed';
    $msg='';
?>
<div class="card shadow mt-2">

    <div class="card-header">
        booking is scheduled on <span class="text-info"><?php echo $_POST['s'] ?></span> and end at <span class='text-success'><?php echo $_POST['et'] ?> </span>
    </div>
    <div class="card-body">
        <form id="new-booking" spellcheck="false" class="col-12"  method="post">
        
        
        
            <div class="row">
                <div class="col-12">
                    <div id="msg" >

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                           
                           
        
                         
        
                              
        
                               
                                        <?php
                                        $sql = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
                                            inner join fluid_user on fluid_place.id_user=fluid_user.id
                                            inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                                            where id_subcompany='" . $id_subcompany . "'
                                            order by name asc";
                                        $rs = mysqli_query($connection, $sql); ?>
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <?php
                                            $sq = "SELECT*FROM fluid_status ";
                                            $rslt = mysqli_query($connection, $sq); ?>
                        
                                            <?php
                                            while ($row = mysqli_fetch_array($rslt)) {
                                                echo '<option value="' . $row['id'] .'"'.((isset($status) and ($status==$row['id']))?'selected':' '). '> ' . $row['statusname'] . ' </option>';
                    
                                            }
                                            echo '</select>';
                                            ?>
                                      
                                        <div class="select-container">
                                            <label>Departure</label>
                                         <span class="input-group-btn">
                                            <button type="button" class="btn btn-outline-default btn-number" data-type="plus" data-toggle="modal" id="adddep">
                                             <span class="fa fa-plus"></span>
                                                </button> 
                                        </span>
                                            <?php if(isset($_POST['save'])) {
                                                
                                                // removes backslashes 
                                               
        
                                                $id_user = intval($_SESSION['id']);
                                                $name = stripslashes($_POST['departure']);
                                                $id_sector0 = stripslashes($_POST['name']);
                                                $aboutcontract = stripslashes($_POST['aboutcontract']);
                                                if(empty($name)||empty($id_sector0)||empty($aboutcontract)){
                                                    $msg = 'you submitted with empty field';                                            
                                                    header("Location:booking.php?msg=$msg");
                                                } else{
                                                    $sqlqury  = 'SELECT id_sector0,name from fluid_place WHERE name = ? and id_sector0 = ? ';
                                                    $stmt = $connection->prepare($sqlqury);
                                                    $stmt->bind_param('si',$_POST['departure'],$_POST['name']);
                                                    $result = $stmt->get_result();
                                                    $placeExist = $result->num_rows;
                                                    if($placeExist){
                                                          $msg = 'place exist';
                                                        
                                                        header("Location:booking.php?msg=$msg");
                                                    }else{
                                                        //$from = mysqli_real_escape_string($connection,$from);
        
                                                        echo $sql = "INSERT into `fluid_place` (id_user,name,id_sector0,aboutcontract) values (" . $id_user . ",'" . $name . "'," . $id_sector0 . ",'" . $aboutcontract . "')";
                
                                                        $result = mysqli_query($connection, $sql);
                                                        //var_dump($result);
                
                
                                                        if ($result) {
                                                            $success = 'place created. Now you can browse it! ';
                                                            header("Location:booking.php?success=$success");
                                                        }
                                                    }
        
        
                                                    
                                     
        
                                                }
        
                                            } 
                                            ?>
        
                                            <select id="departure" class="myselect form-control" name="departure" style="width: 100%"></select>
                                        </div>
                                        
                                        
                                     
                </div>
        
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                           
                                <?php
                                $sqlu = "SELECT * from fluid_departments where id_subcompany='" . $id_subcompany . "'";
                                $rst = mysqli_query($connection, $sqlu);
                                ?>
        
                                <label>department</label>
                                <select name="name_dep" id="name_dep" class="form-control">
                                    <?php
                                    while ($row = mysqli_fetch_array($rst)) {
                                        echo '<option value="' . $row['id'].'"'.((isset($departments_id) and ($departments_id==$row['id']))?'selected':' ') . ' > ' . $row['name_dep'] . '</option>';
        
                                    }
                                    echo '</select>';
                                    ?>
                                    <input  type="hidden" id="start" value="<?=isset($fullStartdate)?$fullStartdate:''?>" >
                                    <input  type="hidden" id="end" value="<?=isset($fullEnddate)?$fullEnddate:''?>" >
                                   
                                    
        
                                    <?php
        
                                    $strSQL = "SELECT fluid_place.id,fluid_place.id_user,fluid_place.name FROM fluid_place 
                                        inner join fluid_user on fluid_place.id_user=fluid_user.id
                                        inner join fluid_sub_company on fluid_user.id_subcompany=fluid_sub_company.id
                                        where id_subcompany='" . $id_subcompany . "'
                                        order by name asc";
                                    $result2 = mysqli_query($connection, $strSQL);
        
                                    ?>
                                    <div class="select-container">
                                <label>Destination</label>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-outline-default btn-number" id='addDestin' ><span class="fa fa-plus"></span>
                                    </button>
                                    </span>
        
        
                                                <select id="destination" class="myselect form-control" name="destination" style="width: 100%"></select>
        
                                            </div>
                                            <?php
        
        
                                            ?>
                                </div>
        
                            </div>
                 
                <div class="row pad-top">        
                   
                            <input class="form-control btn-sm btn btn-info mt-3" type="button" name="submit" id="sub" value="Submit">
                        
                </div>
            </form>
    </div>

    
</div>


<?php } ?>
