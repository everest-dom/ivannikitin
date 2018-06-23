$(function(){

    // Убираем белую подложку над видео-потоком
    setTimeout(function(){
        $('.video-splash').fadeOut(700);
        return false;
    }, 10000);

    // Сохранение номера телефона для оповещения
    var sendPhoneButtonClass = '.send-phone-button',
        $form = $('.send-phone-form'),
        $phoneField = $('.send-phone-field');
    $(document).on('click', sendPhoneButtonClass, function(){
        $.ajax({
            url: '/ao/onaircallme_nw17.php',
            data: {
                save_phone: 1,
                today: 1,
                phone: $phoneField.val()
            }
        }).done(function(answer){
            $form.html('<span class="phone-sent-message">Спасибо! Мы вышлем Вам смс перед началом вебинара.</span>');
        });
        return false;
    });

});