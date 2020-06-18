// Login Register dropdown toggle
$('.login-register-toggle').hover(function(){
  if($('.language-dropdown').hasClass('show')){
    $(".language-dropdown").removeClass('show');
  }
$(".login-register-dropdown").addClass('show');

})


// Language dropdown toggle
$('.language-toggle').hover(function(){
  if($('.login-register-dropdown').hasClass('show')){
    $(".login-register-dropdown").removeClass('show');
  }
  $(".language-dropdown").addClass('show');
  })


// Click out side function
$(window).click(function() {
  if($('.login-register-dropdown').hasClass('show')){
    $(".login-register-dropdown").removeClass('show');
  }
  if($('.language-dropdown').hasClass('show')){
    $(".language-dropdown").removeClass('show');
  }

  });