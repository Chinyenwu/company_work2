

$(document).ready(function(){
  
$(".member").click(function(){
    $( ".memberl" ).toggle(); 
});

$(".member2").click(function(){  
    $( ".member3" ).toggle();
});

$(".member4").click(function(){  
    $( ".member5" ).toggle();
});

$(".member6").click(function(){  
    $( ".member7" ).toggle();
});

$("#staff").click(function(){
    $( "#staff2" ).show();
    $( "#teacher2").hide();
});

$("#teacher").click(function(){
    $( "#staff2" ).hide();
    $( "#teacher2").show(); 
});

$("#all").click(function(){
    $( "#staff2" ).show();
    $( "#teacher2").show(); 
});

//CKEDITOR.replace( "editor1" );
});