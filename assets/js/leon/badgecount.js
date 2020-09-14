function loadNote(dt = '',view = ''){
  var note =  document.querySelector('.note');
  if(note != null){

  
  $.ajax({
      url:'notification_lead/note.php',
      method:'post',
      data:{
          data:dt,
          view:view
      },
      dataType:'json',
      success:(data)=>{
       
          $('.alert-field').html(data.note);
          if(data.count > 0){
            $('.note').html(data.count);
            note.classList.add('d-block');

             if(data.count >= 5){
              $('.note').html(data.count +'<sup>+</sup>');           
            }

          }   
         else{       
          note.classList.remove('d-block');          
          note.classList.add('d-none');
    
         }
      }
  })
}
}

loadNote();
setInterval(()=>{
    loadNote()
  }    ,5000);

