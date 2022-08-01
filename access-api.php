<?php
$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.github.com/gists/7e191d62ffa9e493c69cf6ba79001889",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => "myat-su-mon"
]);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response, true);

print_r($data);
// foreach ($data as $gist) {
//     echo $gist["id"], " - " , $gist["description"], "\n";
// }


?> 