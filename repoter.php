<?php 
session_start();
include 'include/header.php' ;
include 'connexion.php';
if( isset($_SESSION['sub_company'] ) && $_SESSION['userStatus'] == 'MASTER' ){ ?>


<style>
    #returnB{
    cursor: pointer;
    border-color: skyblue;
    }
    #task div{
    cursor: pointer;
    border: skyblue;
    }

  </style>
  <title><?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</title>
</head>   
<body id="page-top" >
<!-- navigation  -->

 <div id="wrapper">
   
   <!--sidbar start -->
  <?php include 'include/navbar.php' ?>
  <!--sidbar end-->

  <!--content-->
  <div id='content-wrapper' class="d-flex flex-column">
  <?php include 'include/topbon.php' ?>    
  
            
            <div id="content" >
            <div class="row m-2 mb-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="card p-3 ">
                      <div class="p-2 align-items-center d-block d-md-flex justify-content-between">
                          <div class='text-gray-700 ' >Reports </div>
                       
                          <div class="reporter">                            
                              <span  class=" btn btn-primary btn-icon-split m-1 btn-sm  " id="_ng1p453p_l" task="ng4" >
                                  <span class="icon text-white-70 d-none d-md-inline">
                                      <i class="fas fa-list "></i>
                                    </span>
                                    <span  class="text"  style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap" >last month</span>
                                  </span> 
                                  <span  class=" btn btn-primary btn-icon-split m-1 btn-sm  " id="_ng1plka53p_l" task="ng4" >
                                      <span class="icon text-white-70 d-none d-md-inline">
                                          <i class="fas fa-list "></i>
                                        </span>
                                        <span  class="text"  style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap" >daily</span>
                                    </span> 
                                    <span  class=" btn btn-primary btn-icon-split m-1 btn-sm  "  id="_ng1pmn53p_l" task="ng4" >
                                        <span class="icon text-white-70 d-none d-md-inline">
                                            <i class="fas fa-list "></i>
                                          </span>
                                          <span  class="text"  style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap" >daily&coming  </span>
                                     </span> 
                                     <span  class=" btn btn-success btn-icon-split m-1 btn-sm  "  data-toggle="modal" data-target="#modifier" >
                                        <span class="icon text-white-70 d-none d-md-inline">
                                            <i class="fas fa-edit "></i>
                                          </span>
                                          <span  class="text"  style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap" >Modify</span>
                                     </span>
                            </div>
                          <div id="returnB" class="btn btn-secondary d-none" >CLEAR</div>
                      </div>

                    <div id="page-ground">
           
            <?php   // <!--  task --> ?> 
                <div class="row " id="task">
         
                        <?php   if($_SESSION['userStatus'] =='MASTER' || $_SESSION['userStatus'] =='admin'){ ?> 
                          
                            
                        <div class="col-3 mt-3  col-sm-6 col-md-3 " id='RepCars'>
                          <div class="card border-left-info shadow h-100 py-2">
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1 d-none d-sm-flex">Cars</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fas fa-fw fa-car text-info"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                           <div class="col-3 mt-3  col-sm-6 col-md-3" id='repLabour'>
                          <div class="card border-left-success shadow h-100 py-2">
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1 d-none d-sm-flex">Labour</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fas fa-fw fa-users text-success"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div> 
                       <div class="col-3 mt-3  col-sm-6 col-md-3" id='repDriver'>
                          <div class="card border-left-warning shadow h-100 py-2">
                              <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 d-none d-sm-flex">Driver</div>
                                  <div class="row no-gutters align-items-center">
                                                  
                                  </div>
                                  </div>
                                  <div class="col-auto">
                                  <span class="fa fa-drivers-license text-warning" ></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-3 mt-3  col-sm-6 col-md-3 " >
                            <a href="adminstrationBook/adminBook.php" class="card ">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1 d-none d-sm-flex">Organization </div>
                                    <div class="row no-gutters align-items-center">
                                                    
                                    </div>
                                    </div>
                                    <div class="col-auto">
                                    <span class="fas fa-fw fa-user text-danger"></span>
                                    </div>
                                  </div>
                                </div>
                              </a>
                            </div>
                          <?php  }?>   
                </div>
                <?php   //  end  task ?> 

                <div class="row mt-3">
                  <div class="col-12 col-lg-3">
                    <div class="card shadow-lg " style="overflow: auto;max-height: 300px;">
                      <div class="card-header">
                        <div id="taskinfo">
                          <h6></h6>
                        </div>
                       
                      </div>
                      <div class="card-body "  id="taskResponseField">
                        
                      </div>
                      
                    </div>
                  </div>

                  <div class="col-12 col-lg-9">
                    <div class="card shadow-lg ">
                       <div class="card-header">
                          <div id="filedtaskReport">
                              <h6>Cars report</h6>
                            </div>
                       </div>
                       <style>
                          .title-card{
                            position: relative;
                            padding: 10px 10px ;
                          }
                          /* .title-card::before{
                            content: "";
                            position:absolute;
                            bottom: 0px;
                            right: 0;
                            left: 0px;
                            width: 200px;
                            height: 2px;
                            background: coral;
                            align-content: center
                          } */
                          .user-name,.user-email{
                            font-size: 15px;
                            letter-spacing: 0.6px;
                            line-height: 20px;
                            color:coral;
                            font-weight: 600;
                          } 
                          .segment-lines{
                            border-top: 1px solid #d3d3d3;
                            padding: 5px 0px;
                            width: 100%;
                          }
                          .segment-title{
                            font-size: 16px;
                            font-weight: bold;
                            text-transform: capitalize;
                          }
                          .seg-list{
                            margin-top: 5px;
                            padding: 5px 0px 0px 15px;
                          }
                          .each-record{
                            display:flex;
                            justify-content: space-between;
                            width: 100%;
                            padding: 1px 0px;
                          }
                          .record-list{
                            padding: 5px 15px;
                          }
                          .desc{
                            text-transform: capitalize;
                            letter-spacing: 0.6px;
                            line-height: 20px;
                            font-size: 15px;
                          }
                          .content{
                            text-align: right;
                            letter-spacing: 0.6px;
                            text-transform: capitalize;
                          }

                       </style>
                       <div class="card-body "  id="filedtaskReportResponse">
                          <div class="text-center title-card">
                              <div class="user-name">..</div>
                              <div class="user-email ">..</div>
                          </div>

                          <div class="row record-list mt-3">

                          </div>
                        </div>

                    </div>
                  </div>
                </div>

          
                  <div class="row p-3 " >
                      <img src="http://preloaders.net/preloaders/290/preview.gif"  id="ajax-loader"   />
                    <div class="remarkeble">
                      
                    </div>
                    
                    </div>

                  <div class="row" id="dataRetrival">
                    </div>
                  
                  <div class="row" id="data2Retrival">
                  </div>
 
                              </div>
                        </div>            
                    </div>
              </div>
            </div>
                          <!--content end-->
                            <footer class="sticky-footer bg-white">
                              <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                  <span class="text-uppercase"> <?= $_SESSION['blancName'] ?>(<?=$_SESSION['branchLocation']?>)</span>
                                </div>
                              </div>
                            </footer>
                      </div>
                      <!-- end of content wrapper -->             
              </div>
              <!-- end of  wrapper -->  
              <a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
                <i class="fas fa-angle-up"></i>
              </a>
      
  
  

      <div class="modal fade" id="dailTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">This time is based on this date <span class="text-info" id="picked-date"></span></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-12"></div>
              <div class="timeslot" id='timeslot'>

              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="button" data-dismiss="modal">Done</button>
              </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Every proccesed data will be sent to your email </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="col-12">
                     <div class="row">
                       <div class="col-12 col-md-6">
                         <label for="dara From">Date from</label>
                         <input type="date" class="form-control form-control-sm" name="fromDate" id="_ngrs_tyk76">
                       </div>
                       <div class="col-12 col-md-6">
                          <label for="dara From">Date until</label>
                          <input type="date" class=" form-control form-control-sm" name="untilDate" id="_ngrsk76">
                        </div>
                     </div>                 
                </div>                
              </div>
              <div class="modal-footer d-flex justify-content-between">
                  <button class="btn btn-secondary" type="button"  data-dismiss="modal">Leave</button>
                  <button class="btn btn-info" type="button" id="_ng1pf53p_l" task="ng4" data-dismiss="modal">Proccess</button>
              </div>
            </div>
          </div>
        </div>

  <?php //for cars  ?>
 
  <div class="modal fade" id="carsection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="content"  >
  <div class="modal-dialog" role="document" id="modelContent">
     
    </div>
  </div>
  
  </div>
 


<?php include 'include/footerui.php' ?>

<script>
  let  recordList = document.querySelector('.record-list');
  var nmField = document.querySelector('.user-name');
  var emField = document.querySelector('.user-email');
  function dnRemover(bn){
         bn.forEach(element => {
           element.classList.remove('d-none');
         });
    }
    function dnAdder(bn){
      bn.forEach(element => {
           element.classList.add('d-none');
         });
    }
    $(document).ready(()=>{
 
      let taskinfo =  document.getElementById('taskinfo');
      let field   =  document.getElementById('taskResponseField');
      let RepCars = document.getElementById('RepCars');
      let repLabour = document.getElementById('repLabour');
      let repDriver = document.getElementById('repDriver');
      let filedtaskReport = document.getElementById('filedtaskReport');
      let responseReport = document.getElementById('filedtaskReportResponse');
    
      //=========
      
      function getCars(){
        dataloader(field,' ');
        taskinfo.childNodes[1].innerHTML =  'Cars reports';
        ajaxloader.style.display='block';
        ajaxloader.parentElement.style.display='block';
        $.ajax({
          url:'reportMan_rae3453fe/repote3453da.php', 
          method:'POST',
          data:{
            sd3453:'fine',            
          },
          beforeSend:()=>{
            ajaxloader.style.display='block';
          },
          dataType:'json',
          success:(data)=>{
            ajaxloader.style.display='none';
            ajaxloader.parentElement.style.display='none';       
            const i = 0 ;    
            for (const i in data) {
              field.innerHTML += `
                 <span  class=" btn btn-info btn-icon-split m-1 btn-sm  " data-toggle="tooltip"  data-placement="left"  title="${data[i].marque}" >
                  <span class="icon text-white-70">
                      <i class="fas fa-car"></i>
                    </span>
                    <span  class="text" car-tank="${data[i].id}" id="ngpkgl26${data[i].live}17" onClick="carReport(this.id)">${data[i].plaque} </span>
                  </span> `;
          
            }
            //$('[data-toggle="tooltip"]').tooltip();
                 
         },
         error:()=>{
                ajaxloader.style.display='none';
                dataloader(field,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

            }
        })
      }

      function fetchEmploData(){
        dnRemover([nmField,emField]);
        dataloader(field,' ');
        taskinfo.childNodes[1].innerHTML =  'User report';
        ajaxloader.style.display='block';
        ajaxloader.parentElement.style.display='block';
            $.ajax({
                url:'adminstrationBook/include/fetchUser.php',
                method:'POST',
                data:{
                  ngty789d3453:'fine',  
                },
                dataType:'json',
                success:function(data){
                  ajaxloader.style.display='none';
                  ajaxloader.parentElement.style.display='none';       
                  const i = 0 ;    
                  for (const i in data) {
                    field.innerHTML += `
                      <div  class=" btn btn-success btn-icon-split m-1 btn-sm  " data-toggle="tooltip"   data-placement="left"  style title="${data[i].username}" >
                        <span class="icon text-white-70">
                            <i class="fas fa-user"></i>
                          </span>
                          <span  class="text" email="${data[i].email}"  username="${data[i].username}"  triple-tank="${data[i].id}" id="ngpkgl26${i}17" onClick="betReport(this.id)" style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap"   >${data[i].email} </span>
                        </div> `;
                
                  }
                  //$('[data-toggle="tooltip"]').tooltip();
                  
                
                },
                error:()=>{
                ajaxloader.style.display='none';
                dataloader(field,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

              }
            })
        }
    
     function fetchDriverData(){
        dnRemover([nmField,emField]);
        dataloader(field,' ');
        taskinfo.childNodes[1].innerHTML = 'Driver report';
        ajaxloader.style.display='block';
        ajaxloader.parentElement.style.display='block';
            $.ajax({
                url:'reportMan_rae3453fe/repote3453da.php',
                method:'POST',
                data:{
                  ngty789d3453:'fine',  
                },
                dataType:'json',
                success:function(data){
                  ajaxloader.style.display='none';
                  ajaxloader.parentElement.style.display='none';       
                  const i = 0 ;    
                  let color = 'warning';
                  for (const i in data) {
                    if(data[i].live == 0 ){
                      color = 'danger';
                    }
                    field.innerHTML += `
                      <span  class=" btn btn-${color} btn-icon-split m-1 btn-sm  "  data-toggle="tooltip"  data-placement="left"  title="${data[i].email}" >
                        <span class="icon text-white-70">
                            <i class="fas fa-user"></i>
                          </span>
                          <span  class="text" email="${data[i].email}"  username="${data[i].username}"  triple-tank="${data[i].id}" id="ngpkgl26${i}17" onClick="betReport(this.id)" style=" overflow:hidden;max-width:120px;text-overflow:ellipsis;white-space:nowrap" >${data[i].username} </span>
                        </span> `;
                
                  }
                  //$('[data-toggle="tooltip"]').tooltip();
                 
                },
                error:()=>{
                ajaxloader.style.display='none';
                dataloader(field,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

              }
            })
        }
  


        
      
      //========
      getCars();
      RepCars.addEventListener('click',()=>{   
        dnAdder([nmField,emField]);   
        filedtaskReport.childNodes[1].innerHTML = 'Cars reports';
        taskinfo.childNodes[1].textContent != 'Cars reports' ?  
            getCars():' ';            
        });
      repLabour.addEventListener('click',()=>{
        dnRemover([nmField,emField]);
        filedtaskReport.childNodes[1].innerHTML = 'Users reports';
        taskinfo.childNodes[1].textContent != 'User report' ?  
            fetchEmploData():' ';            
        });
       repDriver.addEventListener('click',()=>{   
        dnAdder([nmField,emField]);      
        filedtaskReport.childNodes[1].innerHTML = 'Driver report'; 
          taskinfo.childNodes[1].textContent != 'Driver report' ?  
          fetchDriverData():' ';  
       })
      
       let r1 =document.getElementById("_ng1p453p_l"); 
       let r2 =document.getElementById("_ng1plka53p_l"); 
       let r3 =document.getElementById("_ng1pmn53p_l"); 
       let r4 =document.getElementById("_ng1pf53p_l"); 
       r1.addEventListener('click',()=>{
        dnAdder([nmField,emField]);
        $.ajax({
          url:"reportMan_rae3453fe/rep_2oter43NB.php",
          method:"POST",
          data:{
            rep_2oter:'pt_1pns32'
          },
          dataType:'text',
          success:(data)=>{
            // console.log(data);
            recordList.innerHTML ='<div class="table-responsive" >'
              +data+
              '</div>';
              $('#datatable1').DataTable( {          
                  proccesing:true,
                  responsive:true
                    } );
          }
        })
       })
    r2.addEventListener('click',()=>{
        dnAdder([nmField,emField]);
        $.ajax({
          url:"reportMan_rae3453fe/rep_2oter43NB.php",
          method:"POST",
          data:{
            _ngpck_rt453:'_ngpck'
          },
          dataType:'text',
          success:(data)=>{
            // console.log(data);
            recordList.innerHTML ='<div class="table-responsive" >'
              +data+
              '</div>';
              $('#datatable1').DataTable( {          
                  proccesing:true,
                  responsive:true
                    } );
          }
        })
       })

       r3.addEventListener('click',()=>{
        dnAdder([nmField,emField]);
        $.ajax({
          url:"reportMan_rae3453fe/rep_2oter43NB.php",
          method:"POST",
          data:{
            _ngpck12Tv_ki:'_ngpck'
          },
          dataType:'text',
          success:(data)=>{
            // console.log(data);
            recordList.innerHTML ='<div class="table-responsive" >'
              +data+
              '</div>';
              $('#datatable1').DataTable( {          
                  proccesing:true,
                  responsive:true
                    } );
          }
        })
       })

  
       r4.addEventListener('click',(e)=>{
       e.preventDefault();
       dnAdder([nmField,emField]);
        let _ngpkt_f = document.getElementById("_ngrs_tyk76").value;
        let _ngckt_f = document.getElementById("_ngrsk76").value;
   
       if((_ngpkt_f.length < 10 || _ngpkt_f.length > 10) || (_ngckt_f.length < 10 || _ngckt_f.length > 10) ){
        recordList.innerHTML = '<div class="alert alert-danger">you prided wrong detail';

       }else{
        $.ajax({
          url:"reportMan_rae3453fe/rep_2oter43NB.php",
          method:"POST",
          data:{
            _ngp34cktu67_ki:'_ngpck',
            _ngpcktu67_ki:_ngpkt_f,
            _ngpckt_ki:_ngckt_f
          },
          dataType:'text',
          success:(data)=>{
            // console.log(data);
            recordList.innerHTML ='<div class="table-responsive" >'
              +data+
              '</div>';
              $('#datatable1').DataTable( {          
                  proccesing:true,
                  responsive:true
                    } );
          }
        })
       }
      })

    });
   
    
    function carReport(tanker){
            let  dataTanker =  document.getElementById(`${tanker}`);
            let actualData  =  dataTanker.getAttribute('car-tank');
          
            dnRemover([nmField,emField]);
            $.ajax({
              url:'reportMan_rae3453fe/rep_2oter43NB.php',
              method:'POST',
              data:{
                _ngt32mdnkf45_53:actualData,
                _ngt32mps5dnkf45_53:dataTanker.textContent
              },
              dataType:'text',
              success:(data)=>{
                recordList.innerHTML ='<div class="table-responsive" >'
                +data+
                '</div>';
                $('#datatable1').DataTable( {          
                    proccesing:true,
                    responsive:true
                    } );
                 
              }
            })     
             
          }
    
    function betReport(tanker){
            let dataTanker  =  document.getElementById(`${tanker}`);
            let actualData  =  dataTanker.getAttribute('triple-tank');
            let email = dataTanker.getAttribute('email');
            let username = dataTanker.getAttribute('username');
            nmField.innerHTML = email;
            emField.innerHTML = username;
            dnRemover([nmField,emField]);
            $.ajax({
              url:'reportMan_rae3453fe/repote3453da.php',
              method:'POST',
              data:{
                ngtvajsdnkf45_53:actualData
              },
              dataType:'text',
              success:(data)=>{
                recordList.innerHTML = data;
              }
            })     
             
          }
   

</script>
<?php

}

else{
  $msg = '
  <div class="container">
  <div class="card shadow mt-5">
  <div class=" alert alert-warning text-center m-5"><div class = "p-5">access denied please! <a  class="btn btn-info" href="login.php">login</a>  </div> </div>
  </div>
  </div>
 ';
  echo '<script> window.open("login.php","_self") </script>';
  exit($msg);
}
?>

