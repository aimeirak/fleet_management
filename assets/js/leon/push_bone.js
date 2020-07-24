var playground = document.getElementById('page-ground'); 

function  changePlayground(ground,mvalue){        
    ground != null ? ground.innerHTML = mvalue : false ;      
}  


$('#page-ground').bind('DOMSubtreeModified', function(){
    var startDate = document.getElementById('startDate');
    var endDate   = document.getElementById('endDate');
    var book      = document.getElementById('book');

    playground.addEventListener('click',function(){
        var datetimepicker1 = document.getElementById('datetimepicker1');
        var datetimepicker2 = document.getElementById('datetimepicker2');
        var startDate       = document.getElementById('startDate');
        var endDate         = document.getElementById('endDate'); 
        var book      = document.getElementById('book');
    })
    $(document).ready(function() {
        $('#datatable1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print',
            ],
            exclude:'ex',
            proccesing:true,
            responsive:true
              } );
    } )
    var go         = document.getElementById('go');
    
   
//starttime about booking
    startDate != null ?  startDate.addEventListener('keyup',()=>{ 
      startDateV = startDate.value;
    }) : console.log();
//endtime
endDate != null && startDate != null ?  endDate.addEventListener('keyup',()=>{ 
    endDateV = endDate.value;
    if(endDateV.length >= 10 && endDateV.length <= 16 && startDateV.length >= 10 && startDateV.length <= 16){
     

      playground != null ? 
    $.ajax({
        url:'tasks/allbookings.php',
        method:'POST',
        data:{
            allbooking:1,
            start_date: endDateV,
            end_date: endDateV

        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen go is clicked
            

               
        },
        dataType:'text'
    })
    : false ; 

      
    }
        
  
 
  }) :false;

//   end  allbooking
//==========================
//new booking


book != null ? book.addEventListener('click',()=>{
    var startTime = document.getElementById('startTime'); 
    var endTime = document.getElementById('endTime'); 

     var startDate = document.getElementById('start_time'); 
     var endDate = document.getElementById('end_time'); 
     
     var destinationin = document.getElementById('destination'); 
     var departurein = document.getElementById('departure'); 
     var statusin = document.getElementById('status');
     var plaquein = document.getElementById('plaque');  
     var discr  = document.getElementById('description');  
     var departments_id = document.getElementById('name_dep'); 

     var start = `${startDate.value} ${startTime.value}`;
     var end = `${endDate.value} ${endTime.value}`;


     playground != null ? 
     $.ajax({
         url:'tasks/booking.php',
         method:'POST',
         data:{
           
             book:1,
             
             plaque:plaquein.value,
             start_time:start,
             end_time:end,
             departure:departurein.value,
             destination:destinationin.value,
             status:statusin.value,
             name_dep:departments_id.value,
             description: discr.value

         },
         success:(data)=>{
             changePlayground(playground,data);
             playground != null ? 
    $.ajax({
        url:'tasks/allbookings.php',
        method:'POST',
        data:{
            allbooking:1,
            start_date:start,
            end_date:end,
         

        },
        success:(data)=>{
            changePlayground(playground,data);                    

               
        },
        dataType:'text'
    })
    : console.log() ;

            },
         dataType:'text'
     })
     : false; 


}) : false;



//end booking
//====================
   

//end of domesubtree modidfied
  });