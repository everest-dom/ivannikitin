<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $date = Date('d.m.Y H:i:s');

    // Отправляем СМС на номер администратора
    $adminPhone = '79375177718';
    require_once("/var/www/sites/www/ivannikitin.ru/ao/smsu/transport.php");
    $smsText = "Новая заявка на сайте. Имя: " . $name . ". Моб.: " . $phone;
    sendSMS($adminPhone, $smsText);

    // Отправляем письмо администратору
    $adminEmail = 'runrender@ivannikitin.ru';
    $subject = "Заявка на странице RunRender";

    $message = '<p>Создана новая заявка на странице RunRender</p>';
    $message .= '<p><strong>Имя:</strong> ' . $name . '</p>';
    $message .= '<p><strong>Телефон:</strong> ' . $phone . '</p>';
    $message .= '<p><strong>E-mail:</strong> ' . $email . '</p>';
    $message .= '<p><strong>Дата отправки:</strong> ' . $date . '</p>';

    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: RunRender page <runrender@ivannikitin.ru>\r\n";

    mail($adminEmail, $subject, $message, $headers);

    echo "OK";
    exit();

}