<?php 
include('../connexion.php');
session_start();
if(isset($_POST['view'])){
    if($_POST['data'] != '' and !empty(trim($_POST['data'])) ){
        $seen = 0;
        $id = $_POST['data'];
        $stmt = $connection->prepare('UPDATE  fluid_notification_lead SET live = ? where id = ?');
        $stmt->bind_param('ii',$seen,$id);
        $stmt->execute();
        $stmt->close();
    }
    $userid = $_SESSION['id'];
    $live = 1;
    $stmt = $connection->prepare('SELECT * from fluid_notification_lead where live = ? and userId = ? order by id desc limit 5');
    $stmt->bind_param('ii',$live,$userid);
    $stmt->execute(); 
    $result = $stmt->get_result();
    $count = $result->num_rows;
    $i = 12;
    $output = '';
    if($count > 0){
        while($row = $result->fetch_assoc()){
           $i++;
           $rand  = rand($i,500);

            $output .=' 
            <span class="dropdown-item d-flex align-items-center"  id="ty'.$rand.'bx" onClick="loadNote('.$row['id'].',1)" >
                <div class="mr-3">
                <div class="icon-circle bg-info">
                    <i class="fas fa-table text-white"></i>
                </div>
                </div>
                <div>
                <div class="small text-gray-500">'. date('F j, Y g:i a',strtotime($row['created_at'])) .'</div>
                <span class="font-weight-bold">'.$row['note'].'</span>
                </div>
             </span>
      '; 
        }
        $output .=' 
        <span class="dropdown-item text-center small text-gray-500"> Notification for you(click to mark as readed)</span>
  ';
        
    }else{
        $output = '<span class="dropdown-item text-center small text-gray-500">No notification is remaining</span>';
    }
    $data = array(
        'note'=>$output,
        'count'=>$count
    );
    echo json_encode($data);
}
else{
 
    $data = array(
        'note'=>$output,
        'count'=>$count
    );
    echo json_encode($data);
}


?>