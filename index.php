<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new GuzzleHttp\Client();

$res = $client->get('http://192.168.33.10/response.php');

$body = $res->getBody();

echo $body->getContents();
