var sub      = document.getElementById('allow_me_bone');
var response = document.getElementById('response');
var password = document.getElementById('inputPassword');
var username = document.getElementById('username');
var progress = document.getElementById('progress');
var logcontent = document.getElementById('log-content');

if(sub !== null){
sub.addEventListener('click',(e)=>{
    e.preventDefault();
    logcontent.classList.add('d-none');  
        sub.classList.remove('btn-info'); 
        sub.classList.add('btn-default');        
        progress.classList.remove('d-none');    
    usernamev = username.value;
    passwordv = password.value;
    
    $.ajax({
       url:'include/action.php',
       method:'POST',
       data:{
           run: 1,
           userName: usernamev,
           passWord: passwordv  
       },
       beforeSend:()=>{
        logcontent.classList.add('d-none');  
        sub.classList.remove('btn-info'); 
        sub.classList.add('btn-default');        
        progress.classList.remove('d-none');       
       },       
       complete:()=>{
        progress.classList.add('d-none');
       },
       success:(data)=>{
        logcontent.classList.remove('d-none');
        progress.classList.add('d-none'); 
        sub.classList.add('btn-info');
        response.innerHTML = data;        
        setInterval(() => {
            location.reload();
        }, 2000);
       },
       dataType:'text',
       error:()=>{
        sub.classList.add('btn-info');
        logcontent.classList.remove('d-none');
        progress.classList.add('d-none'); 
        setInterval(() => {
            location.reload();
        }, 2000);
        response.innerHTML = '<div class="alert alert-warning " > please try again make sure you have internet</div>' ;
    }

   })
});
}


