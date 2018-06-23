<?php

require_once("config.php");

$items = [];
$currentTime = time();
$endTime = strtotime($config['translation']['end']);

if($currentTime >= $endTime) {
    echo "OK";
    exit;
}

foreach($config['events'] as $event_key => $event)
{
    $from = strtotime(date('d.m.Y') . ' ' . $event['from']);
    $till = strtotime(date('d.m.Y') . ' ' . $event['till']);
    /*echo 'current time: ' . $currentTime . "<br />";
    echo 'from time: ' . $from . "<br />";
    echo 'till time: ' . $till . "<br />";*/
    if($currentTime >= $from && $currentTime < $till)
    {
        echo $event['text'];
    }
    /*$items[] = [
        'time' => strtotime($event_key),
        'code' => $event['code'],
    ];*/
}

/*for ($i = 0; $i < count($items); $i++)
{
    if($currentTime >= $items[$i]['time'] && $currentTime < $items[$i]['till'])
    {
        echo $items[$i]['code'];
    }
}*/

die();