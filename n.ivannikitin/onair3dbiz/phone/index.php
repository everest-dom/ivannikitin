<?php

$pageSize = 50;

/* Все комментарии */
require_once("../config.php");

$_SESSION['phone-login'] = !isset($_SESSION['phone-login'])? '' : $_SESSION['phone-login'];
$_SESSION['phone-password'] = !isset($_SESSION['phone-password'])? '' : $_SESSION['phone-password'];

if(isset($_GET['login']) && isset($_GET['password']))
{
    $_SESSION['phone-login'] = $_GET['login'];
    $_SESSION['phone-password'] = $_GET['password'];
    Header('Location: ' . $config['translation']['page_url'] . 'phone');
}
else
{
    if($_SESSION['phone-login'] != $config['phones']['page_login'] && $_SESSION['phone-password'] != $config['phones']['page_password'])
        die($config['error']['phones_page']);
}

$mysqli = new mysqli($config['db']['host'], $config['db']['db_login'], $config['db']['db_password'], $config['phones']['db_name']);

if ($mysqli->connect_errno) {
    printf("Ошибка соединения: %s\n", $mysqli->connect_error);
    exit();
}

$mysqli->query('SET NAMES utf8');

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$startPage = $currentPage > 10 ? $currentPage - 10 : 1;
$endPage = $currentPage + 10;

$table_name = isset($_GET['day']) && $_GET['day'] == 'tomorrow' ? '3dbiz' : '3dbiz_today';

$result = $mysqli->query('SELECT * FROM ' . $table_name . ' ORDER BY id DESC LIMIT ' . ($pageSize * ($currentPage - 1)) . ', ' . $pageSize);
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$config['translation']['name']?></title>
    <link type="text/css" href="../css/commentsnew.css" rel="stylesheet" />
</head>

    <body>
    <h1 class="update">Телефоны <a href="">обновить страницу</a></h1>

    <p>
    <form action="" method="get">
        <select name="day" id="">
            <option value="today">Таблица Сегодня</option>
            <option <? if(isset($_GET['day']) && $_GET['day'] == 'tomorrow'): ?>selected="selected"<? endif; ?> value="tomorrow">Таблица Завтра</option>
        </select>
        <input type="submit" value="Применить фильтры" />
    </form>
    </p>

    <table class="comment-table">
        <tr>
            <th>ID</th>
            <th>Дата добавления</th>
            <th>Телефон</th>
            <th>Обработан</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>
                <td><?=$row['id']?></td>
                <td><?=date('d.m.Y в H:i', strtotime($row['date']))?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['status'] == 1?'Да':'Нет'?></td>
            </tr>

        <?php } ?>

        </table>

        <div style="clear: both;"></div>

        <div class="pagination">
        <? for($i = $startPage; $i < $endPage; $i++): ?>
            <? if($currentPage == $i): ?>
                <span class="pageCurrent"><?=$i?></span>
            <? else: ?>
                <a class="pageLink" href="/onair3dbiz/phone/?page=<?=$i?>"><?=$i?></a>
            <? endif; ?>
        <? endfor; ?>
        </div>

    </body>

</html>