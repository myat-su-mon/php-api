<?php
$ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = [
    "Authorization: token YOUR_ACCESS_KEY",
    // "User-Agent: myat-su-mon"
];

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.github.com/user/starred/httpie/httpie",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers, 
    CURLOPT_USERAGENT => "myat-su-mon",
    CURLOPT_CUSTOMREQUEST => "PUT"
]);

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

echo $status_code . "\n";

echo $response . "\n";
?> 