
  
  // Profile photo
  
  $(document).ready(function() {
  
  
 
    console.log("loading");
	 //$(document).on('click', '#add_child_account', function() { alert("hello"); });
	 
	 
    // contact form animations
    //$('#add_child_account').click(function() {
	 // console.log("here");
    //  $('#registerChild').fadeToggle();
    //})
	
	$(document).on('click', '#add_child_account', function() { 
	    //alert("hello"); 
		$('#registerChild').fadeToggle();
	});
	
    $(document).mouseup(function (e) {
      var container = $("#contactForm");
  
      if (!container.is(e.target) // if the target of the click isn't the container...
          && container.has(e.target).length === 0) // ... nor a descendant of the container
      {
          container.fadeOut();
      }
    });
    
  
  
      
      
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