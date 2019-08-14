$(document).ready(function(){

  $('.selection.dropdown').dropdown();
  $('.progress').progress();
  $('.sandwich').on('click', function(){
    console.log('test');
    $('.ui.sidebar').sidebar('toggle');
  });

  $('.menu .item').tab();

  $('.ui.modal').modal();

  $('#login-button').on('click', function(){
    $('#login-modal').modal('show');
  });

});
