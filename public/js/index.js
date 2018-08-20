$num = $('.my-card').length;
$even = $num / 2;
$odd = ($num + 1) / 2;

if ($num % 2 == 0) {
  $('.my-card:nth-child(' + $even + ')').addClass('active');
  $('.my-card:nth-child(' + $even + ')').prev().addClass('prev');
  $('.my-card:nth-child(' + $even + ')').next().addClass('next');
} else {
  $('.my-card:nth-child(' + $odd + ')').addClass('active');
  $('.my-card:nth-child(' + $odd + ')').prev().addClass('prev');
  $('.my-card:nth-child(' + $odd + ')').next().addClass('next');
}
$(document).on('click','.my-card',function() {
    if($('.my-card').index(this) == $num - 1 ){
    $mycard =$('.my-card')[0];
    $mycardHTML = $('.my-card')[0].outerHTML;
    $('.card-carousel').append($mycardHTML);
    $mycard.remove();
    $slide = $('.card-carousel .active').width();
    $('.card-carousel').stop(false, true).animate({left: '+=' + $slide});
  }
  if($('.my-card').index(this) == 0 ){
    $mycard =$('.my-card')[$num - 1];
    $mycardHTML =$mycard.outerHTML;
    $('.card-carousel').prepend($mycardHTML);
    $mycard.remove();
    $slide = $('.card-carousel .active').width();
    $('.card-carousel').stop(false, true).animate({left: '-=' + $slide});
  }
});
$(document).on('click','.my-card',function() {
  $slide = $('.card-carousel .active').width();
  if ($(this).hasClass('next')) {
    $('.card-carousel').stop(false, true).animate({left: '-=' + $slide});
  } else if ($(this).hasClass('prev')) {
    $('.card-carousel').stop(false, true).animate({left: '+=' + $slide});
  }
  
  $(this).removeClass('prev next');
  $(this).siblings().removeClass('prev active next');
  $(this).addClass('active');
  $(this).prev().addClass('prev');
  $(this).next().addClass('next');

});

$(document).on('click','.bnt-prev',function() {
    $('.card-carousel .prev').click();
});

$(document).on('click','.bnt-next', function(){
  $('.card-carousel .next').click();
});
//
showSlides(); 
//
function showSlides(){
  if($('.my-card').index($('.card-carousel .next')) == $num - 1 ){
    $mycard =$('.my-card')[0];
    $mycardHTML = $('.my-card')[0].outerHTML;
    $('.card-carousel').append($mycardHTML);
    $mycard.remove();
    $slide = $('.card-carousel .active').width();
    $('.card-carousel').stop(false, true).animate({left: '+=' + $slide});
  }
  //
  $slide = $('.card-carousel .active').width();
  $this = $('.card-carousel .next');
  //
  if ($this.hasClass('next')) {
    $('.card-carousel').stop(false, true).animate({left: '-=' + $slide});
  } else if ($this.hasClass('prev')) {
    $('.card-carousel').stop(false, true).animate({left: '+=' + $slide});
  }
  //
  $this.removeClass('prev next');
  $this.siblings().removeClass('prev active next');
  $this.addClass('active');
  $this.prev().addClass('prev');
  $this.next().addClass('next');
  //
  setTimeout(showSlides, 3000);
}
// Keyboard nav
$('html body').keydown(function(e) {
  if (e.keyCode == 37) { // left
    $('.active').prev().trigger('click');
  }
  else if (e.keyCode == 39) { // right
    $('.active').next().trigger('click');
  }
});
