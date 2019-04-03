$(document).ready(function(){

    // Hide Placeholder on  Form Focus

    $('[placeholder]').focus(function () {
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function () {
       $(this).attr('placeholder',$(this).attr('data-text'));
    });

    // Toggle Hide Show Latest Panel 
    $(".toggle-info").click(function(){
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
        if ($(this).hasClass('selected')) {
            $(this).html('<i class="fa fa-minus pull-right  "></i>');
        }else{
            $(this).html('<i class="fa fa-plus pull-right  "></i>');
        }
    });
    // convert password field to text Field when hover 
    var $passFiled = $('.password');
    $('.show-pass').hover(function(){
    		$passFiled.attr('type','text');
    },function(){
    		$passFiled.attr('type','password');
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


    // Hide And Show Category Information 

    $('.category h3').click(function(){
        $(this).next('.hideShowInfo').fadeToggle(200);
    })

    // Show nice Message Error On Empty Reccord 

    $(".niceMessage").each(function(){
        $(this).animate({
            left:0
        },500);
    });

    // Show And Hide Content Language 
    $('.langChoix').click(function(){
            $('.contentlang').fadeToggle();
    });

    // plugin data table 

    $(".table").DataTable({
        paging: true,
        ordering:  false,
        responsive: true,
    });

    

});