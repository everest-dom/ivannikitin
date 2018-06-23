<?php

date_default_timezone_set('Europe/Moscow');

$fp = fopen ('/var/www/sites/www/ivannikitin.ru/ao/bill/info', "a+");

fwrite ($fp, "Запуск ".Date("d.m.Y H:i:s"). "\n");

$phone = $_POST['phone_number'];
$canICall = time() >= strtotime(Date("d.m.Y") . " 09:00:00") && time() <= strtotime(Date("d.m.Y") . " 19:00:00");

if(!$canICall):
    fwrite ($fp, "Ограничение с " . Date("d.m.Y") . " 09:00:00" . " по " . Date("d.m.Y") . " 19:00:00" . "\n");
    fwrite ($fp, "Нельзя звонить, время: " . Date("d.m.Y H:i:s"). "\n");
    fwrite ($fp, "Телефон: " . $phone . "\n");
endif;

if(!empty($phone) && $canICall):

    // Set call
    fwrite ($fp, "Set call to " . $phone . "\n");
    require_once "/var/www/sites/www/ivannikitin.ru/lbs/votbox/lib.php";
    $votbox = new votbox();
    $filename = 'bill_' . rand(1000,9999) . '.csv';
    $votbox->saveToFile($phone, $filename);
    $result = $votbox->autocall(['schemeid' => '18820108', 'isPaused' => '1',], $filename);
    $startResult = $votbox->start($result->data->obj['id']);
    $votbox->reset($filename);

endif;

exit;

