$(function($, undefined) {


  $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
/*
  $('#logout').click(function(e){
    e.preventDefault();

    var seja=$.session.get();
    alert(seja);
    $_SESSION.destroy();
    var url="index.php/?c=login&a=login";

    $.post(url).done(function(dataBack) {
         // location.reload();
        }
    );
    
  });
/*

  $('#login-submit').click(function(){
    var current=$(this);
    var url="index.php/?c=login&a=login";

    var data = {
      'username' : $('input[name="username"]').val(),
      'password' : $('input[name="password"]').val()
    };
    $.post(url, data).done(function(dataBack) {
        location.reload();
      }
    );

*/







});





