$(document).ready(function(){

  $('.selection.dropdown').dropdown();
  $('.progress').progress();
  $('.sandwich').on('click', function(){
    console.log('test');
    $('.ui.sidebar').sidebar('toggle');
  });

  $('.menu .item').tab();

  $('.browse').popup({
    inline     : true,
    hoverable  : true,
    position   : 'bottom left',
    delay: {
      show: 300,
      hide: 800
    }
  })
;

});
