<?php

if(isset($_POST["region"]) && isset($_POST["token"]) && isset($_POST["thanks"])):
    $fp = fopen ('/var/www/sites/www/ivannikitin.ru/ao/detect/info', "a+");
    fwrite ($fp, "Region: " . $_POST["region"] . "\nToken: " . $_POST['token'] . "\nThanks: " . $_POST['thanks'] . "\nTime: " . Date("d.m.Y H:i:s") . "\n\n");
endif;
exit;