<?php
use LaravelNews\Feed\Api;
use LaravelNews\Feed\NewsChecker;

it('Returns the latest article on Laravel-News.com',function(){
    $items = [
        [
            'id' => 3648,
            'title' => "Laravel SEO made easy with the Honeystone package",
            'date_published' => "2024-08-20T13:00:00+00:00",
        ],
        [
            'id' => 3650,
            'title' => "LCS #5 - Patricio: Mingle JS,  PHP WASM, VoxPop",
            'date_published' => "2024-08-23T13:00:00+00:00",
        ],
        [
            'id' => 3647,
            'title' => "Laravel Model Tips",
            'date_published' => "2024-08-22T13:00:00+00:00",
        ],
    ];
    $api = Mockery::mock(Api::class);
    $api->shouldReceive('json')->once()->andReturn([
        'title' => 'Laravel News Feed',
        'feed_url' => 'https://laravel-news.com/feed/json',
        'items' => [
            'items' => $items,
        ],
    ]);

    $checker = new NewsChecker($api);
    $article = $checker->latestArticle();

    expect($article['title'])->toBe("LCS #5 - Patricio: Mingle JS,  PHP WASM, VoxPop");
});

it('Throws an exception if no items are returned from the feed', function () {
    $api = Mockery::mock(Api::class);
    $api->shouldReceive('json')->once()->andReturn([
        'title' => 'Laravel News Feed',
        'feed_url' => 'https://laravel-news.com/feed/json',
    ]);

    $checker = new NewsChecker($api);

    expect(/**
     * @throws Exception
     */ function () use ($checker) {
        return $checker->latestArticle();
    })
        ->toThrow(new Exception('Unable to retrieve the latest article from Laravel-News.com'));
});