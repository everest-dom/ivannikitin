<?php

require_once("config.php");

if(isset($_GET['email']))
    setcookie('on_air_email', $_GET['email']);

$now = time();
$startInSeconds = strtotime($config['translation']['start']);
$registrationStartInSeconds = strtotime($config['translation']['registration_start']);
// Секунд до начала трансляции
$secondsToStart = $startInSeconds - $now;
// Секунд до начала регистрации
$secondsToStartRegistration = $registrationStartInSeconds - $now;
// Момент продолжения потока
$videoTimeStart = $now - $startInSeconds;

if($secondsToStart < 0 && isset($_COOKIE['on_air_name']) && isset($_COOKIE['on_air_email']) && isset($_COOKIE['on_air_phone']))
    $state = "start";
elseif($secondsToStartRegistration <= 0 && (!isset($_COOKIE['on_air_name']) || !isset($_COOKIE['on_air_email']) || !isset($_COOKIE['on_air_phone'])))
    $state = "register";
elseif($secondsToStartRegistration <= 0 && isset($_COOKIE['on_air_name']) && isset($_COOKIE['on_air_email']) && isset($_COOKIE['on_air_phone']))
    $state = "almost";
else
    $state = "awaiting";

if(isset($_GET['state']) && isset($_GET['pass']) && $_GET['pass'] == "4325235341")
{
    $state = $_GET['state'];
    if($_GET['state'] == "start")
        $videoTimeStart = 1;
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$config['translation']['name']?></title>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/timer.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link type="text/css" href="css/style.css" rel="stylesheet" />

    <script src="//widget.manychat.com/237655103010419.js" async="async"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            console.log(navigator.userAgent);
            if (/android|iphone|ipod|ipad|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
                $('.video-layer').remove();
            }

            /* this time *** */
		    var thisTimeH = <?php echo (int)date("G", $time); ?>; var thisTimeHs = null;
		    var thisTimeM = <?php echo (int)date("i", $time); ?>; var thisTimeMs = null;
		    var thisTimeS = <?php echo (int)date("s", $time); ?>; var thisTimeSs = null;
		    var thisTime = null;
		    var pluzM = 0;
		    var pluzH = 0;
		    
		    fThisTime();
		    function fThisTimeCheckServer(){      
		     return(
		        $.ajax({
		          type : "POST",
		          url : "checkServerTime.php",
		          data: "",
		          success: function(msg){return msg;},
		          error: function(){}
		        })
		      );      
		    }
		    function fThisTime(){
		      setTimeout(function() {
		        thisTimeS++;
		        /* проверка времени на сервере *** */
		        //console.debug('@@@'+thisTimeS);
		        if(thisTimeS==10){
		          var timeS = fThisTimeCheckServer();
		          timeS.done(function(data) {
		            var arrT = JSON.parse(data); 
		           //console.debug('!!!'+arrT[2]+' '+arrT[1]+' '+arrT[0]);
		            thisTimeS=parseInt(arrT[0]);
		            thisTimeM=parseInt(arrT[1]);
		            thisTimeH=parseInt(arrT[2]);
		          });
		        }
		        /* проверка времени на сервере END */
		        if(thisTimeS==60){
		          thisTimeS=0;
		          pluzM++;
		        }
		        if((thisTimeM+pluzM)==60){
		          thisTimeM=0;
		          pluzH++;
		        }else{
		          thisTimeM=thisTimeM+pluzM;
		        }
		        if((thisTimeH+pluzH)==24){
		          thisTimeH=0;
		        }else{
		          thisTimeH=thisTimeH+pluzH;
		        }
		        pluzM=0;
		        pluzH=0;
		        pluzH=0;
		        if(thisTimeS<10){thisTimeSs='0'+thisTimeS.toString();}
		        else{thisTimeSs=thisTimeS.toString();}//console.debug(thisTimeSs);
		        if(thisTimeM<10){thisTimeMs='0'+thisTimeM.toString();}
		        else{thisTimeMs=thisTimeM.toString();}//console.debug(thisTimeM);
		        if(thisTimeH<10){thisTimeHs='0'+thisTimeH.toString();}
		        else{thisTimeHs=thisTimeH.toString();}//console.debug(thisTimeHs);
		        thisTime = thisTimeHs+thisTimeMs+thisTimeSs;
		        //console.debug(thisTime);
		        $('#thisTime').val(thisTime);
		        fThisTime();
		      }, 4000);
		    }
		    /* this time END */

            timer(<?=$secondsToStart; ?>, ".timer");

            function countPeople(countP,p_m,timeOut){
                setTimeout(function() {
                    var thisTimeP = parseInt($('#thisTime').val()); //console.debug(thisTimeP+' '+p_m);
                    /*1*/
                    if(thisTimeP<195700 || thisTimeP>230905){ //console.debug('st1');
                        countP = false; //console.debug(thisTimeP);
                    }
                    /*2 */
                    else if(thisTimeP>=195700 && thisTimeP<=200111){ //console.debug(thisTimeP);
                        if(p_m==1){
                            countP = countP+getRand1(2,3); //console.debug(countP);
                        }else{
                            countP = countP+(-1)*getRand1(1,5);
                        }
                        if(countP<356){
                            countP = 356;
                        }
                        if(countP>373){
                            countP = 373-getRand1(1,5);
                        }
                        if(thisTimeP>=195825 && thisTimeP<=200111){
                            countP = 389;
                        }
                        console.debug('!!2 '+countP+' !!!');
                    }
                    /*3   200156*/
                    else if(thisTimeP>200111 && thisTimeP<=200241){ //console.debug('st3');
                        if(p_m==1){
                            countP = countP+getRand1(2,3);
                        }else{
                            countP = countP+(-1)*getRand1(1,2);
                        }
                        if(countP<401){
                            countP = 401;
                        }
                        if(countP>412){
                            countP = 412-getRand1(1,2);
                        }
                        if(thisTimeP>=200111 && thisTimeP<=200241){
                            countP = 412;
                        }
                        console.debug('!!3 '+countP+' !!!');
                    }
                    /*4 215342*/
                    else if(thisTimeP>200241 && thisTimeP<=221005){ //console.debug('st4');
                        if(p_m==1){
                            countP = countP+getRand1(2,3);
                        }else{
                            countP = countP+(-1)*getRand1(1,2);
                        }
                        if(countP<415){
                            countP = 415;
                        }
                        if(countP>475){
                            countP = 473-getRand1(1,5);
                        }
                        if(thisTimeP>=215319 && thisTimeP<=215352){
                            countP = 473;
                        }
                        console.debug('!!4 '+countP+' !!!');
                    }
                    /*5 221306*/
                    else if(thisTimeP>221005 && thisTimeP<=222506){ //console.debug('st5');
                        if(p_m==1){
                            countP = countP+getRand1(1,2);
                        }else{
                            countP = countP+(-1)*getRand1(3,4);
                        }
                        if(countP>470){
                            countP = 468;
                        }
                        if(countP<458){
                            countP = 458+getRand1(1,3);
                        }
                        if(thisTimeP>=221236 && thisTimeP<=221346){
                            countP = 463;
                        }
                        console.debug('!!5 '+countP+' !!!');
                    }
                    /*6 230845*/
                    else if(thisTimeP>222506 && thisTimeP<=230905){ //console.debug('st5');
                        if(p_m==1){
                            countP = countP+getRand1(1,2);
                        }else{
                            countP = countP+(-1)*getRand1(2,4);
                        }
                        if(countP>470){
                            countP = 463;
                        }
                        if(countP<351){
                            countP = 351+getRand1(1,5);
                        }
                        if(thisTimeP>=230825 && thisTimeP<=230905){
                            countP = 354;
                        }
                        console.debug('!!5 '+countP+' !!!');
                    }
                    /* !!!!!!!!!!!!!!!!!!!!!!! */
                    if(countP){
                        if(p_m==1){
                            p_m=-1;
                        }else{
                            p_m=1;
                        }
                        if(countP!=50){
                            $(".countPeople__count").text(countP);
                            //$(".countPeople").show();
                        }else{
                            $(".countPeople__count").text(countP);
                            //$(".countPeople").hide();
                        }
                        //console.debug(countP+' '+p_m);
                    }else{
                        $(".countPeople0").hide();
                        countP = 50;
                        p_m = 1;
                        //console.debug(countP+' '+p_m);
                    }
                    // console.debug(countP);
                    // countPeople(countP,p_m,10000);
                }, timeOut);

            };

            countPeople(50,1,5);

            function getRand1(min, max){
		      return Math.floor(Math.random() * (max - min + 1)) + min;
		    }

            // Запуск событий
            function checkEvents()
            {
                setTimeout(function() {
                    $.ajax({
                        type : "POST",
                        url : "<?=$config['translation']['page_url']?>check.php",
                        data: "",
                        success: function(msg)
                        {
                            if( msg != "ER" )
                            {
                                if (msg == "OK")
                                {
                                    window.location.href = "<?=$config['translation']['description_page_url_full']?>";
                                }
                                else
                                {
                                    $('.event__text').html(msg);
                                    $('.event').fadeIn(700);
                                }
                            }
                        },
                        error: function()
                        {

                        }
                    });
                    checkEvents();
                }, 3000);
            }

            checkEvents();

            // Отправка комментариев
            function sendComment()
            {
                var $commentSubmit = $(".comment-form__submit"),
                    $commentForm = $(".comment-form"),
                    $commentField = $(".comment-form__comment"),
                    $commentResult = $(".comment-result");

                var comment = $commentField.val();

                if(comment.length == 0)
                {
                    alert('Нельзя отправить пустой комментарий');
                    return false;
                }
                else
                {
                    $commentForm.hide();

                    $.ajax({
                        type : "POST",
                        url : "addComment.php",
                        data: {
                            comment: comment
                        }
                    }).done(function(msg){
                        if(msg == "OK")
                        {
                            $commentResult.text("Ваш комментарий успешно отправлен");
                            $commentField.val("");
                        }
                        else
                        {
                            $commentResult.text(msg);
                        }

                        $commentResult.fadeIn(700);

                        setTimeout(function(){
                            $commentForm.fadeIn(700);
                            $commentResult.hide();
                        }, 3000);
                    });
                }
            }

            var $commentSubmit = $(".comment-form__submit");

            if($commentSubmit.length > 0)
            {
                document.onkeyup = function (e) {
                    e = e || window.event;
                    if (e.keyCode === 13) {
                        sendComment();
                    }
                    // Отменяем действие браузера
                    return false;
                };
            }


            $commentSubmit.click(function(){
                sendComment();
            });

        });

    </script>
</head>
<body>

<input type="hidden" id="thisTime" value="">

<div class="wrapper">

    <div class="header">

        <a class="header__item header__logo" href="">
            <img src="<?=$config['author']['logo_url']?>">
        </a>

        <div class="header__item header__desc">
            <span class="header-desc__title"><?=$config['translation']['name']?></span>
            <? if($_COOKIE['sv'] != "y"): ?><span class="header-desc__start-at"><?=$config['translation']['start_at']?></span><? endif; ?>
        </div>

        <div class="header__item header__contacts">
            <div class="header-contacts__phone"><?=$config['author']['phone']?></div>
            <div class="header-contacts__desc"><?=$config['author']['phone_desc']?></div>
        </div>

    </div>

    <div class="content">

        <?
            // Трансляция
            if($state == "start") {
        ?>

            <div class="video-layer"></div>
            <div class="video-splash"></div>

            <div class="video">
                <? if($videoTimeStart > 0): ?>
                    <iframe width="783" height="587" src="//www.youtube.com/embed/<?=$config['translation']['video']?>?fmt=22&autoplay=1;enablejsapi=1&playerapiid=ytplayer;showinfo=0;loop=1;cc_load_policy=1;rel=0;modestbranding=1;controls=0&hd=1&vq=hd720&quality=high&version=3&start=<?php echo $videoTimeStart;?>" frameborder="0" allowfullscreen></iframe>
                <? endif; ?>
            </div>

            <div class="actions-block">
                <div class="event">
                    <div class="event__text"></div>
                    <div class="event__timer">
                        <? if($config['timer']['show']): ?>
                            <?=$config['timer']['js']?>
                            <?=$config['timer']['html']?>
                        <? endif; ?>
                    </div>
                </div>
            </div>

            <? if($state['start']): ?>
                <div class="add-comment">
                    <div class="add-comment__title">(ЧАТ) Задайте свой вопрос ведущему</div>
                    <div class="add-comment__form comment-form">
                        <input id="field-name" type="hidden" class="field-name" value="<?=$_COOKIE['on_air_name']?>" />
                        <label class="add-comment__label" id="field-comment">Текст сообщения:</label>
                        <textarea id="field-comment" class="add-comment__textarea comment-form__comment"></textarea>
                        <div class="comment-form__submit">Отправить</div>
                    </div>
                    <div class="add-comment__result comment-result"></div>
                    <p style="padding: 0 0 0 8px;margin-top: 0;font-size: 14px;color: #fff;">Ваши сообщения видит только ведущий. Это анти-спам функция,
                        чтобы другие участники не отвлекали Вас от сути презентации.</p>
                </div>

                <!--<div class="countPeople">
                    <div class="countPeople__title">Зрителей в эфире</div>
                    <div class="countPeople__count"></div>
                </div>-->
            <? endif; ?>

            <? if($state['start']): ?>
                <div class="fix-sound">
                    <a href="" class="fix-sound__button button button_green">Обновить страницу</a>
                <span class="fix-sound__text">
                    Если у вас пропал звук или видео, просто обновите страницу.<br>
                    Если вы слышите эхо, проверьте, не открыты ли другие вкладки в браузере, с которых идёт
                    вещание. Если открыты, то их необходимо закрыть.
                </span>
                </div>
            <? endif; ?>

        <?
            // Регистрация на трансляцию
            } elseif($state == "register") {
        ?>
                <div class="register">

                    <div class="register__title">Пожалуйста, введите Ваши данные, для входа на трансляцию</div>

                    <? if(isset($_GET['error'])): ?>
                        <div class="register__error">Введены не все данные</div>
                    <? endif; ?>

                    <div class="register__form">

                        <form action="register.php" method="POST">

                            <div class="register__row">
                                <label for="f-name">Ваше имя</label>
                                <input type="text" name="name" id="f-name" value="<?= $_REQUEST['name']?>" />
                            </div>

                            <div class="register__row">
                                <label for="f-email">Ваш E-mail</label>
                                <input type="text" id="f-email" name="email" value="<?= (isset($_GET['email']) ? $_GET['email'] : $_COOKIE['on_air_email']) ?>" />
                            </div>

                            <div class="register__row">
                                <label for="f-phone">Ваш телефон</label>
                                <input type="text" id="f-phone" name="phone" value="<?= $_REQUEST['phone']?>" />
                            </div>

                            <input type="hidden" name="referrer" value="https://<?=$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']?>">

                            <div class="register__row">
                                <input type="submit" value="Отправить" class="button button_green" />
                            </div>

                        </form>

                    </div>

                </div>
        <?
            // Ожидание
            } elseif($state == "almost") {
        ?>
            <div class="grey-video-stream">

                <p class="grey-video-stream__title">Скоро начнем</p>

                <p class="grey-video-stream__timer">
                    <font>
                        <font class='timer__hours'>0</font>:<font class='timer__minutes'>38</font>:<font class='timer__seconds'>58</font>
                    </font>
                </p>

            </div>
        <? } else { ?>
                <div class="important_page">

                    <div class="space-line"></div>

                    <div class="columns columns_padding">

                        <div class="columns__item">
                            <iframe width="470" height="264" src="https://www.youtube.com/embed/mApwTFBpMFM?autoplay=1&rel=0&showinfo=0&cc_load_policy=0&controls=0&iv_load_policy=0&modestbranding=0" frameborder="0" allowfullscreen></iframe>
                        </div>

                        <div class="columns__item">
                            <h1 class="awaiting__title">трансляция начнется прямо<br />
                                на этой странице через:</h1>
                            <p class="timer">
                                <font>
                                    <font class='timer__hours'>0</font>:<font class='timer__minutes'>38</font>:<font class='timer__seconds'>58</font>
                                </font>
                            </p>

                            <p class="important-information">
                                Мастер-класс пройдет только один раз, поэтому не<br />
                                пропустите эфир.
                            </p>
                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="grey-block" style="padding-top: 1px;">

                        <div class="phone-sub" style="width: 90%;float: none;margin: 0 auto;">
                            <div class="phone-sub__title">
                                <span style="font-size: 18px;font-weight:bold;">Боитесь пропустить начало?</span><br />
                                Оставьте Ваш номер телефона, и мы заранее напомним Вам о начале трансляции
                            </div>
                            <div class="phone-sub__form send-phone-form" style="text-align: center;">
                                <input type="text" class="send-phone-field" placeholder="+71234567890" id="phone" />
                                <input type="button" id="send-phone" class="send-phone-button" value="Отправить напоминание" />
                            </div>
                        </div>

                    </div>

                </div>
        <? } ?>

    </div>

    <div class="footer">
        <div class="footer__copyrights">
            <?=$config['author']['copyrights']?>
        </div>
    </div>

</div>

<?

    // Выведем коды статистики
    foreach($config['statistics'] as $statistics):
        echo $statistics;
    endforeach;

?>

</body>
</html>
