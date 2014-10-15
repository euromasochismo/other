$(document).ready(function($) {
  
  sliderInit();
  
})

var first = $("#first");
var second = $("#second");
var interval = 15000;

second.hide();

function sliderInit() {

  generate();
  setInterval(function () {
    generate();
  }, interval);

}

function generate() {

  $.getJSON('../generate', function(data) {
    // console.log(data);
    // FRASE
    second.children('h2').html(data.phrase);
    // SFONDO
    $('body').css('background-color', '#'+data.color);
    animateLeft(first, second);
    var tmp = first;
    first = second;
    second = tmp;
  })

}

function animateLeft(src, tgt){
  var parent = src.parent();
  var width = parent.width();
  var srcWidth = src.width();
  
  src.css({position: 'absolute'});
  tgt.hide().appendTo(parent).css({left: width, position: 'absolute'});
  
  src.animate({left : -width}, 500, function(){
    src.hide();
    src.css({left: null, position: null});
  })
  tgt.show().animate({left: 0}, 500, function(){
    tgt.css({left: null, position: null});
  })
}