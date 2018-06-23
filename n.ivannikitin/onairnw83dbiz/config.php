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
        'db_name' => "aw_nw17",
        'db_login' => "root",
        'db_password' => "a21081a98c",
        'tables' => [
            'comments' => "comments",
            'users' => "users",
        ],
    ],
    'translation' => [
        'page_url' => "/onairnw83dbiz/",
        'description_page_url' => 'https://plp.ivannikitin.ru/2018sale',
        'description_page_url_full' => 'https://plp.ivannikitin.ru/2018sale',
        'name' => 'Online-тренинг по 3D-моделированию от целей до результата',
        'registration_start' => Date("d.m.Y") . ' ' . '19:00:00',
        'start' => Date("d.m.Y") . ' ' . '20:00:00',
        'end' => Date("d.m.Y") . ' ' . '23:55:13',
        'start_at' => "начало в 20:00 (Время московское)",
        'video' => "AIhNxfOD5bE",
    ],
    'events' => [
        '20:26:18' => [
            'code' => "vk",
            'text' => "<p style='text-align:center;'><a target='_blank' class='button button_green' href='https://vk.com/ein3d'>Добавляйтесь в ВК</a></p>",
            'timer' => false,
            'from' => '20:26:18',
            'till' => '23:58:13',
        ],
        '22:40:00' => [
            'code' => "link",
            'text' => "<p style='text-align:center;'>Заказать Полную систему обучения 3D-визуализации (интерьер+экстерьер) 37900 рублей<br /><a class='button button_green' target='_blank' href='https://ivannikitin.autoweboffice.ru/?r=ordering/cart/aks1&id=67&vc=ca2bf79&lg=ru'>Подробности и запись на курс</a></p>",
            'timer' => false,
            'from' => '22:40:00',
            'till' => '23:58:13',
        ],
        '23:13:00' => [
            'code' => "site",
            'text' => "<p style='text-align:center;'>Система обучения 3D-визуализации только по Интерьеру 21900 рублей<br/><a class='button button_green' target='_blank' href='https://ivannikitin.autoweboffice.ru/?r=ordering/cart/aks1&id=63&vc=9e96968&lg=ru'>Подробности и запись на курс</a></p>",
            'timer' => false,
            'from' => '23:13:00',
            'till' => '23:58:13',
        ],
        '23:13:01' => [
            'code' => "site",
            'text' => "<p style='text-align:center;'>Система обучения 3D-визуализации только по Экстерьеру 21900 рублей<br/><a class='button button_green' target='_blank' href='https://ivannikitin.autoweboffice.ru/?r=ordering/cart/aks1&id=65&vc=af6bfe5&lg=ru'>Подробности и запись на курс</a></p>",
            'timer' => false,
            'from' => '23:13:01',
            'till' => '23:58:13',
        ],
        '23:24:00' => [
            'code' => "site",
            'text' => "<p style='text-align:center;'><a class='button button_green' target='_blank' href='https://docs.google.com/forms/d/e/1FAIpQLSdeNQWWS35VMOMUnnV1BBAGACepyzyJ4eEnUiNtik_yLoawHQ/viewform'>Анкета на бесплатную консультацию</a></p>",
            'timer' => false,
            'from' => '23:24:00',
            'till' => '23:58:13',
        ],
        '23:45:00' => [
            'code' => "site",
            'text' => "<p style='text-align:center;'><a class='button button_green' target='_blank' href='https://drive.google.com/open?id=1KdfM0UdrIQh0dlm0Zrulg6fFCMUGn99t'>Получить книгу</a></p>",
            'timer' => false,
            'from' => '23:45:00',
            'till' => '23:58:13',
        ],
    ],
    'timer' => [
        'show' => false,
        'js' => '',
        'html' => "",
    ],
    'author' => [
        'logo_url' => "https://ivannikitin.ru/images/logo.png",
        'phone' => "8 800 500 1361",
        'phone_desc' => "Звонок бесплатный<br> со всех телефонов РФ",
        'copyrights' => "Все права защищены<br>ИП Никитин Иван Александрович<br>ОГРНИП 311421707700048<br />",
    ],
    'form' => [
        'id' => "13705505",
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