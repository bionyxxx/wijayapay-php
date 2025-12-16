<?php

require __DIR__ . '/../vendor/autoload.php';

use WijayaPay\Config;
use WijayaPay\WijayaPay;

// Replace with your actual credentials
$merchantCode = 'YOUR_MERCHANT_CODE';
$apiKey = 'YOUR_API_KEY';
$isProduction = true;

$config = new Config($merchantCode, $apiKey, $isProduction);
$wijayaPay = new WijayaPay($config);

echo "Checking Transaction Status...\n";

try {
    // Replace with a valid Reference ID
    $refId = 'ORDER-12345';
    // You might want to update this to a known ref_id if testing against real data, 
    // otherwise 404 is expected if it doesn't exist.

    echo "Ref ID: " . $refId . "\n";

    $response = $wijayaPay->transaction()->checkStatus($refId);

    print_r($response);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
