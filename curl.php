<?php
$ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = [
    "Authorization: Client-ID ZJyCIzsl-8tSytxwiUVijGUNrtmp7DXyidyJvirpekU"
];

$response_headers = [];

$header_callback = function($ch, $header) use (&$response_headers) {
    $len = strlen($header);
    $parts = explode(":" , $header, 2);
    if(count($parts) < 2) {
        return $len;
    }
    $response_headers[$parts[0]] = trim($parts[1]);
    return $len;
};

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.unsplash.com/photos/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_HEADERFUNCTION => $header_callback
]);

$response = curl_exec($ch);

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

curl_close($ch);

echo $status_code . "\n";
echo $content_type . "\n";
echo $content_length . "\n";
print_r($response_headers);
echo $response . "\n";
?> 