<?php

$pageSize = 20;

/* Все комментарии */
require_once("../config.php");

$mysqli = new mysqli($config['db']['host'], $config['db']['db_login'], $config['db']['db_password'], $config['db']['db_name']);

if ($mysqli->connect_errno) {
    printf("Ошибка соединения: %s\n", $mysqli->connect_error);
    exit();
}

$mysqli->query('SET NAMES utf8');

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$startPage = $currentPage > 10 ? $currentPage - 10 : 1;
$endPage = $currentPage + 10;

$result = $mysqli->query('SELECT * FROM ' . $config['db']['tables']['comments'] . ' ORDER BY id DESC LIMIT ' . ($pageSize * $currentPage) . ', ' . $pageSize);
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$config['translation']['name']?></title>
    <link type="text/css" href="../css/comments.css" rel="stylesheet" />
</head>

    <body>
    <h1 class="update">Комменатрии <a href="">обновить страницу</a></h1>

    <div class="comments">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="comments__item">
                <div class="comments-item__name">
                    <?=$row['name']?>
                    <? if(!empty($row['email'])): ?>
                        <span class="comments-item__email">[E-mail: <strong><?=$row['email']?></strong>, </span>
                    <? endif; ?>
                    <? if(!empty($row['phone'])): ?>
                        <span class="comments-item__phone">Телефон: <strong><?=$row['phone']?></strong>]</span>
                    <? endif; ?>
                </div>

                <div class="comments-item__date"><?=$row['date']?></div>

                <div class="comments-item__comment"><?=$row['comment'];?></div>
            </div>
        <?php } ?>
    </div>

    <div class="pagination">
    <? for($i = $startPage; $i < $endPage; $i++): ?>
        <? if($currentPage == $i): ?>
            <span class="pageCurrent"><?=$i?></span>
        <? else: ?>
            <a class="pageLink" href="/onair3dbiz/comments/?page=<?=$i?>"><?=$i?></a>
        <? endif; ?>
    <? endfor; ?>
    </div>

    </body>

</html>