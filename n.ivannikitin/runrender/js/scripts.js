$(function(){
    // Timers
    var timeLeft = new Date().getTime() + getSecondsToTomorrow();
    $('.timer__counter').countdown(timeLeft, function(event) {
        $(this).html(
            event.strftime('<span>%H</span><span>%M</span><span>%S</span>')
        );
    }).on('finish.countdown', function(){
        location.reload();
    });

    // Popup form
    $('.open-popup').magnificPopup({
        type:'inline'
    });

    // Image popups
    $('.popupImage').magnificPopup({
        type: 'image',
        gallery:{
            enabled:true
        }
    });

    /*setMenuFix($(window).scrollTop());
    $(window).scroll(function(){
        setMenuFix($(this).scrollTop());
    });*/
    
    // Send form
    $(document).on('click', 'input[type=submit]', function(e){
        e.preventDefault();
        var error = false;
        var name = $('.form').find('input[name=name]').val(),
            phone = $('.form').find('input[name=phone]').val(),
            email = $('.form').find('input[name=email]').val();

        $('.form').find('input[type=text]').each(function(){
            if($(this).val() == '') {
                $(this).addClass('error');
                error = true;
            }

            $('.error').focus(function(){
                $(this).removeClass('error');
            });
        });

        if(error)
            return false;

        $.ajax({
            url: '/runrender/register.php',
            method: 'post',
            data: {
                name: name,
                phone: phone,
                email: email
            }
        }).done(function(result){
            if(result == 'OK')
                formMessage('success', 'Спасибо! Заявка успешно отправлена.');
            else
                formMessage('error', 'Ошибка отправки заявки. Пожалуйста, попробуйте позже.');
        });
        return false;
    });
});

function formMessage(status, text) {
    $('.form').append('<div class="form__result" />');
    $('.form__result').addClass('form__result_' + status).text(text);
    $('.form__result').animate({display:'block'}, 4000, function(){
        $('.form').find('input[type=text]').each(function(){
            $(this).val('');
        });
        $(this).remove();
    });
}

function setMenuFix(scrollTop) {
    var $menu = $('.header__menu');
    if(scrollTop >= 100)
        $menu.addClass('header__menu_fix');
    else
        $menu.removeClass('header__menu_fix');
}

function getSecondsToTomorrow() {
    var seconds = Math.round((new Date()-new Date(1970,0,1,0))%(24*60*60*1000)/1000);
    return (24*60*60 - seconds) * 1000;
}