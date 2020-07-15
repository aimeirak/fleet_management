var allBookings = document.getElementById('AllBookings');
var bookRide    = document.getElementById('bookRide');
var OurCars     = document.getElementById('OurCars');
var MyBookings  = document.getElementById('MyBookings');
var tablel      = document.querySelector('.table');

var NewPlace   = document.getElementById('NewPlace');
var LocateCars = document.getElementById('LocateCars');
var avaible    = document.getElementById('avaible');
var OurRouts   = document.getElementById('OurRouts'); 
var playground = document.getElementById('page-ground'); 
var returnBack = document.getElementById('returnB');
var Profile    = document.getElementById('Profile');
var go         = document.getElementById('go');
function goBack() {
    window.history.back();
    }
//= retubutton is clicked 
returnBack != null ? returnBack.addEventListener('click',()=>{
    goBack();
}) :console.log();
//======

function  changePlayground(ground,mvalue){        
    ground != null ? ground.innerHTML = mvalue : console.log() ;      
}  
        

allBookings != null ? allBookings.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/allbookings.php',
        method:'POST',
        data:{
            allbooking:1
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen go is clicked           

               
        },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


Profile != null ? Profile.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/edituser.php',
        method:'POST',
        data:{
            Profile:1
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen go is clicked
            
        },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


bookRide != null ? bookRide.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/booking.php',
        method:'POST',
        data:{
            book:1
        },
        success:(data)=>{
            changePlayground(playground,data);
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen our cars is clicked
OurCars != null ? OurCars.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/carlist.php',
        method:'POST',
        data:{
            carlist:1
        },
        success:(data)=>{
            changePlayground(playground,data);
            // setInterval(() => {
            //     tablel.reload();
            // }, 600);
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();



//wen our routs is clicked
OurRouts != null ? OurRouts.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/distance.php',
        method:'POST',
        data:{
            OurRouts:1,
            count:10
        },
        success:(data)=>{
            changePlayground(playground,data);
            // setInterval(() => {
            //     tablel.reload();
            // }, 600);
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen MyBookings is clicked
MyBookings != null ? MyBookings.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/bookinglist.php',
        method:'POST',
        data:{
            MyBookings:1,
            count:10
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen go is clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();



//wen NewPlace is clicked
NewPlace != null ? NewPlace.addEventListener('click',()=>{
    
    playground != null ? 
    $.ajax({
        url:'tasks/place.php',
        method:'POST',
        data:{
            NewPlace:1,
            count:10
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen registerPlace clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen NewPlace is clicked
LocateCars != null ? LocateCars.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/carlocation.php',
        method:'POST',
        data:{
            LocateCars:1,
            count:10
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen plaque clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen NewPlace is clicked
avaible != null ? avaible.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/placelist.php',
        method:'POST',
        data:{
            placeList:1,
            count:10
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen plaque clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();




avaible != null ? avaible.addEventListener('click',()=>{
    console.log('avaible') 
})  : console.log();




//======================================
//==================


var allBookings1 = document.getElementById('AllBookings1');
var bookRide1    = document.getElementById('bookRide1');
var OurCars1     = document.getElementById('OurCars1');
var MyBookings1 = document.getElementById('MyBookings1');
var tablel1      = document.querySelector('.table');

var NewPlace1   = document.getElementById('NewPlace1');
var LocateCars1 = document.getElementById('LocateCars1');
var avaible1    = document.getElementById('avaible1');
var OurRouts1   = document.getElementById('OurRouts1'); 
var playground1 = document.getElementById('page-ground'); 
var returnB1ack1 = document.getElementById('returnB1');
var Profile1   = document.getElementById('Profile1');
var go1         = document.getElementById('go1');
function go1Back() {
    window.history.back();
    }
//= retubutton is clicked 
returnB1ack1 != null ? returnB1ack1.addEventListener('click',()=>{
    goBack();
}) :console.log();
//======

function  changeplayground1(ground,mvalue){        
    ground != null ? ground.innerHTML = mvalue : console.log() ;      
}  
        

allBookings1 != null ? allBookings1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/allBookings.php',
        method:'POST',
        data:{
            allbooking:1
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            //wen go1 is clicked
            
            if(go != null){
                go.addEventListener('click',()=>{
                    go1Back();
                })

            }

            
        },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();




bookRide1 != null ? bookRide1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/booking.php',
        method:'POST',
        data:{
            book:1
        },
        success:(data)=>{
            changeplayground1(playground1,data);
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


Profile1 != null ? Profile1.addEventListener('click',()=>{
    playground != null ? 
    $.ajax({
        url:'tasks/edituser.php',
        method:'POST',
        data:{
            Profile:1
        },
        success:(data)=>{
            changePlayground(playground,data);
            //wen go is clicked
            
        },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen our cars is clicked
OurCars1 != null ? OurCars1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/carlist.php',
        method:'POST',
        data:{
            carlist:1
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            // setInterval(() => {
            //     tablel1.reload();
            // }, 600);
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();



//wen our routs is clicked
OurRouts1 != null ? OurRouts1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/distance.php',
        method:'POST',
        data:{
            OurRouts:1,
            count:10
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            // setInterval(() => {
            //     tablel1.reload();
            // }, 600);
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen MyBookings1 is clicked
MyBookings1 != null ? MyBookings1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/bookinglist.php',
        method:'POST',
        data:{
            MyBookings:1,
            count:10
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            //wen go1 is clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();





//wen NewPlace1 is clicked
LocateCars1 != null ? LocateCars1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/carlocation.php',
        method:'POST',
        data:{
            LocateCars:1,
            count:10
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            //wen plaque clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();


//wen NewPlace1 is clicked
avaible1 != null ? avaible1.addEventListener('click',()=>{
    playground1 != null ? 
    $.ajax({
        url:'tasks/placelist.php',
        method:'POST',
        data:{
            placeList:1,
            count:10
        },
        success:(data)=>{
            changeplayground1(playground1,data);
            //wen plaque clicked
           
           },
        dataType:'text'
    })
    : console.log() ; 
}) : console.log();




avaible1 != null ? avaible1.addEventListener('click',()=>{
    console.log('avaible1') 
})  : console.log();
