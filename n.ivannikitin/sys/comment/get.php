<?

$mysqli = new mysqli('localhost', 'root', 'a21081a98c', 'comment');

if ($mysqli->connect_errno) {
    echo "Ошибка добавления комментария";
    exit();
}

$mysqli->query('SET NAMES utf8');
$commentsResult = $mysqli->query('SELECT * FROM `list` WHERE `page` = "' . $_GET['page'] . '" ORDER BY `created` DESC');
$comments = [];
while ($row = $commentsResult->fetch_assoc())
    $comments[] = [
        'name' => empty($row['name']) ? 'Аноним' : $row['name'],
        'text' => str_replace("\n", '<br />', $row['text']),
    ];

echo json_encode($comments);

?>