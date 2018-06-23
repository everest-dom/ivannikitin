<?php

/*ini_set("display_errors",1);
error_reporting(E_ALL);*/

require_once("/var/www/sites/www/n.ivannikitin.ru/web/ao/smsu/transport.php");

$file_path = '/var/www/sites/www/n.ivannikitin.ru/web/ao/onair_callme_dictionary';

// DB Init
$mysqli = new mysqli("localhost", "root", "a21081a98c", "is_nw17");
if ($mysqli->connect_errno) {
    file_put_contents ($file_path, "Connect failed: %s\n". $mysqli->connect_error. "\n", FILE_APPEND);
    exit();
}

// Save phone number
if(isset($_REQUEST["save_phone"]))
{
    $tableName = $_REQUEST['today'] == 1 ? '3dbiz_today' : '3dbiz';

    if (isset($_REQUEST["phone"]) && !empty($_REQUEST["phone"]))
        if ($mysqli->query("INSERT INTO `".$tableName."` (`date`, `phone`, `status`) VALUES (NOW(), ".preg_replace('/[^0-9]/', '', $_REQUEST["phone"]).", 0);") !== TRUE)
			file_put_contents ($file_path, $mysqli->error . "\n", FILE_APPEND);

    return true;
}
// Send notifications
else //php_sapi_name()=='cli'
{
    if(isset($_REQUEST["run_votbox"])) {
        // Init votbox system
        require_once "/var/www/sites/www/n.ivannikitin.ru/web/lbs/votbox/lib.php";
        $votbox = new votbox();
    }

    if(isset($_REQUEST["run_votbox"])) {

        // Today sending
        file_put_contents ($file_path, "start calling! at " . Date("d.m.Y H:i:s") . " from onair pages TODAY\n", FILE_APPEND);

    } else {

        // Params
        $smsText = "Начало вебинара 'Бизнес на 3D-визуализации' через 30 минут, в 20-00 по Москве. Заходите по ссылке http://9901.ru/1";

        // Today sending
        file_put_contents ($file_path, "start send sms " . Date("d.m.Y H:i:s") . " from onair pages (FOR TODAY) \n", FILE_APPEND);

    }

    // Select all numbers form 3dbiz_today
    $numbers = [];
    $query = "SELECT phone, id FROM 3dbiz_today WHERE status = 0 AND date >= '" . Date("Y-m-d", strtotime('-1 day')) . " 20:00:00' AND date < '" . Date("Y-m-d") . " 20:00:00'";
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_assoc($result))
    {
        $numbers[] = [
            "phone" => $row['phone'],
            "id" => $row['id']
        ];
    }

    echo "<pre>";
    var_dump($numbers);
    echo "</pre>";

    // Send notifications & log it
    foreach($numbers as $number)
    {
        // Check number
        if (!empty($number['phone']) && !empty($number['id']))
        {
            if(isset($_REQUEST["run_votbox"])) {

                // Save to votbox file list
                $votbox->saveToFile($number['phone']);

            } else {

                // Send SMS
                $result = sendSMS($number['phone'], $smsText);
                // Update number state
                $mysqli->query("UPDATE 3dbiz_today SET status = 1 WHERE id = " . $number['id']);

                // Update DB item & log it
                file_put_contents ($file_path, "#SMS_3dbizToday " . var_export($result,true) . "\n", FILE_APPEND);

            }
        }
    }

    if(isset($_REQUEST["run_votbox"])) {

        // Today sending
        file_put_contents ($file_path, "start calling! at " . Date("d.m.Y H:i:s") . " from onair pages TOMORROW\n", FILE_APPEND);

    } else {

        // Tomorrow sending
        file_put_contents($file_path, "start send sms " . Date("d.m.Y H:i:s") . " from onair pages \n", FILE_APPEND);

    }

    // Select all numbers from 3dbiz (tomorrow)
    $numbers = [];
    $query = "SELECT phone, id FROM 3dbiz WHERE status = 0 AND date >= '" . Date("Y-m-d", strtotime('-1 day')) . " 00:00:00' AND date < '" . Date("Y-m-d", strtotime('-1 day')) . " 23:59:59'";
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_assoc($result))
    {
        $numbers[] = [
            "phone" => $row['phone'],
            "id" => $row['id']
        ];
    }

    //Send notifications & log it
    foreach($numbers as $number)
    {
        // Check phone number
        if (!empty($number['phone']) && !empty($number['id']))
        {
            if(isset($_REQUEST["run_votbox"])) {

                // Save to votbox file list
                $votbox->saveToFile($number['phone']);

            } else {

                // Send SMS
                $result = sendSMS($number['phone'], $smsText);
                // Update number state
                $mysqli->query("UPDATE 3dbiz SET status = 1 WHERE id = " . $number['id']);

                // Update DB item & log it
                file_put_contents ($file_path, "#SMS_3dbiz " . var_export($result,true) . "\n", FILE_APPEND);

            }
        }
    }

    if(isset($_REQUEST["run_votbox"])) {

        // Create votbox task & run it
        $result = $votbox->autocall(['schemeid' => '18764359', 'isPaused' => '1',]);
        $startResult = $votbox->start($result->data->obj['id']);
        $votbox->reset();

    }

}
?>