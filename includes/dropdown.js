$(document).ready(function () {

$(".dropbtn").click(function(){
if($('.dropdown-content').is(':visible')){
  $('.dropdown-content').slideUp(150);
} else {
  $('.dropdown-content').slideDown(150);
}
});
$('body').mousedown(function (event) {
  event.stopPropagation();
  $('.dropdown-content').slideUp(150);
});
$(window).on('resize', function(){
  var win = $(this); //this = window
  if (win.height() >= 800) {
    $('.dropdown-content').hide(0);
  }
});
});