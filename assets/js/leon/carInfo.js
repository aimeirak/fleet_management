
// car loader      
var dataView = document.getElementById('dataRetrival');
var carList = document.getElementById('carList');
var carId = document.getElementById('carId');
var ajaxloader = document.getElementById('ajax-loader');
function dataloader(place,value){
    place != null?
    place.innerHTML = value
    :'';
    

}
function isNull(spaceX){
    if(spaceX == null)
        return true;
    else
        return false  
}



carList != null ?
carList.addEventListener('click',()=>{
    ajaxloader.style.display='block';
    ajaxloader.parentElement.style.display='block';
    $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            dataSent:1,
            carListOnly:1
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

    })
})

:'';


// end car loader    


//dirvers

var dailBook = document.getElementById('dailBook');
var rejected = document.getElementById('rejected');
var confirmedb = document.getElementById('confirmedb');

if(!isNull(dailBook)){
    dailBook.addEventListener('click',()=>{
    ajaxloader.style.display='block';
    ajaxloader.parentElement.style.display='block';    
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{           
            booking:1
        },
        beforeSend:()=>{
            ajaxloader.style.display='block';
        },
        success:(data)=>{
            ajaxloader.style.display='none';
            ajaxloader.parentElement.style.display='none';
            dataloader(dataView,data);
            dataloader(seconddataView,' ');
        }
         ,
        error:()=>{
            ajaxloader.style.display='none';
            dataloader(dataView,'<div class="alert alert-warning"> please check  the internet and try again! </div>');

        }
   })
})
}
if(!isNull(rejected)){
    rejected.addEventListener('click',()=>{
    ajaxloader.style.display='block';
    ajaxloader.parentElement.style.display='block';    
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{           
            rejected:1
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

//end driver
