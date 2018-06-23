<?

require_once("../smsu/transport.php");

$fp = fopen ($_SERVER['DOCUMENT_ROOT'].'/ao/paid/info', "a+");
if(!$fp) {
    fwrite($fp, error_get_last() . "\r\n");
}

// Получим данные от АвтоОфис'а
$phone = $_REQUEST['phone_number'];

fwrite($fp, $phone . " ");

if(strlen($phone) > 0) {
    $api = new Transport();

    $smsText = "Благодарим за Ваш заказ в обучающем Проекте Ивана Никитина. Вся информация  выслана Вам на e-mail. Если письма долго нет, проверьте папку 'Спам', возможно оно там. С уважением, команда проекта.";
    $smsTo = $phone;

    $params = array(
        "text" => $smsText
    );
    $phones = array($smsTo);
    $send = $api->send($params, $phones);

    //fwrite($fp, $send['code'] . "\n\r");
}

fclose($fp);

echo "200 OK";
die();