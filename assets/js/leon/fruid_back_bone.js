var sub      = document.getElementById('allow_me_bone');
var response = document.getElementById('response');
var password = document.getElementById('inputPassword');
var username = document.getElementById('username');

if(sub !== null){
sub.addEventListener('click',()=>{
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
       success:(data)=>{
        response.innerHTML = data;
        
        setInterval(() => {
            location.reload();
        }, 2000);
       },
       dataType:'text'
   })
});
}


