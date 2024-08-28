<?php

namespace LaravelNews\Feed;

class NewsChecker
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function latestArticle(): array
    {
        $response = $this->api->json();
        $items = $response['items']['items'] ?? [];

        if (empty($items)) {
            throw new \Exception("Unable to retrieve the latest article from Laravel-News.com");
        }

        usort($items, function ($a, $b) {
            return strtotime($b['date_published']) - strtotime($a['date_published']);
        });
        return $items[0];
    }
}