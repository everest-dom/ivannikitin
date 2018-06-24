<?php

/*ini_set("display_errors",1);
error_reporting(E_ALL);*/

$ref = $_SERVER['HTTP_REFERER'];

if(!empty($_POST["email"]) && !empty($_POST['webform_id']))
{

    $name = htmlspecialchars(isset($_POST["name"]) ? $_POST["name"] : '');
    $email = htmlspecialchars($_POST["email"]);
    $phone = !empty($_POST["phone"]) ? htmlspecialchars($_POST["phone"]) : '';
    $form_id = htmlspecialchars($_POST['webform_id']);

    setcookie ("name", $name, time()+3600*100, "/");
    setcookie ("email", $email, time()+3600*100, "/");
    setcookie ("phone", $phone, time()+3600*100, "/");

    ?>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#getresponse-form').submit();
        })
    </script>
    <!--  old gr vBrY-->
    <form name="getresponse-form" accept-charset="utf-8" action="http://www.email.ivannikitin.ru/add_contact_webform.html?u=M4lE" method="post" id="getresponse-form">
        <? if(!empty($name)): ?>
            <input class="wf-input wf-req wf-valid__required" name="name" id="custom_name" type="hidden" value="<?=$name; ?>" />
        <? endif; ?>
        <input class="wf-input wf-req wf-valid__email" type="hidden" name="email" value="<?=$email; ?>" />
        <? if(!empty($phone)): ?>
            <input class="wf-input wf-req wf-valid__required" name="custom_phone" id="custom_tel" type="hidden" value="<?=$phone; ?>" />
        <? endif; ?>
        <input type="hidden" name="custom_http_referer" value="<?=$ref?>">
        <input type="hidden" name="webform_id" value="<?=$form_id?>" />
        <input type="hidden" name="thankyou_url" value="https://ivannikitin.ru/lessonweb/"/>
    </form>
    <script type="text/javascript" src="http://app.getresponse.com/view_webform.js?wid=<?=$form_id?>&mg_param1=1&u=vBrY"></script>

    <?
}
else
    Header("Location: " . $ref);

?>