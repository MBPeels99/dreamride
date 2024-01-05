$(function() {
  
    // contact form animations
    $('#add_child_account').click(function() {
      $('#registerChild').fadeToggle();
    })
    $(document).mouseup(function (e) {
      var container = $("#contactForm");
  
      if (!container.is(e.target) // if the target of the click isn't the container...
          && container.has(e.target).length === 0) // ... nor a descendant of the container
      {
          container.fadeOut();
      }
    });
    
  });
  
  // Profile photo
  
  $(document).ready(function() {
  
      
      var readURL = function(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
  
              reader.onload = function (e) {
                  $('.profile-pic').attr('src', e.target.result);
              }
      
              reader.readAsDataURL(input.files[0]);
          }
      }
      
  
      $(".file-upload").on('change', function(){
          readURL(this);
      });
      
      $(".upload-button").on('click', function() {
         $(".file-upload").click();
      });
  });