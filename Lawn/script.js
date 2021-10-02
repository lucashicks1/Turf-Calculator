$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
    }, 900, function(){

        window.location.hash = hash;
      });
    } // End if
  });
});

$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
