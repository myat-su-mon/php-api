<?php

require __DIR__ ."/vendor/autoload.php";

$client = new GuzzleHttp\Client;

$client->request("GET", "https://api.github.com/user/repos", [
    "headers" => [
        "Authorization" => "token your_token", 
        "User-Agent" => "myat"
    ]
]);

echo $response->getStatusCode(), "\n";

echo $response->getHeader("content-type")[0], "\n";

echo substr($response->getBody(), 0, 200), "...\n";