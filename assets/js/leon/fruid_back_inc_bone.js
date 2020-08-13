function newcompanydroped(cname,tnumber,location,cEmail,report){
    var cnameV= cname.value;
    var tnumberV= tnumber.value;
    var locationV= location.value;
    var cemailV= cEmail.value;
    if(cnameV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">PLease provide company name </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);   
    }
    else if(tnumberV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900"> Tin number is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },3000);
    }
    else if(locationV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">Company location is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);
    }
    else if(cemailV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">Company email is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);
    }
    else{
        $.ajax({
            url:'companyLead/leadCump.php',
            method:'POST',
            data:{
                comName:cnameV,
                tinNum:tnumberV,
                location:locationV,
                comEmail:cemailV,
                ins:1
            },
            success:(data)=>{
                 setInterval(()=>{
                    dataloader(dataView,data);
                    location.reload();
                },2000); 
                          
            }
        })
    }

}
function newsubcompanydroped(subcname,company,tnumber,location,cEmail,report){
    var cnameV= subcname.value;
    var companyV= company.value;
    var tnumberV= tnumber.value;
    var locationV= location.value;
    var cemailV= cEmail.value;
    if(cnameV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">PLease provide company name </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);   
    }
    else if(companyV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900"> Please select company</div>');
        setInterval(()=>{
            dataloader(report,' ')
        },3000);
    }
    else if(tnumberV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900"> Tin number is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },3000);
    }
    
    else if(locationV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">Company location is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);
    }
    else if(cemailV.trim() == ''){
        dataloader(report,'<div class="alert alert-danger p-4 text-gray-900">Company email is empty </div>');
        setInterval(()=>{
            dataloader(report,' ')
        },2000);
    }
    else{
        $.ajax({
            url:'companyLead/leadCump.php',
            method:'POST',
            data:{
                Company:companyV,
                subName:cnameV,
                tinNum:tnumberV,
                location:locationV,
                comEmail:cemailV,
                ins:1
            },
            success:(data)=>{
                 setInterval(()=>{
                    dataloader(dataView,data);
                    window.open('uiupdate.php','_self');
                },2000); 
                          
            }
        })
    }

}
var newCompany = document.getElementById('newCompany');
if(!isNull(newCompany)){
     newCompany.addEventListener('click',()=>{
         $.ajax({
             url:'include/forms/addforms.php',
             method:'POST',
             data:{
                 formId:2,
                 new:'co'  
             },
             success:(data)=>{
                dataloader(dataView,data);
                var companyName = document.getElementById("companyName");
                var tinNumber = document.getElementById("tinNumber");
                var location = document.getElementById("location");
                var compEmail = document.getElementById("compEmail");
                var save = document.getElementById("drop-me-on");
                var ms = document.getElementById("ms");
                save.addEventListener('click',()=>{
                    newcompanydroped(companyName,tinNumber,location,compEmail,ms);
                    
                })
             }
         })
     }) 
}
var task = document.querySelectorAll('#task .card');
 task.forEach((card)=>{
    card.addEventListener('mouseover',()=>{
         card.classList.add('shadow-lg');
       
     })
    
     card.addEventListener('mouseout',()=>{
        card.classList.remove('shadow-lg');      
    })
 })

 var newSub = document.getElementById('newSub');
 newSub.addEventListener('click',()=>{
     $.ajax({
         url:'include/forms/addforms.php',
         method:'POST',
         data:{
            formId:1,
            new:'su' 
         },
         success:(data)=>{
            dataloader(dataView,data);
                var subcompanyName = document.getElementById("subcompanyName");
                var company = document.getElementById("company");
                var tinNumber = document.getElementById("tinNumber");
                var location = document.getElementById("location");
                var compEmail = document.getElementById("compEmail");
                var save = document.getElementById("drop-me-on");
                var ms = document.getElementById("ms");
                save.addEventListener('click',()=>{
                    newsubcompanydroped(subcompanyName,company,tinNumber,location,compEmail,ms);
                    
                })
         }
     })     
 })
