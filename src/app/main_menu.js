document.addEventListener("DOMContentLoaded", function() {
    // Get the hamburger menu element
    var hamburger = document.querySelector('.hamburger');
  
    // Get the mobile menu element
    var mobileMenu = document.querySelector('.mobile-menu');
  
    // Toggle the active class on hamburger click
    hamburger.addEventListener('click', function() {
      mobileMenu.classList.toggle('active');
    });
  });