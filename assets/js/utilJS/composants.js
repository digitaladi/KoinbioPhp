$(document).ready(function(){

    $(window).scroll(function(){
        var st = $(this).scrollTop();
        if(st >= 100){
            $("#nav_float").css('display', 'block');
            // alert(st);
        }else{
            $("#nav_float").css('display', 'none');
            // alert(st);
        }
    });


   // alert(st);

});

