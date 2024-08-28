<?php
use LaravelNews\Feed\Api;
 
require __DIR__.'/vendor/autoload.php';
 
$response = (new Api)->json();
 print_r($response['items']['items']);
echo "The Laravel-News.com feed has returned ".count($response['items']['items'])." items.\n";