<?
$monthNames = [
    1 => "января",
    2 => "февраля",
    3 => "марта",
    4 => "апреля",
    5 => "мая",
    6 => "июня",
    7 => "июля",
    8 => "августа",
    9 => "сентября",
    10 => "октября",
    11 => "ноября",
    12 => "декабря",
];

$tomorrow = strtotime("tomorrow");
$day = Date("j", $tomorrow);
$monthNumber = Date("n", $tomorrow);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.png" type="image/png">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,800,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/jquery.countdown.css">
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/style-dop.css">
 <!--[if lt IE 9]>
 <script src="js/html5.js"></script>
 <![endif]-->

<title>Важная информация! | Проект Ивана Никитина</title>


<!— BEGIN JIVOSITE CODE {literal} —>
<script type='text/javascript'>
    (function(){ var widget_id = 'bPzQPgx54H';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!— {/literal} END JIVOSITE CODE —>

<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/9434df5cec438b50a15b08bb0c5e5bda_1.js" async></script>

<!— Facebook Pixel Code —>
<script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1037398522960456');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=1037398522960456&ev=PageView&noscript=1"
    /></noscript>
<!— DO NOT MODIFY —>
<!— End Facebook Pixel Code —>
</head>
<body>

<div class="share42init b-socials" data-url="https://ivannikitin.ru" data-title="Проект по 3D графике и профессиональному обучению" data-top1="150" data-top2="20" data-margin="0"></div><div class="wrapper ">


<header class="header">
	<a href="/" class="main_logo block_3x no_click">
		<img src="images/logo.png" />
	</a>
	<div class="site_desc block_3x">Проект по 3D графике<br /> и профессиональному обучению</div>
	<div class="ring_us_up block_3x">
        <div class="time">график работы:<br> с 09:00 до 18:00 (Пн-Пт)</div>
		<span class="phone">8 800 500 1361</span>
		<span class="desc">Звонок по России бесплатный</span>
        <div class="phone-dop">
            <span class="phone">+7&nbsp;499&nbsp;110&nbsp;4308</span>
        </div>
        <div class="email-dop">
            <span class="email"><a href="mailto:info@ivannikitin.ru">info@ivannikitin.ru</a></span>
        </div>
	</div>
    
</header><!-- .header-->

        
<main class="content" >

<div style='position:absolute;left:-2000px;width:2000px'>
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t52.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров и"+
" посетителей за 24 часа' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet-->
</div>


    <link rel="stylesheet" type="text/css" href="css/sailzak.css">
    <style>
        h1 {
            line-height: 1.4;
        }
        p, h2, h3 {
            line-height: 1.2;
        }
    </style>

    <div class="important_page">

        <h1>Спасибо за регистрацию на мастер-класс<br />
            “Ваш онлайн бизнес на 3D визуализации”</h1>

        <div class="space-line"></div>

        <div class="columns columns_padding">

            <div class="columns__item">
                <iframe width="470" height="264" src="https://www.youtube.com/embed/mApwTFBpMFM?autoplay=1&rel=0&showinfo=0&cc_load_policy=0&controls=0&iv_load_policy=0&modestbranding=0" frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="columns__item">
                <p><strong>Дата и время начала мастер-класса:<br />
                    <span style="font-size: 22px;"><?= $day?> <?= $monthNames[$monthNumber]?></span>,</strong> в 20:00 по московскому времени</p>
                <p>Ссылка для входа на эфир будет отправлена вам на e-mail.</p>
                <p class="important-information">
                    Поставьте напоминание в Ваш телефон,<br />
                    чтобы не опоздать к началу мероприятия.<br />
                    Трансляция пройдет один раз!
                </p>
            </div>

            <div class="clear"></div>

        </div>

        <div class="grey-block" style="padding-top: 1px;">

            <div class="phone-sub" style="float: none;margin: 0 auto;">
                <div class="phone-sub__title">Оставьте Ваш номер телефона, <br />
                    и мы напомним Вам о начале трансляции</div>
                <div class="phone-sub__form send-phone-form">
                    <input type="hidden" class="send-today-field" value="2">
                    <input type="text" class="send-phone-field" placeholder="+71234567890" id="phone" />
                    <input type="button" id="send-phone" class="send-phone-button" value="Сделать напоминание" />
                </div>
            </div>

        </div>

    </div>

    <h1 style="color: #333 !important;margin: 30px 0 0;">Заполните опрос и получите<br/> дополнительно 2 мастер-класса</h1>
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdqHzwP0Bqj6ixLg2gpx3lLsB9B0PBJMp0qcor7bZ9ooEWQpw/viewform?embedded=true" style="max-width: 932px; width: 100%; height: 2700px; margin: 10px auto; display: block;" frameborder="0" marginheight="0" marginwidth="0">Загрузка...</iframe>

    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=GgXwsg/OLY2eoOigxUd/l1OmzAxyPtrrcbuj*5Z9xJ4Q3BroMUrwo1LtMJ17Ym6Hh0DFVcI69nisk5NqwFJrFj*MCjx0vOnK*T3Qry7tvAOOIOjT4OQuFRjHHdR3EaOxo1pW8Dpp7yk8WhQffCJn0FoMfi6LtsKH8S18o/VxlmQ-';</script>

    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=h/XZl2RN0c*gtqkft7OSfyXOi3ZErO2nzskZ4V4ubjV6NWo3UfRdCqUTjxTXgxu/hdi*riw2As4pPk5GFmjrgXswTaN8mT8LPUQeZzJy/McHLBdXMpZLj7iN8gZXDRKEqjxPaJ1C9icmCZDipMCcr5CMx3E*RIzyMa0XSYdwcwY-';</script>

    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=YFczU4425TwDiWZ4Ki37wwQgTINGgHgHcw8lWwBAv81*AzSZTgRdp1yHN1oQLHzQF0XZ*r0RrREr1qd0/s/jzYvbETKB3D20dAHYOfW7v7dMrkna28xKyXovpCn5hUABuhnrBAJ6WUyyN3NKereccvh/vhYJ4k*jsyGuehvhzgA-';</script>

    <!-- TrackCode -->
    <script type="text/javascript">
        var _paq = _paq || [];
        var trackedForms;
        var sid = 324;
        var urlref;
        (function() {
            var u=(("https:" == document.location.protocol) ? "https" : "http") + "://dev.voronki.com/";
            _paq.push(['setTrackerUrl', u+'tracker']);
            _paq.push(['setSiteId', 324]);
            _paq.push([function(){trackedForms = document.getElementsByTagName('form');}]);
            _paq.push([function(){prepareForms(trackedForms);}]);
            _paq.push([function(){getSiteChannels();}]);
            _paq.push(['trackGoal', 1]);
            _paq.push(['setConversionAttributionFirstReferrer', true]);
            _paq.push([function(){urlRef = this.getAttributionReferrerUrl();}]);
            _paq.push(['setReferralCookieTimeout', 5184000]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
            g.defer=true; g.async=true; g.charset='UTF-8'; g.src=u+'voronki.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End TrackCode -->
    
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=EC88R666m31RRvNs8FB35RUYqNta0a9aI7lt0u0TFZwxMGJQGpIhmMpSyJYbhIreWHLw0s3kY6KbbgThgQwkCoTl9KTk*O6SP9Blj9lB74dLSeDVcjUieHZMKdgcuuz*IZGUj0uiSps0Y*97VSrM2Riy4RnyMpIYYRduimkDHNE-';</script>
</main><!-- .content -->
</div><!-- .wrapper -->
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.cookie.min.js"></script>
<script src="js/share42.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js"></script>
<script type='text/javascript' src='https://www.youtube.com/player_api?ver=3.8.2'></script>
<script type="text/javascript" src="js/yt.js"></script>
<!-- fotorama.css & fotorama.js. -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.3/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.3/fotorama.js"></script>

<script type="text/javascript" src="js/scripts.js"></script>
    <style type="text/css">
        .header {
            min-height: 100px;
        }
        .simple_page {
            margin-top: 0;
        }
        .content {
            padding-top: 0;
            padding-bottom: 0;
        }
        .simple_page, .simple_page h1 {
            line-height: 1.4;
            /*text-align: center;*/
        }
    </style>
    <script type="text/javascript">
        $(function(){
            $('.share42init').remove();
                    });
    </script>
<script type="text/javascript">
    var gr_goal_params = {
        param_0 : '',
        param_1 : '',
        param_2 : '',
        param_3 : '',
        param_4 : '',
        param_5 : ''
    };</script>
<script type="text/javascript" src="https://app.getresponse.com/goals_log.js?p=78905&u=SkWt"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter25390016 = new Ya.Metrika({id:25390016,
                    webvisor:true,
                    clickmap:true,
                    accurateTrackBounce:true});

                w.yaCounter42782049 = new Ya.Metrika({id:42782049,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div>
        <img src="//mc.yandex.ru/watch/25390016" style="position:absolute; left:-9999px;" alt="" />
        <img src="//mc.yandex.ru/watch/42782049" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-52300977-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');

</script>
<!-- AutoWebOffice: UTM or OpenStat Counter -->
<script type="text/javascript">
    var url = "https://ivannikitin.autoweboffice.ru/?r=api/utmopenstat";
</script>
<script type="text/javascript" src="https://ivannikitin.autoweboffice.ru/js/utm_openstat.js" defer="defer"></script>
<!-- /AutoWebOffice: UTM or OpenStat Counter -->
<script type="text/javascript">var kmq = kmq || []; var kmk = kmk || 'ed203204e27e9218430c6c711e1de5bdfe31e4c3'; function kms(u){ setTimeout(function(){ var d = document, f = d.getElementsByTagName('script')[0], s = d.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = u; f.parentNode.insertBefore(s, f); }, 1); } kms('//i.kissmetrics.com/i.js'); kms('//doug1izaerwt3.cloudfront.net/' + kmk + '.1.js'); </script>

<!-- Разработано в Силлион http://sillion.ru -->

</body>
</html>		