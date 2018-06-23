<?php

$fp = fopen ('/var/www/sites/www/ivannikitin.ru/ao/order/info', "a+");

fwrite ($fp, "---". "\n");
fwrite ($fp, "Запуск ".Date("d.m.Y H:i:s"). "\n");

require_once("/var/www/sites/www/ivannikitin.ru/ao/smsu/transport.php");

$stmp = time() - 61;

$date_now = date("Y-m-d H:i") . ":00";
$date_old = date("Y-m-d H:i", $stmp) . ":00";

/**
 * Список существующих в системе счетов
 */

if( $curl = curl_init() )
{
    // Массив с GET параметрами запроса
    $array_query = array(

        // API KEY
        'key' => 'ce2f0767503576361a32fcf160b84b29',

        // Передаем критерии поиска
        'search[creation_date_start]' => $date_old, // Дата создания счета От
        'search[creation_date_end]' => $date_now, // Дата создания счета До

        // Передаем настройки сортировки
        'param[sort]'=>'date_of_order ASC', // Сортируем по возрастанию. Поле: Дата создания счета

        // Указываем дополнительные настройки выборки
        //'param[pagesize]'=>'1000', // Выводить по 10 элементов на стройке
        //'param[currentpage]'=>'2', // Показать 2-ю строку

    );

    //fwrite($fp, "От " . $date_old . "\n");
    //fwrite($fp, "До " . $date_now . "\n");


    curl_setopt($curl, CURLOPT_URL, 'https://ivannikitin.autoweboffice.ru/?r=api/rest/accounts&'.http_build_query($array_query));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    $out_json = curl_exec($curl);

    curl_close($curl);

    // Декодирует JSON строку в объект с данными
    $out_obj = json_decode($out_json);

    $sent = 0; // Кол-во отправленных смс
    // Если получили объект с данными, то отправляем смс
    if(is_array($out_obj)) {
        //echo $out_json;
        //exit();
        //}

        fwrite($fp, count($out_obj) . "\n");

        // Вывод полученных данных в окне браузера
        foreach ($out_obj as $key => $obj) {
            $status = $obj->id_account_status;
            $smsTo = $obj->phone_number;
            $smsText = "Благодарим за Ваш заказ в обучающем Проекте Ивана Никитина. Вся информация выслана Вам на e-mail. Если письма долго нет, проверьте папку 'Спам', возможно оно там. С уважением, команда проекта.";

            if ($status == 1) {

                $result = sendSMS($smsTo, $smsText);
                fwrite($fp, "Смс №" . $sent . "; телефон: " . $smsTo . "\n");
                $sent++;
            }
        }

    }

    fwrite ($fp, "Отправлено смс: ".$sent."\n");
    fwrite ($fp, "---" . "\n". "\n");
    fclose ($fp);
}

?>
