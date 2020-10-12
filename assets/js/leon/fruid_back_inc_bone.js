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
 if(!isNull(newSub)){
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
 }
 

 var newCaptain =  document.getElementById("newCaptain");
 if(!isNull(newCaptain)){
    newCaptain.addEventListener('click',()=>{
        $.ajax({
            url:'include/forms/addforms.php',
            method:'POST',
            data:{
               aut:1,
               new:'at' 
            },
            success:(data)=>{
               dataloader(dataView,data);               
            }
        })
     })
 }



task.forEach((card)=>{
    card.addEventListener('click',()=>{
        var data1 = document.getElementById('dataRetrival');
        var data2 = document.getElementById('data2Retrival');  
       
     })   
   
 })
function prog(mine){
   var place =  document.getElementById(`${mine}`);
   var b = place.getAttribute('data-tank');
   var dt = place.getAttribute('dt-y');
   var t = dt.slice(0,4);
   dataloader(dataView,`
   
   <div class="col-12 mt-4">
   <div class="card shadow mb-4">
     
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
       <h6 class="m-0 font-weight-bold text-primary">the whole year(${t}) progress</h6>
       
     </div>
 
     <div class="card-body">
       <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
         <canvas id="myAreaChart" style="display: block; width: 181px; height: 160px;" width="362" height="320" class="chartjs-render-monitor"></canvas>
       </div>
       <div class="row mt-3">

      <div class="col-6 col-sm-4 mb-2" id=''>
        <div class="card border-left-success shadow h-100 ">
           <div class="card-body">
             <sup class="badge badge-success">All booking</sup>
            </div>               
          </div>
        </div>  
        
        <div class="col-6  col-sm-4  mb-2" id=''>
        <div class="card border-left-danger shadow h-100 ">
           <div class="card-body">
             <sup class="badge badge-danger">Rejected</sup>
            </div>               
          </div>
        </div> 

        <div class="col-6 col-sm-4   mb-2" id=''>
        <div class="card  border-left-warning shadow h-100 ">
           <div class="card-body">
             <sup class="badge badge-warning">Canceled</sup>
            </div>               
          </div>
        </div>  

        <div class="col-6 col-sm-4  mb-2" id=''>
        <div class="card border-left-primary shadow h-100 ">
           <div class="card-body">
             <sup class="badge badge-primary">Done</sup>
            </div>               
          </div>
        </div>  

       
        
      


  </div>
     </div>

   </div>
 </div>

 `); 
  $.ajax({
    url:'cars_fluid/driverfluid.php',
    method:'POST',
    data:{
      mo:1,
      d:b,
      db:dt      
    },
    dataType:'json',
    success:(response)=>{
     console.log(response);
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : + number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    
    datasets: [
      {
        label: "Allbook",
        lineTension: 0.2,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "#1cc88a",
        pointRadius: 3,
        pointBackgroundColor: "#1cc88a",
        pointBorderColor: "#1cc88a",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "#1cc88a",
        pointHoverBorderColor: "brown",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data:response.allBook,
      },
      {
      
      label: "Done",
      lineTension: 0.2,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: response.done,
    },
    {
      label: "Rejects",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "#e74a3b",
      pointRadius: 3,
      pointBackgroundColor: "#e74a3b",
      pointBorderColor: "#e74a3b",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "#e74a3b",
      pointHoverBorderColor: "brown",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data:response.rejected,
    },
    {
      label: "Canceled",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "#f6c23e",
      pointRadius: 3,
      pointBackgroundColor: "#f6c23e",
      pointBorderColor: "#f6c23e",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "#f6c23e",
      pointHoverBorderColor: "#1cc88a",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data:response.canceled,
    }
    
  ]
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 20,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 6,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'range' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

    }
  });

}
 