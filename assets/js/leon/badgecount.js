var total = document.getElementById('totalBooked');


function loadBadge (){
    $.ajax({
        url:'include/bdgecounter.php',
        method:'POST',
        data:{
            totalBooked:3
        },
        success:(data)=>{
            total.innerHTML=data;
        } 

    });
} 

total != null ? 
setInterval(function(){
    loadBadge();
},1100)
:'';

