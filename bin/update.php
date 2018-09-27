#!/usr/bin/env php
<?php

// Basic script utilizing MaxCDN PHP client to make a PUT request to update an existing SSL certificate'
// See README.md for setup and usage instructions

// Autoload
require __DIR__ . '/../vendor/autoload.php';

// Load .env variables
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

// MaxCDN API credentials
$alias = getenv('MAXCDN_ALIAS');
$key = getenv('MAXCDN_KEY');
$secret = getenv('MAXCDN_SECRET');

// Certificate details
$id = 12345;
$domainName = 'example.com';
$privateKey = file_get_contents(__DIR__ . '/../certificates/example.com.key');
$certificate = file_get_contents(__DIR__ . '/../certificates/example.com.crt');
$caBundle = file_get_contents(__DIR__ . '/../certificates/example.com.fullchain.crt');

// Build params for API request
$params = [
    'ssl_key' => $privateKey,
    'ssl_crt' => $certificate,
    'ssl_cabundle' => $caBundle,
    'name' => $domainName,
    'force' => 1
];

try {

    // MaxCDN API Client
    $client = new MaxCDN($alias, $key, $secret);

    // Output
    echo "Updating certificate for " . $domainName . PHP_EOL;

    // PUT request to https://rws.maxcdn.com/{companyalias}/ssl.json
    $response = json_decode($client->put('/ssl.json/'.$id, $params));

    // Output
    echo "Response code: " . $response->code . PHP_EOL;

    // Update should return 200 on success
    if ($response->code != 200) {
        throw new Exception('An error occurred:' . $response->error->message . json_encode($response));
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}
