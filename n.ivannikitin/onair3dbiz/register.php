<?php

require_once("config.php");

$referer = str_replace('&error', '', $_SERVER['HTTP_REFERER']);

if(!empty($_POST["name"]) && !empty($_POST["phone"]) && !empty($_POST["email"]))
{

    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);

    $mysqli = new mysqli($config['db']['host'], $config['db']['db_login'], $config['db']['db_password'], $config['db']['db_name']);

    if ($mysqli->connect_errno) {
        echo "Ошибка";
        //printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $mysqli->query('SET NAMES utf8');


    $result = $mysqli->query('INSERT INTO '.$config['db']['tables']['users'].' (date, name, phone, email, agent) VALUES ("'.date("Y-m-d H:i:s").'", "'.$name.'", "'.$phone.'", "'.$email.'", "'.$_SERVER['HTTP_USER_AGENT'].'")');

    setcookie ("on_air_name", $name, time()+3600*100);
    setcookie ("on_air_phone", $phone, time()+3600*100);
    setcookie ("on_air_email", $email, time()+3600*100);

    setcookie ("name", $name, time()+3600*100, "/");
    setcookie ("email", $email, time()+3600*100, "/");
    setcookie ("phone", $phone, time()+3600*100, "/");

    $mysqli->close();
    ?>

    <? if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"])): ?>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#getresponse-form").submit();
            });
        </script>
        <form accept-charset="utf-8" action="http://www.email.ivannikitin.ru/add_contact_webform.html?u=M4lE" method="post" id="getresponse-form">
            <input class="wf-input wf-req wf-valid__required" type="hidden" name="name" value="<?=$_POST["name"]; ?>" />
            <input class="wf-input wf-req wf-valid__email" type="hidden" name="email" value="<?=$_POST["email"]; ?>" />
            <input class="wf-input wf-req wf-valid__required" name="custom_phone_mobile" id="custom_tel" type="hidden" value="<?=$_POST["phone"]; ?>" />
            <input type="hidden" name="custom_http_referer" value="<?=$_POST['referrer']?>" />
            <input type="hidden" name="webform_id" value="<?=$config['form']['id']?>" />
        </form>
        <script type="text/javascript" src="http://app.getresponse.com/view_webform.js?wid=<?=$config['form']['id']?>&mg_param1=1&u=vBrY"></script>
    <? else:
        Header("Location: " . $config['translation']['page_url'] . "&error");
       endif;
    ?>

    <?
}
else
    Header("Location: /onair3dbiz/?&error&name=" . $_POST['name'] . "&phone=" . $_POST['phone'] . "&email=" . $_POST['email']);


?>