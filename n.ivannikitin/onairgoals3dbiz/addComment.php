<?php

require_once("config.php");

if(!empty($_POST["comment"]))
{

    $comment = htmlspecialchars($_POST["comment"]);
    $name = htmlspecialchars($_COOKIE["on_air_name"]);
    $phone = htmlspecialchars($_COOKIE["on_air_phone"]);
    $email = htmlspecialchars($_COOKIE["on_air_email"]);

    $mysqli = new mysqli($config['db']['host'], $config['db']['db_login'], $config['db']['db_password'], $config['db']['db_name']);

    if ($mysqli->connect_errno) {
        echo "Ошибка добавления комментария";
        //printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $mysqli->query('SET NAMES utf8');


    if($result = $mysqli->query('INSERT INTO '.$config['db']['tables']['comments'].' (date, name, phone, email, comment) VALUES ("'.date("Y-m-d H:i:s").'", "'.$name.'", "'.$phone.'", "'.$email.'", "'.$comment.'")'))
        echo "OK";
    else
        echo "Ошибка добавления";

    $mysqli->close();
}
else
{
    echo "Не введен комментарий";
}


?>