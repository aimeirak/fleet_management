var DriverProg = document.getElementById('DriverProg'); 
if(!isNull(DriverProg)){
    DriverProg.addEventListener('click',()=>{
       $.ajax({
           url:'cars_fluid/cardailydata.php',
           method:'POST',
           data:{
               pro:12,
                },
           success:(data)=>{
            dataloader(dataView,data);
            } 
       })
    })
}
