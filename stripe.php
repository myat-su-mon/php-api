<?php

$api_key = "sk_test_4eC39HqLyjWDarjtT1zdp7dc";

$data = [
    "name" => "Bob",
    "email" => "bob@example.com"
];

require __DIR__ . "/vendor/autoload.php";

$client = new \Stripe\StripeClient($api_key);

$customer = $client->customers->create($data);

echo $customer;

/*
$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.stripe.com/v1/customers",
    CURLOPT_RETURNTRANSFER => true, 
    CURLOPT_USERPWD => $api_key, 
    CURLOPT_POSTFIELDS => http_build_query($data)
]);

$response = curl_exec($ch);

curl_close($ch);

echo $response;
*/
?> 