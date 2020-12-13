$(document).ready(function(){

    $(window).scroll(function(){
        $first_wrap_h = $('.color-kaki-koin');
        $nav_float = $("#nav_float");
        $wrap_hambourger = $('.wrap-hambuger');
        $wrap_connect = $('.wrap_connect');
        var st = $(this).scrollTop();
        if(st >= 100){
            $nav_float.css('display', 'block');
            //$nav_float.css('z-index', 10);
            $wrap_hambourger.css('top', '35%');
            $wrap_connect.css('top', '35%');
            $nav_float.append($wrap_hambourger);
            $nav_float.append($wrap_connect);
            // alert(st);
        }else{
            $wrap_hambourger.css('top','2%');
            $wrap_connect.css('top','2%');
            $first_wrap_h.append($wrap_hambourger);
            $first_wrap_h.append($wrap_connect);
            $nav_float.css('display', 'none');
            // alert(st);
        }
    });

    $('.wrap-hambuger').click(function (){
      $wrap_nav =  $("#responsive_wrap_nav");
        if($wrap_nav.css('display') === 'none'){
            $(this).children('i').removeClass('fa-bars');
            $(this).children('i').addClass('fa-times');
                $wrap_nav.show();
            console.log("afficher");
        }else{
            $(this).children('i').removeClass('fa-times');
            $(this).children('i').addClass('fa-bars');
            $wrap_nav.hide();
        }

    });


   // alert(st);

});

