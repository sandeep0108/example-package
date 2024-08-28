<?php

namespace LaravelNews\Feed;
 
class Api
{
    //Ref: https://laravel-news.com/create-a-php-package-from-scratch
    public function json(): array
    {
        $json = file_get_contents('https://laravel-news.com/feed/json');
 
        return json_decode($json, true);
    }
}
