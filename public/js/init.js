$(document).ready(function(){

  $('.selection.dropdown').dropdown();
  $('.progress').progress();

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
