<?php
session_start();
include '../connexion.php';
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
if(isset($_SESSION['sub_company'] ) && $_SESSION['role'] == 20 && ($_SESSION['userStatus'] == 'MASTER' || $_SESSION['userStatus'] == 'admin')){ ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.css">
 
<script  src="https://code.jquery.com/jquery-2.0.3.min.js" integrity="sha256-sTy1mJ4I/LAjFCCdEB4RAvPSmRCb3CU7YqodohyeOLo=" crossorigin="anonymous"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css">
<script src="../assets/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="../assets/DataTables/datatables.min.js"></script>
<style>
    
    body {
  padding-top: 50px;
}
.starter-template {
  padding: 40px 15px;
  text-align: center;
}
.navbar-toggle:hover{
    background-color: rgb(241, 236, 236);
}
.nav li a:hover{
   color: rgb(194, 171, 171);
}
.mt-5{
    margin-top:32px ;
}

  </style>
<title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>   



<body  >

    <div class="navbar navbar-fixed-top  " style="background-color: #fff; border:none; box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important; ">
      <div class="container ">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" style="border:none; background-color: #fff;" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar" style="background-color: black" ></span>
            <span class="icon-bar" style="background-color: black"></span>
            <span class="icon-bar" style="background-color: black"></span>
          </button>
          <img src="../assets/img/logo.png" style="width:160px; border-radius: 3px;"/>
         
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Adminbook</a></li>
            <li><a href="../uiupdate.php">Home</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
 <div class="container">
     <div class="col-xs-12 col-sm-12">
        <div class="panel-group mt-5 ">
            <div class="panel panel-primary">
              <div class="panel-heading">User authorization </div>
              <div class="panel-body table-responsive">
                <table class="table table-bordered  table-hover table-striped table-responsive table-condensed" id="datab" >
                    <thead>
                        <tr>
                            <th >ID</th>
                            <th>username</th>
                            <th>Role</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody id="employ">
         
                    </tbody>
                </table>
              </div>
            </div>
     </div>
 </div>
  
 <script>
    $(document).ready(function(){
       
       var datafield = document.getElementById("employ");
        function fetchEmploDate(){
            $.ajax({
                url:'include/fetchUser.php',
                method:'POST',
                dataType:'json',
                success:function(data){
                    for(var i = 0 ;i < data.length ; i++){
                        var tmldata = '<tr><td>'+ data[i].id+'</td>';
                        tmldata += '<td data-name="username" class="username" data-type="text" data-pk="'+data[i].id+'"> '+ data[i].username +'</td>';
                        tmldata += '<td data-name="role" class="role" data-type="select" data-pk="'+data[i].id+'"> '+ data[i].role +'</td>';
                        tmldata += '<td data-name="live" class="live" data-type="select" data-pk="'+data[i].id+'"> '+ data[i].live +'</td></tr>';
                       $('#employ').append(tmldata);
                    }
                    $('#datab').dataTable();
                }
            })
        }

        fetchEmploDate();
       
        $('#employ').editable({
            container:'body',
            selector:'td.username',
            url:'include/update.php',
            title:'Employee username',
            type:'POST',
            validate:function(value){
                if($.trim(value) == ''){
                    return 'This field is required';
                }
            }
        });
        $('#employ').editable({
            container:'body',
            selector:'td.role',
            url:'include/update.php',
            title:'Role',
            type:'POST',
            source:[{value:"20",text:"ADMIN"},{value:"30",text:"Driver"},{value:"10",text:"Lebour"}],
            validate:function(value){
                if($.trim(value) == ''){
                    return 'This field is required';
                }

            }
        });
        $('#employ').editable({
            container:'body',
            selector:'td.live',
            url:'include/update.php',
            title:'Status',
            type:'POST',
            source:[{value:"1",text:"Entertained"},{value:"0",text:"Dismissed"}],
            validate:function(value){
                if($.trim(value) == ''){
                    return 'This field is required';
                }

            }
        });
    })
</script>
</body>
</html>
<?php }
else{
header('location:../uiupdate.php');
}
?>