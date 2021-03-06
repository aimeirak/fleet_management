
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
  

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

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
     window.addEventListener('load',()=>{
            const loader = document.querySelector('.loader');
            loader.classList.add('lodh'); 
        })
    
    $(document).ready(function() {
        $('.table').DataTable({           
              } );
    } )
    
    var sider =  document.getElementById('accordionSidebar');    
    if(window.innerWidth >= 768){
          sider.style.display = '';
        }else{
            sider.style.display = 'none'
        }
       
    
  
  
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


<?php mysqli_close($connection);?>

