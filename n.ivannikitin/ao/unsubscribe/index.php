<?php

date_default_timezone_set('UTC');

// ini_set("display_errors",1);
// error_reporting(E_ALL);

$userId = isset($_GET['u']) ? $_GET['u'] : '';

$contacts = new ArrayObject();
$unsub = false;

if(!empty($userId))
{
    require_once $_SERVER['DOCUMENT_ROOT'] . "/web/lbs/getresponse/gr.php";

    $api_key = "abc3208a3eaef447bc9920db1aedc2a6";
    $domain = "email.ivannikitin.ru";

    $api_url = "https://api3.getresponse360.pl/v3";
    $gr = new GetResponse($api_key);
    $gr->api_url = $api_url;
    $gr->enterprise_domain = $domain;

    $contactData = $gr->getContact($userId);

    if(!empty($contactData) && isset($contactData->email)):

        if(isset($_POST['campaign']) && !empty($_POST['campaign']))
        {
            foreach($_POST['campaign'] as $campaignId) {
                $delContacts = $gr->getContacts([
                    'query' => [
                        'email' => $contactData->email,
                        'campaignId' => $campaignId,
                    ],
                ]);

                $contact = current($delContacts);
                $contactId = $contact->contactId;

                $result = $gr->deleteContact($contactId);

                $unsub = true;
            }
        }

        $contacts = $gr->getContacts([
            'query' => [
                'email' => $contactData->email,
            ],
        ]);

    endif;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Отписка от рассылки</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>

    <div class="container">
        <div class="col-md-5 centered col-md-offset-4 content">
            <img class="image" src="https://ivannikitin.ru/wp-content/themes/ivannikitin/images/logo.png" alt="">
            <h1 class="title">Отмена подписки</h1>
            <? if(!$unsub): ?>
                <? if(!empty((array) $contacts)): ?>
                    <h3>Выберите рассылки для отписки:</h3>
                    <form action="" method="post">
                        <div class="unsubscribe">
                            <div class="checkbox">
                                <label>
                                    <input id="all_campaigns" name="" type="checkbox" value="all">
                                    Отписать от всех кампаний
                                </label>
                            </div>
                            <hr>
                            <? foreach($contacts as $contact): ?>
                                <div class="checkbox">
                                    <label>
                                        <input class="campaignCheckbox" name="campaign[]" type="checkbox" value="<?=$contact->campaign->campaignId?>">
                                        <?=$contact->campaign->name?>
                                    </label>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-danger btn-lg" value="Отписаться">
                    </form>
                <? else: ?>
                    <h3>Вы не подписаны на рассылки!</h3>
                <? endif; ?>
            <? else: ?>
                <h3>Вы отписались от рассылки!</h3>
            <? endif; ?>
        </div>
    </div>

</body>
</html>
