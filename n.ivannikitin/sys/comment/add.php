<?php

if(!empty($_POST["text"]))
{

    $text = htmlspecialchars($_POST["text"]);
    $name = htmlspecialchars($_POST["name"]);
    $page = htmlspecialchars($_POST["page"]);

    $mysqli = new mysqli('localhost', 'root', 'a21081a98c', 'comment');

    if ($mysqli->connect_errno) {
        echo "Ошибка добавления комментария";
        exit();
    }

    $mysqli->query('SET NAMES utf8');


    if($result = $mysqli->query('INSERT INTO `list` (`created`, `name`, `text`, `page`) VALUES (NOW(), "'.$name.'", "'.$text.'", "'.$page.'")')) {

        $to  = "ivan@y2m.ru";

        $subject = 'Новый комментарий на странице ' . $page;

        $message = '<h2>Новый комментарий на странице ' . $page . '</h2>' .
        '<p>Дата добавления: ' . date('d.m.Y H:i') . '</p>' .
        '<p>Имя пользователя: ' . (empty($name) ? 'Без имени' : $name) . '</p>' .
        '<p>Текст комментария: ' . $text . '</p>';

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";

        mail($to, $subject, $message, $headers);

        echo "OK";
    }
    else
        echo "Ошибка добавления";

    $mysqli->close();
}
else
{
    echo "Не введен комментарий";
}


?>