$(document).ready(function() {
    var slideWidth = $('.gallery-container').width() / 5;
    var sliderWidth = $('.photos img').length * slideWidth;
    var currentIndex = 0;
    
    $('.photos').css('width', sliderWidth);
    
    $('.arrow-left').click(function() {
      if (currentIndex > 0) {
        currentIndex--;
        var translateX = -currentIndex * slideWidth;
        $('.slider').css('transform', 'translateX(' + translateX + 'px)');
      }
    });
    
    $('.arrow-right').click(function() {
      if (currentIndex < $('.photos img').length - 5) {
        currentIndex++;
        var translateX = -currentIndex * slideWidth;
        $('.slider').css('transform', 'translateX(' + translateX + 'px)');
      }
    });
    
    $(window).resize(function() {
      slideWidth = $('.gallery-container').width() / 5;
      sliderWidth = $('.photos img').length * slideWidth;
      currentIndex = 0;
      $('.photos').css('width', sliderWidth);
      $('.slider').css('transform', 'translateX(0)');
    });
  });