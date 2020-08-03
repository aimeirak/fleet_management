

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
    <script>
       

      var bur = document.getElementById('sidebarToggleTop'); 
      var sider =  document.getElementById('accordionSidebar');
      var clearb =  document.getElementById('returnB');
      var page =  document.getElementById('page-top');
    
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

      //book
      var bookRide =  document.getElementById('bookRide');
      var pickedDate = document.getElementById('picked-date');
     if(!isNull(bookRide)){
        bookRide.addEventListener('click',()=>{
         $.ajax({
            url:'booklead/valMe.php',
            method:'POST',
            data:{
                b:1,
            },
            success:(data)=>{
                dataloader(dataView,data);
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
    function endAvail(tank){

         //  gettin id
         var tank = document.getElementById(`${tank}`);
         var dt = tank.getAttribute('data-tanker');
         $.ajax({
            url:'include/avail.php',
            method:'POST',
            data:{
                d:1,
                dt:dt,
                t:2
            },
            success:(data)=>{
                dataloader(dataView,data);
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
                        var plaque = document.getElementById('plaque');
                        var status = document.getElementById('status');
                        var departure = document.getElementById('departure');
                        var name_dep = document.getElementById('name_dep');
                        var description = document.getElementById('description');
                        var destination = document.getElementById('destination');
                        var start = document.getElementById('start');
                        var end = document.getElementById('end');
                      
                       //value
                        var plaqV =  plaque.value;
                        var statusV = status.value;
                        var departureV = departure.value ;
                        var name_dep = name_dep.value;
                        var descriptionV = description.value;
                        var destinationV = destination.value ;
                        var startV = start.value;
                        var endV = end.value;
                   
                       
                        if(departureV == destinationV ){
                            msg.innerHTML='<div class="alert alert-danger"> you need to have destination defferent from departure</div>';
                            
                        }
                        else if(descriptionV == ''){
                            msg.innerHTML='<div class="alert alert-danger"> description field is empty</div>';
                            
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
                        else if(plaqV == 0){
                            msg.innerHTML='<div class="alert alert-danger"> Please change booking time! there is no car available from '+ start +' until '+ end +' </div>';
                            
                        }
                        else{
                          
                            $.ajax({
                                url:'booklead/bookLast.php',
                                method:'POST',
                                data:{
                                    send:1,
                                    pl: plaqV,
                                    stat: statusV,
                                    dep: departureV,
                                    nameD: name_dep,
                                    descr: descriptionV,
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

$("#dataRetrival").bind('DOMSubtreeModified', function() {
    var saveAvail = document.getElementById('saveAvail'); 

});

if(!isNull(Avail)){
    Avail.addEventListener('click',()=>{
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
   })
})
}
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
    var upTo = document.getElementById(`${placeToc}`);
    var p    = upTo.getAttribute('dta-b');
    $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            u:1,
            dp:p,
            re:1
           
        },
        success:(data)=>{
            dataloader(dataView,data);
        }
    }); 
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


