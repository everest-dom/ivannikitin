<?

session_start();
date_default_timezone_set('Europe/Moscow');

$config = [
    'error' => [
        'comments_page' => 'Доступ к разделу запрещен!',
        'phones_page' => 'Доступ к разделу запрещен!',
    ],
    'phones' => [
        'page_login' => 'admin',
        'page_password' => '828423472',
        'per_page' => 10,
        'db_name' => "in_system",
    ],
    'comments' => [
        'page_login' => 'admin',
        'page_password' => '828423472',
        'per_page' => 10,
    ],
    'db' => [
        'host' => "localhost",
        'db_name' => "autoweb2",
        'db_login' => "root",
        'db_password' => "a21081a98c",
        'tables' => [
            'comments' => "comments",
            'users' => "users",
        ],
    ],
    'translation' => [
        'page_url' => "/onairgoals3dbiz/",
        'description_page_url' => '/3dbiz/',
        'description_page_url_full' => 'http://ivannikitin.ru/3dbiz/',
        'name' => 'Online-тренинг по 3D-моделированию от целей до результата',
        'registration_start' => Date("d.m.Y") . ' ' . '19:00:00',
        'start' => Date("d.m.Y") . ' ' . '19:55:00',
        'end' => Date("d.m.Y") . ' ' . '23:24:07',
        'start_at' => "начало в 20:00 (Время московское)",
        'video' => "PnFHz_Ta-Fk",
    ],
    'events' => [
        '20:26:30' => [
            'code' => "vk",
            'text' => "<p style='text-align:center;'><a target='_blank' class='button button_green' href='https://vk.com/ein3d'>Добавляйтесь в ВК</a></p>",
            'timer' => false,
            'from' => '20:26:30',
            'till' => '23:59:59',
        ],
        '22:31:00' => [
            'code' => "link",
            'text' => "<p style='text-align:center;'>Полные онлайн курсы по продвинутой визуализации<br /> доступны со скидкой для участников мастер-класса.<br /><a class='button button_green' target='_blank' href='http://ivannikitin.autoweboffice.ru/?r=ac&id=90&lg=ru'>Подробности и запись на курс</a></p>",
            'timer' => false,
            'from' => '22:31:00',
            'till' => '23:59:59',
        ],
        '21:37:00' => [
            'code' => "site",
            'text' => "<p style='text-align:center;'><a class='button button_green' target='_blank' href='https://cloud.mail.ru/public/8Ewr/TCfgi1xyY'>Скачать схему сайта</a></p>",
            'timer' => false,
            'from' => '21:26:30',
            'till' => '21:40:00',
        ],
        '23:13:15' => [
            'code' => "book",
            'text' => "<p style='text-align:center;'><a class='button button_green' target='_blank' href='https://cloud.mail.ru/public/10c00f15bca1/kak_bystro_i_bez_zatrat_privlech_klientov_v_svoj_biznes.zip'>Скачать книгу</a></p>",
            'timer' => false,
            'from' => '23:13:15',
            'till' => '23:16:00',
        ],
    ],
    'timer' => [
        'show' => false,
        'js' => '<!--Начало кода "proТаймера" (id:7710)--><script type="text/javascript" src="http://files.makedreamprвofits.ru/js/jmdp.js"></script><script type="text/javascript">(function(d,w){n=d.getElementsByTagName("script")[0],s=d.createElement("script"),f=function(){n.parentNode.insertBefore(s,n);};s.type="text/javascript";s.async=true;o=(new Date()).getTimezoneOffset();qs=document.location.search.split("+").join(" ");re=/[?&]?([^=]+)=([^&]*)/g;m="";while(tokens=re.exec(qs))if("email"===decodeURIComponent(tokens[1])) m=decodeURIComponent(tokens[2]);i="55633e7d2da1f";s.src="http://cdcs.makedreamprofits.ru/?"+i+"&"+o+"&"+m; if("[object Opera]"===w.opera)d.addEventListener("DomContentLoaded",f,false);else f();})(document, window);</script><!--Конец кода "proТаймера"-->',
        'html' => "<div>Загрузка таймера</div>",
    ],
    'author' => [
        'logo_url' => "https://ivannikitin.ru/images/logo.png",
        'phone' => "8 800 500 1361",
        'phone_desc' => "Звонок бесплатный<br> со всех телефонов РФ",
        'copyrights' => "Все права защищены<br>ИП Никитин Иван Александрович<br>ОГРНИП 311421707700048<br />",
    ],
    'form' => [
        'id' => "13524605",
    ],
    'statistics' => [
        'yandex' => '<!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter25390016 = new Ya.Metrika({
                        id:25390016,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
        });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/25390016" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->',
        'google' => "<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-52300977-1', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');

    </script>",
    ],
];