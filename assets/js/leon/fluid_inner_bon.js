var contentW = document.getElementById('page-inner');
var adddep = document.getElementById('adddep');
var addDestin = document.getElementById('addDestin');
var ajaxloader = document.getElementById('ajax-loader');
adddep != null?
adddep.addEventListener('click',()=>{
    $.ajax({
        url:'include/forms/addforms.php',
        method:'POST',
        data:{
            addplace:1,
            departure:1
        },
        success:(data)=>{
            contentW.innerHTML = data;            
        },
        dataType:'text'
        
    })

})

:'';
addDestin != null ?
addDestin.addEventListener('click',()=>{
    $.ajax({
        url:'include/forms/addforms.php',
        method:'POST',
        data:{
            addplace:1,
            destination:1
        },
        success:(data)=>{
            contentW.innerHTML = data;            
        },
        dataType:'text'
        
    })
})


:'';
