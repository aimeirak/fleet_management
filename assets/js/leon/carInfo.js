
// car loader      
var dataView = document.getElementById('dataRetrival');
var carList = document.getElementById('carList');
var carId = document.getElementById('carId');

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
    $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            dataSent:1,
            carListOnly:1
        },
        success:(data)=>{
            dataloader(dataView,data);
        }
    })
})

:'';


// end car loader    
//if car is clicked 

var seconddataView = document.getElementById('data2Retrival');

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
        }
    });

    };


//end car clicked

//dirvers


var Avail = document.getElementById('availability');
var dailBook = document.getElementById('dailBook');
var rejected = document.getElementById('rejected');

if(!isNull(Avail)){
    Avail.addEventListener('click',()=>{
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
            carDriver:1,
            plate:1,
            list:1,
            plate:1,
            
        },
        success:(data)=>{
            dataloader(seconddataView,data);
            
        }
   })
})
}

if(!isNull(dailBook)){
    dailBook.addEventListener('click',()=>{
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{
           
            booking:1
        },
        success:(data)=>{
            dataloader(dataView,data);
            dataloader(seconddataView,' ');
        }
   })
})
}
if(!isNull(rejected)){
    rejected.addEventListener('click',()=>{
   $.ajax({
        url:'cars_fluid/cardailydata.php',
        method:'POST',
        data:{           
            rejected:1
        },
        success:(data)=>{
            dataloader(dataView,data);
            dataloader(seconddataView,' ');
        }
   })
})
}
//end driver
