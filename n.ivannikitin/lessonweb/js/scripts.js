$(function(){

        var sendPhoneButtonClass = '.send-phone-button',
            $form = $('.send-phone-form'),
            $phoneField = $('.send-phone-field'),
            $todayField = $('.send-today-field');
        $(document).on('click', sendPhoneButtonClass, function(){
            $.ajax({
                url: '/ao/onaircallme.php',
                data: {
                    save_phone: 1,
                    today: $todayField.val(),
                    phone: $phoneField.val()
                }
            }).done(function(answer){
                $form.html('<span class="phone-sent-message">Спасибо! Мы вышлем Вам смс перед началом вебинара.</span>');
            });
            return false;
        });

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
        }
        function uncollapseFlyingMenu()
        {
            var $closer = $(closerClass),
                $menu = $closer.closest(flyingMenuClass);

            $closer.text("").removeClass(closerClosedClass.replace('.', ''));
            $menu.removeClass('unbordered').find('ul').fadeIn(600);
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
    
        // Обёртка всех таблиц в блок.
        $('table').wrap('<div class="table_wrap"/>')

        if($('.top-adv__').length > 0)
        {
            var count = 0, IID = setInterval(function(){
                if(count++ >= 10)
                    clearInterval(IID);
                $('.top-adv__').height(48);
                $('body').animate({paddingTop: 48},800);
            }, 1500);
        }

        $(document).on('click', '.open_spoiler', function(){ 
            console.log('#' + $(this).data('target')); 
            $('#' + $(this).data('target')).slideToggle(500); 
            return false; 
        });

		// Перемещаем кнопку отправки комментария в конец формы, а то долбанная каптча идет после кнопки и смотрится нехорошо!
		if($('#commentform').length > 0 && $('#commentform').find('input[type=submit]').length > 0)
			$('#commentform').append($('#commentform').find('input[type=submit]').parent().parent().parent());

		$('#vkapi').fadeIn();

        $debug = function(text) { console.log('debug: ' + text); }


        $spoilers = $('.spoilers_here .for_spoiler');
            if($spoilers.length > 0) {
            var SPII_counter = 0;
            var SPII = setInterval(function(){
                if(SPII_counter++ == 3) clearInterval(SPII);
                $.each($spoilers, function(){
                    $this = $(this);
                    $parent = $(this).parent();
                    var parent_height = $parent.height();
                    var position = $this.position().top;
                    $parent.attr('data-height', position);
                    //console.log('position: ' + position);
                    $parent.height(position - 30);
                });
            }, 500);

            $('.spoiler_opener').click(function(){
                $parent = $(this).parent();
                var position = $parent.attr('data-height');
                $debug('clicked!');
                if($(this).hasClass('opened')) {
                    $debug('has');
                    $parent.animate({height: position}, 1500);
                    $(this).removeClass('opened');
                    $(this).text('Развернуть историю целиком');
                } else {
                    $debug('adding');
                    $parent.animate({height: 'auto'}, 1500);
                    $(this).addClass('opened');
                    $(this).text('Скрыть');
                }
            });
        }

        /*$('.spoiler_opener').hover(function(){
            $(this).stop(true, true).animate({opacity:1}, 300);
        }, function(){
            $(this).stop(true, true).animate({opacity:0.9}, 300);
        });*/

        // tags in p fix
        $('.simple_page p:has(iframe)').each(function(){
            $iframe = $(this).find('iframe');
            $(this).css({marginLeft:'auto', marginRight:'auto', width: $iframe.width()})
        });
        $('.simple_page p:has(img)').each(function(){
            $img = $(this).find('img');
            img_width = $img.width();
            if(img_width < 400)
                return true;
            $(this).css({textAlign: 'center',marginLeft:'auto', marginRight:'auto', width: img_width})
        });
        // end fix

        jQuery(document).on('click', '.in_spoiler__title', function(){
            $header = jQuery(this);
            $content = $header.parent().find('.in_spoiler__content');

            if($header.hasClass('active')) {
                $header.removeClass('active');
                $header.text('Показать подробности');
            } else {
                $header.addClass('active');
                $header.text('Скрыть подробности');
            }

            $content.stop(true, true).slideToggle(700);
            return false;
        });

        $(".fancybox").fancybox();


    if($('.getresponse_form').length > 0) {
    var SearchGRFormIntCounter = 0;
    var SearchGRFormInt = setInterval(function(){
        if(SearchGRFormIntCounter++ == 10)
            clearInterval(SearchGRFormInt);
        else {
                $('.getresponse_form').find('style').remove();
                $('.getresponse_form').find('.wf-footer').remove();
                $('.getresponse_form').fadeIn();
                clearInterval(SearchGRFormInt);
        }
    },100);
    }

    $('.video_row__item .video').hover(function(){
        $(this).find('.hover').show();
    }, function(){
        $(this).find('.hover').hide();
    });

    $('.clearOnFocus').each(function(){
        var $this = $(this);
        var value = $this.val();
        $this.focus(function(){
            if($(this).val() == value)
                $(this).val('');
        });
        $this.blur(function(){
            if($(this).val() == '')
                $(this).val(value);
        });
    });

    $(document).on('click', '.video_row__item .video .hover', function(){
        $('.video_full').attr('src', $(this).attr('data-src'));
        return false;
    });

    var image_input = '<br /><input type="file" class="next" name="" id="" />';
    $(document).on('click', '.add_image_input', function(){
        var $input_array = $($(this).attr('href'));
        var $this = $(this);
        $input_array.append(image_input);
        if($input_array.find('input[type=file]').length > 4)
            $this.remove();
    });

    $('a[href^="#"]').bind('click.smoothscroll',function (e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target);

        if($target.length <= 0)
            return false;

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 500, 'swing', function () {
            window.location.hash = target;
        });
    });


    //$('#timer').county({
    //    endDateTime: new Date('2015/12/18 23:59:00'),
    //    reflection: true,
    //    animation: 'scroll',
    //    theme: 'gray'
    //});

    $(document).on('click', '.no_click', function(e){
        e.preventDefault();
        return false;
    });

    var _t = $('#share42');
    _t.children('span').wrapAll('<span class="b-share__wrap"></span>');
    _t.prepend('<span class="b-share__top">Поделитесь с&nbsp;друзьями</span>');
    _t.find('.b-share__wrap').find('span').each(function(){
        var this_a = $(this).find('a');
        //$(this).find('.share42-counter').appendTo(this_a);
        this_a.append('<i></i><u></u>');
    });

    var IID_count = 0;
    var IID = setInterval(function(){
        if(IID_count++ == 10) clearInterval(IID);
        $('#share42').find('.b-share__wrap').find('span').each(function(){
            $(this).find('.share42-counter').appendTo($(this).find('a'));
        });
    }, 100);

    $('.b-socials .share42-item a').hover(function(){
        //$(this).find('i').animate({width:'90px'},150);
        $(this).find('i').css({width:'81px'});
        $(this).find('.share42-counter').addClass('_black');
    }, function(){
        //$(this).find('i').animate({width:0},100);
        $(this).find('i').css({width:0});
        $(this).find('.share42-counter').removeClass('_black');
    });

    var _width = $(this).width();

    // set menu
    $('.menu ul li:has(ul)').each(function(){
        $(this).addClass('multi-menu');
    });

	$(window).resize(function(){
		if($(this).width() > 1000)
			$('.menu > ul').css({'height':'auto'});
		else {
			$('.menu > ul').css({'height':0});
			$('.menu-opener').removeClass('active');
		}

	});
    $(document).on('click', '.menu ul li a', function(){
        var _this = $(this);
        var _parent = _this.parent();
        var _this_ul = _parent.find('ul');
        if(_this_ul.length > 0) {
            var _menu_elements = $('.menu ul li');
            var _is_active = _this.parent().hasClass('active');
            _menu_elements.each(function(){
                $(this).removeClass('active').find('ul').slideUp();
            });
            if(!_is_active) {
                $('.menu > ul').css({'height':'auto'});
                _parent.addClass('active');
                _this_ul.slideDown();
            }
            return false;
        }
    });
    $(document).click( function(event){
        if( $(event.target).closest(".menu ul li ul").length )
            return;
        $(".menu ul li ul").parent().removeClass('active');
        $(".menu ul li ul").slideUp();
        event.stopPropagation();
    });
	$(document).on('click', '.menu-opener', function(e){
        e.preventDefault();
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('.menu > ul').stop(true,true).animate({'height': 0}, 400);
		} else {
			$(this).addClass('active');
			var liHeight = $('.menu > ul > li').height();
			var liCount = $('.menu > ul > li').length;
			$('.menu > ul').stop(true,true).animate({'height': liHeight * liCount}, 700);
		}
		return false;
	});

    if($('.countdown_here').length > 0) {
        $('.countdown_here').each(function(){
            var $obj = $(this);

            var currentDate = new Date();
            var targetDate = new Date($obj.attr('data-year'),
                $obj.attr('data-month'),
                $obj.attr('data-day'),
                $obj.attr('data-hour'),
                $obj.attr('data-minute'),
                $obj.attr('data-second'));

            if(targetDate > currentDate) {
                $obj.countdown({
                    timestamp	: targetDate
                });
            } else {
                var action = $obj.attr('data-action');
                if(action == 'block-buttons') {
                    $('.button_start').each(function(){
                        $(this).attr('href', '#');
                        $(this).click(function(e){
                            e.preventDefault();
                            return false;
                        });
                    });
                } else if(action == 'hide') {
                    $obj.hide();
                }
            }
        });
    }

    // Show site comments by clicking
    $(document).on('click', 'table#vkapi_wrapper button.vk_recount', function(){
        $('#comments-form').fadeOut();
    });
    $(document).on('click', 'table#vkapi_wrapper button:not(.vk_recount)', function(){
        $('#comments-form').fadeIn();
    });
    /*function showWP() {
        $('#comments-form').fadeIn();
    }*/

    $('#subscribeShowPhone').click(function(){
        $('#subscribe__field_phone').fadeToggle();
    });
});