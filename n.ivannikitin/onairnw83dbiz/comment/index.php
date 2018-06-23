<?php

require_once("../config.php");

ini_set("display_errors",1);
error_reporting(E_ALL);

$_SESSION['login'] = !isset($_SESSION['login'])? '' : $_SESSION['login'];
$_SESSION['password'] = !isset($_SESSION['password'])? '' : $_SESSION['password'];

if(isset($_GET['login']) && isset($_GET['login']))
{
    $_SESSION['login'] = $_GET['login'];
    $_SESSION['password'] = $_GET['password'];
    Header('Location: ' . $config['translation']['page_url'] . 'comment');
}
else
{
    if($_SESSION['login'] != $config['comments']['page_login'] && $_SESSION['password'] != $config['comments']['page_password'])
        die($config['error']['comments_page']);
}

$mysqli = new mysqli($config['db']['host'], $config['db']['db_login'], $config['db']['db_password'], $config['db']['db_name']);

if ($mysqli->connect_errno) {
    printf("Ошибка соединения: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query('SET NAMES utf8');

if(isset($_GET['datefilter']))
    setcookie ('web_comment_date', htmlspecialchars($_GET['datefilter']), time() + 3600 * 24);

$dateFilter = '';

if(isset($_COOKIE['web_comment_date']) && !empty($_COOKIE['web_comment_date']))
    $dateFilter = $_COOKIE['web_comment_date'];
if(isset($_GET['datefilter']))
    $dateFilter = htmlspecialchars($_GET['datefilter']);

$dateFilterString = !empty($dateFilter) ? 'WHERE date >= "' . date('Y-m-d', strtotime($dateFilter)) . ' 00:00:00" AND date <= "' . date('Y-m-d', strtotime($dateFilter)) . ' 23:59:59"': '';

$commonQuery = 'SELECT COUNT(*) FROM users ' . $dateFilterString;
$commonResult = $mysqli->query($commonQuery);
$commonRow = $commonResult->fetch_row();
$max_items = $commonRow[0];
$max_pages = round($max_items / $config['comments']['per_page']);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$startPage = $currentPage > 10 ? $currentPage - 10 : 1;
$endPage = ($currentPage + 10) > $max_pages ? $max_pages : $currentPage + 10;

$query = 'SELECT * FROM users ' . $dateFilterString . ' ORDER BY date DESC LIMIT ' . ($config['comments']['per_page'] * ($currentPage - 1)) . ', ' . $config['comments']['per_page'];
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$config['translation']['name']?></title>

    <link type="text/css" href="<?=$config['translation']['page_url']?>css/vendor/classic.css" rel="stylesheet" />
    <link type="text/css" href="<?=$config['translation']['page_url']?>css/vendor/classic.date.css" rel="stylesheet" />
    <link type="text/css" href="<?=$config['translation']['page_url']?>css/commentsnew.css" rel="stylesheet" />

    <script type="text/javascript" src="<?=$config['translation']['page_url']?>js/vendor/jquery.js"></script>
    <script type="text/javascript" src="<?=$config['translation']['page_url']?>js/vendor/picker.js"></script>
    <script type="text/javascript" src="<?=$config['translation']['page_url']?>js/vendor/picker.date.js"></script>
    <script type="text/javascript" src="<?=$config['translation']['page_url']?>js/admin.js"></script>

</head>

    <body>
    <h1 class="update">Комменатрии <a href="">обновить страницу</a></h1>

    <p>
        <form action="" method="get">
            <input type="text" class="datepicker" value="<?=$dateFilter?>" name="datefilter" />
            <input type="submit" value="Применить фильтры" />
        </form>
    </p>

    <? if($result->num_rows > 0): ?>

    <div class="pagination">
        <? for($i = $startPage; $i <= $endPage; $i++): ?>
            <? if($currentPage == $i): ?>
                <span class="pageCurrent"><?=$i?></span>
            <? else: ?>
                <a class="pageLink" href="<?=$config['translation']['page_url']?>comment/?page=<?=$i?>"><?=$i?></a>
            <? endif; ?>
        <? endfor; ?>
    </div>

        <br><br>

    <table class="comment-table">
        <tr>
            <th>ID</th>
            <th>Дата чекина</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>E-mail</th>
            <th>Комментарии с вебинара</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <? $resultComments = $mysqli->query('SELECT * FROM comments WHERE email = "' . $row['email'] . '" ORDER BY date ASC'); ?>

            <tr>
                <td><?=$row['id']?></td>
                <td><?=date('d.m.Y в H:i', strtotime($row['date']))?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['email']?></td>

                <td>
                    <?php while ($rowComment = $resultComments->fetch_assoc()) { ?>
                        <p><?=date('H:i', strtotime($rowComment['date']))?>: <?=$rowComment['comment']?></p>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div class="pagination">
    <? for($i = $startPage; $i <= $endPage; $i++): ?>
        <? if($currentPage == $i): ?>
            <span class="pageCurrent"><?=$i?></span>
        <? else: ?>
            <a class="pageLink" href="<?=$config['translation']['page_url']?>comment/?page=<?=$i?>"><?=$i?></a>
        <? endif; ?>
    <? endfor; ?>
    </div>

    <? else: ?>

    <p>Записей не найдено</p>

    <? endif; ?>

    </body>

</html>