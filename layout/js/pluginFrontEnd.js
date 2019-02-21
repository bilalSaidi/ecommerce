$(document).ready(function(){

    // Hide Placeholder on  Form Focus

    $('[placeholder]').focus(function () {
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function () {
       $(this).attr('placeholder',$(this).attr('data-text'));
    });

    
    // Add asterisk on Requierd Field 
    
    $('input').each(function(){
        if ($(this).attr("required") == "required") {
            $(this).after("<span class='asterisk'>*</span>")
        }
    }) 

    // Show Message Confirm When Click Button Delete Member 
    $('.confirm').click(function(){
    	return confirm('Are You Sure ?');
    })


    // Show And Hide Form Login SignUp
    $(".loginAccount h1 span").click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $(".loginAccount form").fadeOut(0);
        $("." +  $(this).data('class')  ).fadeIn(200);
    });


    $(".Live-Name").keyup(function(){
        $(".Live-preview .caption h3").text($(this).val());
    });
    $(".Live-Desc").keyup(function(){
        $(".Live-preview .caption p").text($(this).val());
    });
    $(".Live-Price").keyup(function(){
        $(".Live-preview .priceTag ").text("$" + $(this).val());
    });

      // Shuffle Images 
    var ZindexVal = 0;
    $(".cards .card").on('click',function(){

      $(this).animate({

        left:'80%',
        marginTop : 30

      } ,400 , function(){ // calBack Function 

           ZindexVal--;

           $(this).css('z-index',ZindexVal);

      }).animate({
      
          left : $(this).css('left'),
          marginTop : 0


      },400);

    });


    

});