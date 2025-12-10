<?php

require __DIR__ . '/../vendor/autoload.php';

use WijayaPay\Config;
use WijayaPay\WijayaPay;

// Replace with your actual credentials
$merchantCode = 'YOUR_MERCHANT_CODE';
$apiKey = 'YOUR_API_KEY';
$isProduction = true; // Set to false for sandbox if available, or just use production as documented

$config = new Config($merchantCode, $apiKey, $isProduction);
$wijayaPay = new WijayaPay($config);

echo "Fetching Payment Channels...\n";

try {
    $response = $wijayaPay->payment()->getChannels();
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
