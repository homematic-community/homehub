/* Put your customm JS here */
$( document ).ready(function() {
  $.get( "http://192.168.2.50:50000/tasker=Wiederleise", function( data ) {
  });
});

$(window).on('beforeunload', function(){
     $.get( "http://192.168.2.50:50000/tasker=Lautstark", function( data ) {});
});
