function loadNote(dt = '',view = ''){
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
          }
         
      }
  })
}

loadNote();
setInterval(()=>{
    loadNote()
  }
    ,5000);