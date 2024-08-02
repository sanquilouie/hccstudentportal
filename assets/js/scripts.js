

$(document).ready(function(){

  $('#import_excel_enrollees').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url:"importEnrollees.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_enrollees')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });

  $('#import_excel_billing').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url:"import.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_billing')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });

  $('#import_excel_accounts').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url:"import2.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Importing...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_accounts')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Import');
      }
    })
  });

  $('.del-btn').on('click',function(e){
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
            title: 'Are you sure to delete this user?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
     })

     const flashdata = $('.flash-data').data('flashdata')
         if(flashdata){
            Swal.fire({
              icon: 'success',
              title: 'User Deleted Succesfully!',
              showConfirmButton: false,
              timer: 1500
             })
         }
});

$(document).ready(function(){
  // START CLOCK SCRIPT

Number.prototype.pad = function(n) {
  for (var r = this.toString(); r.length < n; r = 0 + r);
  return r;
};

function updateClock() {
  var now = new Date();
  var milli = now.getMilliseconds(),
    sec = now.getSeconds(),
    min = now.getMinutes(),
    hou = now.getHours(),
    mo = now.getMonth(),
    dy = now.getDate(),
    yr = now.getFullYear();
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var tags = ["mon", "d", "y", "h", "m", "s"],
    corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2)];
  for (var i = 0; i < tags.length; i++)
    document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
}

function initClock() {
  updateClock();
  window.setInterval("updateClock()", 1);
}

// END CLOCK SCRIPT
});
