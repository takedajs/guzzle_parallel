<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

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

$results = [];
foreach ($api_data as $key => $url) {
    $results[$key] = $client->get($url)->getBody()->getContents();

}

// ベンチマークfinish
//$time = microtime(true) - $time_start;
//echo $time . "秒 <br />";

var_dump($results);