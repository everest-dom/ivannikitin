<?php

ini_set("display_errors",1);
error_reporting(E_ALL);

$fp = fopen ('/var/www/sites/www/ivannikitin.ru/ao/fix/info', "a+");

// get URL & phone
$url = "http://ivannikitin.autoweboffice.ru/?r=ordering/cart/"
    . $_GET['cart']
    . "&id=" . $_GET['id']
    . "&dc=" . $_GET['dc']
    . "&clean=true&lg=ru";

$phone = $_GET['phone'];

if(!empty($phone)):

    // Set call
    require_once "/var/www/sites/www/ivannikitin.ru/lbs/votbox/lib.php";
    $votbox = new votbox();
    $filename = 'fix' . rand(1000,9999) . '.csv';
    $votbox->saveToFile($phone, $filename);
    $result = $votbox->autocall(['schemeid' => '18820108', 'isPaused' => '1',], $filename);
    $startResult = $votbox->start($result->data->obj['id']);
    $votbox->reset($filename);

endif;

// Redirect
Header("Location: " . $url);