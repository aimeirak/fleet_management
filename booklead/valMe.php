<?php
include '../connexion.php';
session_start();
if(isset($_SESSION['role'])){ 
    $now = new DateTime();
    $id = $_SESSION['id'];
  $stmt = $connection->prepare('SELECT last_login from fluid_user where id = ?');
  $stmt->bind_param('i',$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $lastLogin = new DateTime($row['last_login']);
  // echo ;
  // echo '<br>';
  // echo ;
  if($lastLogin->format('Y m d') < $now->format('Y m d')){
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
    session_destroy();
    exit($msg);
   
  }
  
  }else{
    $msg = '
    <div class="container">
    <div class="card shadow mt-5">
    <div class=" alert alert-warning text-center m-5"><div class" p-5">Please login again </div> </div>
    </div>
    </div>
   ';
   
   exit($msg);
  
   
  }
$idcomp = $_SESSION['sub_company'];;

function firstStep(){
    $dt = new DateTime;
    if (isset($_GET['year']) && isset($_GET['week'])) {
        $dt->setISODate($_GET['year'], $_GET['week']);
    } else {
        $dt->setISODate($dt->format('o'), $dt->format('W'));
    }
    $year = $dt->format('o');
    $week = $dt->format('W');
    $mo = $dt->format('F');
    $Year = $dt->format('Y');

    echo '
    <div class="card mt-4 shadow">
    <div class="card-header">
    <h4> Weekly dates </h4>
    </div>

    <table class="table table-responsive" >
    <theader>
    <tr>
    ';
     $i = 0;
    do {
        $i++;
        $dt->format('N') == 7 ? $color = 'danger': $color ='secondary';
        $dt->format('N') == 7 ? $A = 'primary': $A ='info';
        $cloned = clone $dt;
        $cloned->modify('+1day');

        if($dt->format('d M Y') == date('d M Y') || $dt->format('d M Y')  == date('d M Y', strtotime('tomorrow') )  ){
            echo "<td class='btn btn-".$A." btn-sm  m-1' id ='".$i."' data-toggle='modal' data-target='#dailTime' onClick='getWeek(this.id)' data-week='".$dt->format('Y-m-d')."'  >" . $dt->format('l') . "(A)<br>" . $dt->format('Y-m-d') . "</td>\n";
        
        }else{
            echo "<td class='btn btn-".$color."  m-1 btn-sm' data-toggle='modal' data-target='#dailTime' onClick='getWeek(this.id)' data-week='".$dt->format('Y-m-d')."'  id ='".$i."'  >" . $dt->format('l') . "<br>" . $dt->format('Y-m-d') . "</td>\n";
            }
    
       $dt->modify('+1 day');
    } while ($week == $dt->format('W') );
   
    echo'</tr> </theader></table>
    </div>
    
    ';
    
}

function secondstep($dure,$cleanUp,$start,$end,$picked){
    $tfrom = $start;
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval('PT'.$dure.'M');
    $cleanupinterval = new DateInterval('PT'.$cleanUp.'M');
    $slots  = array();
    
   //now time for picked date
    $pickedDt = new DateTime($picked);  
    $toNow = new DateTime();
    //  $pickedDt->modify('+8hours +30m');  
    //  $toNow->modify('+20m');  

    $ti = $toNow->format('H');
    $mi = $toNow->format('m');
    $pickedDt->setTime($ti,$mi);
    $ourTime = $toNow->format('H:iA');
    $rand = rand(12,500);

    $i='time12'.$rand.'2';
    $it=1;
    for($intStart = $start;$intStart<=$end;$intStart->add($interval)->add($cleanupinterval)){
       $it++;
        $endP = clone $intStart;
         $endP->add($interval);
         $twodaysNow = clone $toNow;
         $twodaysNow->modify('+2days');

         if($endP>$end){
         break;
         } 
         if($toNow->format('Y m d') > $pickedDt->format('Y m d') ){
            $slots[] = ' <td><span class="btn btn-sm btn-danger">'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). '</span> </td>';

         }else{
             if($ourTime >= $intStart->format('H:iA') && $toNow->format('Y m d') >= $pickedDt->format('Y m d') ){
                $slots[] = ' <td><span class="btn btn-sm btn-danger">'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). '</span> </td>';

             }else{
                 if($toNow->format('N') == 7 || $pickedDt->format('N') == 7  ){
                    $slots[] = ' <td><span class="btn btn-sm btn-danger">'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). ' </span> </td>';

                 }else{
                     if($pickedDt->format('N') >= $twodaysNow->format('N') ){
                        $slots[] = ' <td><span class="btn btn-sm btn-secondary">'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). ' </span> </td>';

                     }else{
                         $time = strval($intStart->format('H:i'));
                         $referedTime = new DateTime;
                         $refCloned  =  new DateTime($time);
                        //  $referedTime->add(new DateInterval('PT9H'));
                        //  $referedTime->add(new DateInterval('PT40M'));
                        //  var_dump($referedTime ); 
                        //  echo '<br>';  
                        $deference = $refCloned->diff($referedTime); 
                        $rank = 'canceled';
                        $stmt = $GLOBALS['conn']->prepare('SELECT id FROM fluid_booking where date(start_time) = ? and time(start_time) = ? and rank != ?');
                        $stmt->bind_param('sss',$picked,$time,$rank);
                        $stmt->execute();
                        $stmt->store_result();

                        //if booked time is greater than driver we got to day
                        if($stmt->num_rows >= 2 ){
                            $slots[] = ' <td><span class="btn btn-sm btn-danger">'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). '(booked) </span> </td>';

                        }else{
                            // if picked date is tomorrow 
                            if($pickedDt->format('Y-m-d') > $referedTime->format('Y-m-d') ){
                                                        
                                $slots[] = ' <td><span class="btn btn-sm btn-info" onClick="getTime(this.id)" daily-time="'. $intStart->format('H:iA').'-'.$endP->format('H:iA').'"  id="'.$i.$it.'" actual="'.$picked.'" >'. $intStart->format('H:iA').'-'.$endP->format('H:iA'). ' </span> </td>';

                            }
                            else{
                                // if no hour in defference
                                if($deference->h <= 1 ){
                                    // if defference min is more dan 20 min
                                    if($deference->i >= 20 || $deference->h >= 1 ){                                   
                                        $slots[] = ' <td><span class="btn btn-sm btn-info" onClick="getTime(this.id)" daily-time="'. $intStart->format('H:iA').'-'.$endP->format('H:iA').'"  id="'.$i.$it.'" actual="'.$picked.'" >'. $intStart->format('H:iA').'-'.$endP->format('H:iA').' </span> </td>';

                                    }else{
                                        $slots[] = ' <td><span class="btn btn-sm btn-danger">'. $intStart->format('H:iA').'-'.$endP->format('H:iA').' ( to be start in '. $deference->i .' minutes )  </span> </td>';
                                    }
                                }
                                else{                               
                                    $slots[] = ' <td><span class="btn btn-sm btn-info" onClick="getTime(this.id)" daily-time="'. $intStart->format('H:iA').'-'.$endP->format('H:iA').'"  id="'.$i.$it.'" actual="'.$picked.'" >'. $intStart->format('H:iA').'-'.$endP->format('H:iA').' </span> </td>';
                                }
                            }
                        }                        
                        
                        
                      
                     }
                  
                 }
              
             }
          }
                          
        
       
    }
    return $slots;
}

if(isset($_POST['b']) && $_POST['b'] == 2 && isset($_POST['d']) ){
   
  
   //getting campany start time end time
    $sql  = "SELECT * FROM fluid_book_date_lead where id_subcamp = ? ";
    $stmt =  $connection->prepare($sql);
    $stmt->bind_param('i',$idcomp);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $fetchTimeLead = $result->fetch_assoc();

        $dure = $fetchTimeLead['duretion'];
        $cleanUp = 0;
        $start = $fetchTimeLead['start'];
        $end = $fetchTimeLead['end']; 

    }else{

        $dure = 120;
        $cleanUp = 0;
        $start = '08:00';
        $end ='18:00'; 
    }
    //=================================================
   
    //times =========================
    $pickedDate = $_POST['d'];    
    $i='time122';
    $it=1;    
    $daily = secondstep($dure,$cleanUp,$start,$end,$pickedDate);
 
    //date manupulation
   

    //end of date manupulation

    echo'<table>';
    foreach($daily as $fetchTime){
        $it++;
       

    echo'<tr>
          
            
        ';
     echo $fetchTime;
     echo'
  
      </tr>';
     }
     echo'</table>';
      //==== times 

}




if(isset($_POST['b']) && $_POST['b'] == 1 ){
    firstStep();
}

?>