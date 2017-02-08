<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;

$client = new Client();
$client->sendAll(requestGenerator($client), [
    'parallel' => 5,
    'complete' => function (CompleteEvent $event) {
        echo $event->getResponse()->getBody()->getContents() . "<br />";
    }
]);

function requestGenerator($client) {
    for ($i = 0; $i < 5; $i++) {
        yield $client->createRequest('GET', 'http://192.168.33.10/response.php');
    }
}


