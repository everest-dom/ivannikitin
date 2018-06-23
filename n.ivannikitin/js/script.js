$(function(){

    // The main menu
    $(document).on('click', '.menu__collapser', function () {
       var $menuCollapser = $(this),
           $menuList = $('.menu__list');

       $menuList.fadeToggle(300);
       return false;
    });

    // popups
    $('.run_popup').magnificPopup({
        type:'inline',
        midClick: true
    });

    // videos
    $('.blog-item__image_button_video').magnificPopup({
        type: 'iframe'
    });

    // images
    $('.image_popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled:true
        }
    });

    // slider
    var $slider = $('.slider'),
        $sliderList = $('.slider__list'),
        $sliderItem = $('.slider__item'),
        $sliderArrow = $('.slider__arrow'),
        $sliderPaginationItem = $('.slider__pagination-item');

    var itemCount = $sliderItem.length,
        currentPosition,
        nextPosition;

    // Устанавливаем ширину элементов
    setSliderItemWidth();

    setSliderCurrentItem();

    // Функции стрелок
    $sliderArrow.click(function () {
        if($(this).hasClass('slider__arrow_left'))
        // Листаем влево
        {
            // Определяем следующий элемент
            currentPosition = $slider.data('current');
            nextPosition = getNextIndex('prev', currentPosition);

            // Запоминаем его
            $slider.data('current', nextPosition);

            // Показываем элемент
            setSliderPositionByIndex(nextPosition);

            // Фиксируем активность пагинации
            setSliderPagination(nextPosition);
        }
        else
        // Листаем вправо
        {
            // Определяем следующий элемент
            currentPosition = $slider.data('current');
            nextPosition = getNextIndex('next', currentPosition);

            // Запоминаем его
            $slider.data('current', nextPosition);

            // Показываем элемент
            setSliderPositionByIndex(nextPosition);

            // Фиксируем активность пагинации
            setSliderPagination(nextPosition);
        }
    });

    // Функции пагинации
    $sliderPaginationItem.click(function () {
       var index = $(this).index() + 1;
       if($slider.data('current') == index)
           return false;

        // Запоминаем индекс
        $slider.data('current', index);

        // Показываем элемент
        setSliderPositionByIndex(index);

        // Фиксируем активность пагинации
        setSliderPagination(index);
    });

    var sliderInt;

    sliderInt = setSliderAuto();

    $sliderItem.hover(function () {
       clearInterval(sliderInt);
    }, function () {
        sliderInt = setSliderAuto();
    });

    $(window).resize(function () {
        setSliderItemWidth();
        setSliderPosition();
        setSliderCurrentItem();
    });

    // flying menu init
    var closerClass = '.flying-menu__closer',
        closerClosedClass = '.flying-menu__closer_closed',
        flyingMenuClass = '.flying-menu';

    function correctFlyingMenuPosition()
    {
        var top = $(document).scrollTop();
        if (top < 150)
            $(flyingMenuClass).removeClass('fixed');
        else
            $(flyingMenuClass).addClass('fixed');
    }
    function correctFlyingMenuHeight()
    {
        var windowHeight = $(window).height(),
            menuHeight = $(flyingMenuClass).removeClass('scroll').height();

        if(windowHeight <= menuHeight)
        {
            $(flyingMenuClass).addClass('scroll');
        }
        else
        {
            $(flyingMenuClass).removeClass('scroll');
        }
    }
    function collapseFlyingMenu()
    {
        var $closer = $(closerClass),
            $menu = $closer.closest(flyingMenuClass);

        $closer.text("Меню").addClass(closerClosedClass.replace('.', ''));
        $menu.addClass('unbordered').find('ul').fadeOut(50);

        correctFlyingMenuHeight();
    }
    function uncollapseFlyingMenu()
    {
        var $closer = $(closerClass),
            $menu = $closer.closest(flyingMenuClass);

        $closer.text("").removeClass(closerClosedClass.replace('.', ''));
        $menu.removeClass('unbordered').find('ul').fadeIn(600);

        correctFlyingMenuHeight();
    }
    function whatIsUpMenu()
    {
        var minWidth = 1400;
        if($(window).width() < minWidth)
            collapseFlyingMenu();
        else
            uncollapseFlyingMenu();
    }

    $(document).on('click', closerClass, function(e){
        e.preventDefault();

        collapseFlyingMenu();

        return false;
    });
    $(document).on('click', closerClosedClass, function(e){
        e.preventDefault();

        uncollapseFlyingMenu();

        return false;
    });
    if($(flyingMenuClass).length > 0)
    {
        $(window).scroll(function() {
            correctFlyingMenuPosition();
        });
        $(window).resize(function() {
            correctFlyingMenuHeight();
            whatIsUpMenu();
        });
        setTimeout(function(){
            whatIsUpMenu();
        }, 1000);
        correctFlyingMenuHeight();
        correctFlyingMenuPosition();

        $(flyingMenuClass).append('<div class="flying-menu__closer"></div>');
    }
});

function setSliderAuto() {
    return setInterval(function () {
        $('.slider__arrow_right').click();
    }, 10000);
}

function setSliderCurrentItem()
{
    var $slider = $('.slider');
    var currentWidth = getCurrentWidth();
    if(currentWidth <= 500 && $slider.data('current') == 1)
        $slider.data('current', 2);
}

function setSliderItemWidth() {
    var currentWidth = getCurrentWidth();
    $('.slider__item').width(currentWidth);
}

function setSliderPagination(index) {
    var $sliderPaginationItem = $('.slider__pagination-item');
    var sliderPaginationItemActiveClass = 'slider__pagination-item_active';
    $sliderPaginationItem.removeClass(sliderPaginationItemActiveClass);
    $sliderPaginationItem.eq((index - 1)).addClass(sliderPaginationItemActiveClass);
}

function getCurrentWidth() {
    var currentWidth = $(window).width();
    return currentWidth > 1920 ? 1920 : currentWidth;
}

function setSliderPosition() {
    var currentWidth = getCurrentWidth();
    $('.slider__list').css({
        'marginLeft' : '-' + currentWidth * ($('.slider').data('current') - 1) + 'px'
    });
}

function setSliderPositionByIndex(index) {
    var currentWidth = getCurrentWidth();
    $('.slider__list').css({
        'marginLeft' : '-' + currentWidth * (index - (currentWidth <= 500 ? 2 : 1)) + 'px'
    });
}

function isHidden(element) {
    return $(element).css('display') == 'none';
}

function getNextIndex(direction, currentIndex)
{
    var $sliderItem = $('.slider__item');
    var nextPosition = currentIndex,
        itemCount = $sliderItem.length;

    for(var i = 0; i < 10; i++)
    {
        if(direction == 'prev')
            nextPosition = nextPosition == 1 ? itemCount : nextPosition - 1;
        else
            nextPosition = nextPosition == itemCount ? 1 : nextPosition + 1;

        if(nextPosition == 1 && $(window).width() <= 500)
            continue;

        return nextPosition;
    }
}