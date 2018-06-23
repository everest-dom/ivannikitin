<?php

ini_set("display_errors",1);
error_reporting(E_ALL);

$file_path = '/var/www/sites/www/ivannikitin.ru/st/dict';

// Save phone number
if(isset($_REQUEST["save_phone"]))
{
    echo 1;
    // DB Init
    $mysqli = new mysqli("localhost", "ivannikitinru", "ZDcE7HvgHyOhnacn", "in_system");
    if ($mysqli->connect_errno) {
        file_put_contents ($file_path, "Connect failed: %s\n". $mysqli->connect_error. "\n", FILE_APPEND);
        exit();
    }
echo 2;
    $tableName = 'st';

    if (isset($_REQUEST["phone"]) && !empty($_REQUEST["phone"])) {
        echo 3;
        if ($mysqli->query("INSERT INTO `".$tableName."` (`date`, `phone`, `status`) VALUES (NOW(), ".preg_replace('/[^0-9]/', '', $_REQUEST["phone"]).", 0);") !== TRUE)
			file_put_contents ($file_path, $mysqli->error . "\n", FILE_APPEND);
    }

    return true;
}