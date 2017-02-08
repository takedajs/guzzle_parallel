<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;

$client = new Client([
    'base_url' => 'http://192.168.33.10',
]);

$api_data = [
    "no_1" => "/api.php?no=1",
    "no_2" => "/api.php?no=2",
    "no_3" => "/api.php?no=3",
];

// ベンチマークstart
//$time_start = microtime(true);

foreach ($api_data as $key => $url) {
    $res[$key] = $client->createRequest('GET', $url);
    $res[$key]->getConfig()->set("key", $key);
}

$results = [];
$client->sendAll($res, [
    'parallel' => 5,
    'complete' => function (CompleteEvent $event) use (&$results) {
        $key = $event->getRequest()->getConfig()->get('key');
        $results[$key] = $event->getResponse()->getBody()->getContents();
    }
]);

// ベンチマークfinish
//$time = microtime(true) - $time_start;
//echo $time . "秒 <br />";

var_dump($results);