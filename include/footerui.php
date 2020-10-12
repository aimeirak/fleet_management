
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">See you soon <?= $_SESSION['username'] ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" to proceed </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <?php if($_SESSION['role'] == 30){?>
  <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Why are you rejecting?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div id='rep'>
           
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="diss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Why are you canceling ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div id='intro'>
           
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
 <?php
$sql = "SELECT fluid_place.id,Ucase(name) as name FROM fluid_place 
INNER JOIN fluid_user ON fluid_place.id_user=fluid_user.id WHERE fluid_user.id_subcompany=" . $_SESSION['sub_company'];
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
 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>


    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>    
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/DataTables/dataTables.buttons.min.js"></script>
    <script src="assets/DataTables/buttons.print.min.js"></script>
    <script src="assets/DataTables/pdfmake.min.js"></script>
    <script src="assets/DataTables/vfs_fonts.js"></script>
    <script src="assets/DataTables/buttons.html5.min.js"></script>
   
<script src="assets/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="assets/js/leon/fluid_inner_bon.js"></script>
<script src="assets/js/leon/badgecount.js"></script>
<script src="assets/js/leon/carInfo.js"></script>
<script src="assets/js/leon/fruid_back_inc_bone.js"></script>
<?php
if($_SESSION['role'] == 30){
?>
<script>

function loadBadge(bp){
    var noteLead = '';
    $.ajax({
      url:'notification_lead/note.php',
      method:'post',
      data:{
          btcre:bp
      },
      dataType:'json',
      success:(data)=>{
         if(bp == 1){
           noteLead =document.querySelector('.cb') ;
           if(!isNull(noteLead)){
            if(data.count <= 0 ){
           
           noteLead.classList.add('d-none');
                }else{
                    
                noteLead.innerHTML = data.count;
                }

           }
           
         }else if(bp == 2){
           noteLead = document.querySelector('.ck');
           if(!isNull(noteLead)){
            if(data.count <= 0 ){
           
           noteLead.classList.add('d-none');
                }else{
                    
                noteLead.innerHTML = data.count;
                }

           }
         }else{
           noteLead = document.querySelector('.co');
           if(!isNull(noteLead)){
            if(data.count <= 0 ){
           
           noteLead.classList.add('d-none');
                }else{
                    
                noteLead.innerHTML = data.count;
                }

           }
         }

      }

    });


  } 

  $(document).ready(function(){
  try{
    setInterval(()=>{
      for( var i = 1 ; i <= 3 ; i++){
        loadBadge(i);
      } 
    },9000);
  }
  catch(error){
   
  }
   
})
 

 

</script>
<?php
  }
?>
    <script>

        window.addEventListener('load',()=>{
            const loader = document.querySelector('.loader');
            loader.classList.add('lodh'); 
        })
  
    var remarkeble = document.getElementById('remarkeble');
    var DriverProg = document.getElementById('DriverProg'); 
if(!isNull(DriverProg)){
    DriverProg.addEventListener('click',()=>{
        ajaxloader.style.display='block';
        ajaxloader.parentElement.style.display='block';
       $.ajax({
           url:'cars_fluid/cardailydata.php',
           method:'POST',
           data:{
               pro:12,
                },
            beforeSend:()=>{
                ajaxloader.style.display='block';
            },
           success:(data)=>{
            ajaxloader.style.display='none';
            ajaxloader.parentElement.style.display='none';
            dataloader(dataView,data);
            var processPro =  document.getElementById('processPro'); 
            
            processPro.addEventListener('click',()=>{
            ajaxloader.style.display='block';
            ajaxloader.parentElement.style.display='block';
                var start_date =  document.getElementById('start_date'); 
                var end_date =  document.getElementById('end_date'); 
                var endV = end_date.value;
                var startV = start_date.value;
                dataloader(dataView,'');
                    $.ajax({
                        url:'cars_fluid/cardailydata.php',
                        method:'POST',
                        data:{
                          
                            pro:1,
                            from:startV,
                            until:endV,
                           
                        },
                        beforeSend:()=>{
                            ajaxloader.style.display='block';
                        },
                       success:(data)=>{
                        ajaxloader.style.display='none';
                        ajaxloader.parentElement.style.display='none';
                       dataloader(seconddataView,data);
                       
                
                       }
                       ,
                        error:()=>{
                            ajaxloader.style.display='none';
                            dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

                        }
                    })
                });
            },
             error:()=>{
                ajaxloader.style.display='none';
                dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

            } 
       })
    })
}

      var bur = document.getElementById('sidebarToggleTop'); 
      var sider =  document.getElementById('accordionSidebar');
      var clearb =  document.getElementById('returnB');
      var page =  document.getElementById('page-top');
      //if car is clicked 

var seconddataView = document.getElementById('data2Retrival');
var process =  document.getElementById('process');
function getvalue(indi){
    var carPlate = indi; 
   
    

      $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            dataSent:1,
            carIdentity:carPlate
        },
        success:(data)=>{
            dataloader(seconddataView,data);
             process =  document.getElementById('process'); 
            
           
            process.addEventListener('click',()=>{
            var start_date =  document.getElementById('start_date'); 
            var end_date =  document.getElementById('end_date'); 
            var endV = end_date.value;
            var startV = start_date.value;
                $.ajax({
                    url:'cars_fluid/cardailydata.php',
                    method:'POST',
                    data:{
                      
                        plate:carPlate,
                        from:startV,
                        until:endV,
                       

                    },
                   success:(data)=>{
                   dataloader(seconddataView,data);
            process =  document.getElementById('process');        
            process.addEventListener('click',()=>{
            var start_date =  document.getElementById('start_date'); 
            var end_date =  document.getElementById('end_date'); 
            var endV = end_date.value;
            var startV = start_date.value;
                $.ajax({
                    url:'cars_fluid/cardailydata.php',
                    method:'POST',
                    data:{
                      
                        plate:carPlate,
                        from:startV,
                        until:endV,
                       

                    },
                    success:(data)=>{
                   dataloader(seconddataView,data);
                   }
                })
            });
                   }
                })
            });
            

        }
    });
    
    };
   
   
           
//end car clicked
    
      page.addEventListener('mouseover',()=>{
        if(window.outerWidth >= 770){
          sider.style.display = '';
        }
        
     });
     
       
      bur.addEventListener('click',()=>{
          if(sider.style.display == 'none'){
            sider.style.display = '';
            if(!isNull(clearb)){
                clearb.style.display = 'none';
            }
            
          }else{
            if(!isNull(clearb)){
                clearb.style.display = '';
            }            
            sider.style.display = 'none';
          }
       
      })
      if(window.innerWidth >= 768){
          sider.style.display = '';
        }else{
            sider.style.display = 'none'
        }
       

      //book
      var bookRide =  document.getElementById('bookRide');
      var pickedDate = document.getElementById('picked-date');
     if(!isNull(bookRide)){
        bookRide.addEventListener('click',()=>{
            ajaxloader.style.display='block';
            ajaxloader.parentElement.style.display='block';
         $.ajax({
            url:'booklead/valMe.php',
            method:'POST',
            data:{
                b:1,
            },
            beforeSend:()=>{
                ajaxloader.style.display='block';
            },
            success:(data)=>{
                ajaxloader.style.display='none';
                ajaxloader.parentElement.style.display='none';
                dataloader(dataView,data);
            },
            error:()=>{
                ajaxloader.style.display='none';
                dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

            }
         });
      })
     }
     function getWeek(week){
          //  gettin date
         var clikedWeek = document.getElementById(`${week}`);
         var actualWeek = clikedWeek.getAttribute('data-week');
         //geting time place
         var slots = document.getElementById('timeslot');
         dataloader(pickedDate,actualWeek);
         $.ajax({
            url:'booklead/valMe.php',
            method:'POST',
            data:{
                b:2,
                d:actualWeek
            },
            success:(data)=>{
                dataloader(slots,data);
            }
         });

     }
   

     function getTime(startEndTime){
          //  gettin time
         var clikedTime = document.getElementById(`${startEndTime}`);
         var actualtime = clikedTime.getAttribute('daily-time');
         var actualDate = clikedTime.getAttribute('actual');
         //getting valid time
         var startTime = actualtime.slice(0,5); 
         var endTime   = actualtime.slice(8,13); 
         //getting full start time 
         var fullStartTime = actualDate +' '+ startTime;
         //getting full start time 
         var fullEndTime = actualDate +' '+ endTime;

        dataloader(dataView,`startTime = ${fullStartTime} - endtme = ${fullEndTime}`);
         $.ajax({
            url:'booklead/bookinLeftFom.php',
            method:'POST',
            data:{
                b:3,
                st:startTime,
                s:fullStartTime,
                et:endTime,
                e:fullEndTime,
                ad:actualDate
                            
            },
            success:(data)=>{
                dataloader(dataView,data);
                var data = <?= $json?>;

                $(".myselect").select2({
                    data: data
                });
                 var msg = document.getElementById('msg');
                 var submi = document.getElementById('sub');
                    submi.addEventListener('click',()=>{
                        var status = document.getElementById('status');
                        var departure = document.getElementById('departure');
                        var name_dep = document.getElementById('name_dep');
                        var destination = document.getElementById('destination');
                        var start = document.getElementById('start');
                        var end = document.getElementById('end');
                      
                       //value
                        
                        var statusV = status.value;
                        var departureV = departure.value ;
                        var name_dep = name_dep.value;
                       
                        var destinationV = destination.value ;
                        var startV = start.value;
                        var endV = end.value;
                   
                       
                        if(departureV == destinationV ){
                            msg.innerHTML='<div class="alert alert-danger"> you need to have destination defferent from departure</div>';
                            
                        }
                      
                        else if(destinationV == ''){
                            msg.innerHTML='<div class="alert alert-danger"> destination field is empty</div>';
                            
                        }
                        else if(departureV == ''){
                            msg.innerHTML='<div class="alert alert-danger"> departure field is empty</div>';
                            
                        }
                        else if(statusV == ''){
                            msg.innerHTML='<div class="alert alert-danger"> status field is empty</div>';
                            
                        }
                        else if(name_dep == ''){
                            msg.innerHTML='<div class="alert alert-danger"> department field is empty</div>';
                            
                        }
                        
                        
                        else{
                            var ett = endV.slice(11,13);
                              ett+=endV.slice(13,16);
                            $.ajax({
                                url:'booklead/bookLast.php',
                                method:'POST',
                                data:{
                                    send:1,
                                  
                                    stat: statusV,
                                    dep: departureV,
                                    nameD: name_dep,
                                    et:ett,
                                    dest: destinationV,
                                    startT: startV,
                                    endT: endV,
                                },
                                success:(dat)=>{
                                    msg.innerHTML=dat;                                    
                                },
                                dataType:'text'
                            })
                        }
                        
                                            
                    });
                   
            }
         });

        }

      //end book

function getV(btn){
    var saveAvail = document.getElementById('saveAvail'); 
    var fromDate = document.getElementById('fromDate').value; 
    var toDate = document.getElementById('toDate').value; 
    var fromTime = document.getElementById('fromTime').value; 
    var toTime = document.getElementById('toTime').value; 
    var description = document.getElementById('description').value; 
    var startData = fromDate+' '+fromTime; 
    var endDate = toDate+' '+toTime; 
  
    saveAvail.addEventListener('click',()=>{
      console.log(`from ${startData} to ${endDate}`);
      $.ajax({
          url:'include/avail.php', 
          method:'POST',
          data:{
              driver:<?=$_SESSION['id']?>,
              start:startData,
              end:endDate,
              descr:description,
              
          },
          success:(data)=>{
              dataloader(seconddataView,data);
              $.ajax({
                url:'include/avail.php',
                method:'POST',
                data:{
                    list:1,
                    plate:1
            },
          success:(data)=>{
                dataloader(dataView,data);
             }
          });
      }
      })
  })
}

//confirmed bookin
var confirmedb = document.getElementById('confirmedb');
if(!isNull(confirmedb)){
    confirmedb.addEventListener('click',()=>{
    ajaxloader.style.display='block';
    ajaxloader.parentElement.style.display='block';  
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{           
            confirmedb:1
        },
        beforeSend:()=>{
            ajaxloader.style.display='block';
        },       
        success:(data)=>{
            ajaxloader.style.display='none';
            ajaxloader.parentElement.style.display='none';
            dataloader(dataView,data);
            dataloader(seconddataView,' ');
        },
        error:()=>{
            ajaxloader.style.display='none';
            dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

        }
   })
})
}

//end confirmed bookin
//start_trip
function confBook(){
    $.ajax({
            url:'cars_fluid/cardailydata.php',
            method:'POST',
            data:{           
                confirmedb:1
            },
            success:(data)=>{
                dataloader(seconddataView,data);
            }
    })
}
function startTrip(picker){   
     var pick  = document.getElementById(`${picker}`); 
     var tanker = pick.getAttribute('dta-b');
     $.ajax({
        url:'booklead/booklead.php',
        method:'POST',
        data:{           
            strt:1,
            dt:tanker
        },
        success:(data)=>{
            dataloader(dataView,data);
           //confirmed bookin
           confBook();
            //===========
        }
   })

}
//=====end of start

//end_trip
// function endTrip(picker){
//     var pick   = document.getElementById(`${picker}`); 
//     var tanker = pick.getAttribute('dta-b');
//     if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition((pos)=>{
//       var long = pos.coords.longitude;
//       var lat = pos.coords.latitude;
     
//       $.ajax({
//         url:'booklead/booklead.php',
//         method:'POST',
//         data:{           
//             lo:long,
//             la:lat,
//             pt:tanker
//         },
//         success:(data)=>{
//             dataloader(dataView,data);
//             $.ajax({
//             url:'booklead/booklead.php',
//             method:'POST',
//             data:{           
//                 endb:1,
//                 dt:tanker
//             },
//             success:(data)=>{
//                 dataloader(dataView,data);
//                 //confirmed bookin
//                 confBook();
//                 //===========
                
//             }
//     })
            
//         }
//    })
//     });
    
    
    
//    }
//    else { 
//     alert("You need to allow us .");
//     }
//  }

function endTrip(picker){
    var pick   = document.getElementById(`${picker}`); 
    var tanker = pick.getAttribute('dta-b');
      var long = '-- ';
      var lat = '--';
    //if we enable https we change function over

     $.ajax({
        url:'booklead/booklead.php',
        method:'POST',
        data:{           
            lo:long,
            la:lat,
            pt:tanker
        },
        success:(data)=>{
            dataloader(dataView,data);
            $.ajax({
            url:'booklead/booklead.php',
            method:'POST',
            data:{           
                endb:1,
                dt:tanker
            },
            success:(data)=>{
                dataloader(dataView,data);
                //confirmed bookin
                confBook();
                //===========
                
            }
    })
            
        }
   })
 }
//end of endtrip

//=====end driver
//ViewBook
var ViewBook = document.getElementById('ViewBook');
if(!isNull(ViewBook)){
    ViewBook.addEventListener('click',()=>{
        ajaxloader.style.display='block';
        ajaxloader.parentElement.style.display='block';
   $.ajax({
        url:'booklead/mybookin.php',
        method:'POST',
        data:{           
            mybookin:1
        },
        beforeSend:()=>{
                ajaxloader.style.display='block';
            },
        success:(data)=>{
            ajaxloader.style.display='none';
            ajaxloader.parentElement.style.display='none';
            dataloader(dataView,data);
            dataloader(seconddataView,' ');
        },
         error:()=>{
                ajaxloader.style.display='none';
                dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

            }
   })
})
}
//end======ViewBook



//selectCar
var selectCar = document.getElementById('selectCar');
var content   = document.getElementById('modelContent');
if(!isNull(selectCar)){
    selectCar.addEventListener('click',()=>{
        $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            s:1,
            d:<?= $_SESSION['id']?>,
            r:<?= $_SESSION['role']?>
            
        },
        success:(data)=>{
            dataloader(content,data);
         
        }
    });
    });
    
}
function  getCar(car){
                var car  = document.getElementById(`${car}`); 
                var data = car.getAttribute('tank-data');
                var carI = data;
                var carInfo  = document.getElementById('carInfo'); 
                $.ajax({
                    url:'cars_fluid/carSelect.php',
                    method:'POST',
                    data:{
                        u:1,
                        d:data
                    },
                    success:(data)=>{
                        dataloader(carInfo,data);
                        var carSelect  = document.getElementById("carSelect"); 
                      
                        carSelect.addEventListener("click",()=>{
                            $.ajax({
                                url:'cars_fluid/carSelect.php',
                                method:'POST',
                                data:{
                                    u:2,
                                    d:<?= $_SESSION['id']?>,
                                    r:<?= $_SESSION['role']?>,
                                    cr:carI

                                },
                                success:(data)=>{
                                //   dataloader(dataView,data);
                                  window.open("uiupdate.php","_self");
                                }
                        })  
                      
                    });
                   }
                    
                })
            };
            //end car selection 
//end+++++++======end



function action(placeToc){
  
    var upTo = document.getElementById(`${placeToc}`);
    var p    = upTo.getAttribute('dta-b');
    $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            u:1,
            dp:p,
            re:0
        },
        success:(data)=>{
            dataloader(dataView,data);
        }
    }); 
   
   
}

function dismiss(placeToc){
    var ks = document.getElementById(`reason`);
    var ksv = ks.value;
    if(ksv.trim() == ''){
        dataloader(dataView,`<div class="alert alert-danger mt-3" style="margin:auto">Please mention your reason</div>'`);
    }else{
        $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            u:1,
            dp:placeToc,
            re:1,
            ks:ksv          
           
        },
        success:(data)=>{
            dataloader(dataView,data);
        }
    }); 
    }
   
}
function reject(placeToc){
    var pro = document.getElementById(`rep`);
    var upTo = document.getElementById(`${placeToc}`);
    var p    = upTo.getAttribute('dta-b');
    $.ajax({
        url:'include/forms/addforms.php',
        method:'POST',
        data:{
            ACT:'re',
            b:p           
        },
        dataType:'text',
        success:(data)=>{
            dataloader(pro,data);
        }
    }); 
}
function cancel(placeToc){
    var pro = document.getElementById(`intro`);
    var upTo = document.getElementById(`${placeToc}`);
    var p    = upTo.getAttribute('dta-b');
    $.ajax({
        url:'include/forms/addforms.php',
        method:'POST',
        data:{
            ACT:'ca',
            b:p           
        },
        dataType:'text',
        success:(data)=>{
            dataloader(pro,data);
        }
    }); 
}
function procced(placeToc){
    var ks = document.getElementById(`reason`);
    var ksv = ks.value;
    if(ksv.trim() == ''){
        dataloader(dataView,`<div class="alert alert-danger mt-3" style="margin:auto">Please mention your reason</div>'`);
    }else{
        $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            u:1,
            dp:placeToc,
            re:2,
            ks:ksv          
           
        },
        success:(data)=>{
            dataloader(dataView,data);
        }
    }); 
    }
}

var clear =  document.getElementById('returnB');
clear != null ? 
clear.addEventListener('click',()=>{
    document.getElementById('dataRetrival').innerHTML ='';
    document.getElementById('data2Retrival').innerHTML ='';
})
:'';

    
  $(document).ready(function() {
      $('#datatable1').DataTable( {          
          proccesing:true,
          responsive:true
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
                    title: 'booking report on '+ datetime,
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


