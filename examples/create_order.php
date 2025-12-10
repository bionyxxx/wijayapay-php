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

echo "Creating Transaction...\n";

try {
    // Unique Reference ID
    $refId = 'ORDER-' . time();

    $data = [
        'ref_id' => $refId,
        'code_payment' => 'QRIS',
        'nominal' => 100000,
        // Add customer info if needed by API in future
    ];

    print_r($data);
    echo "\nSending request...\n";

    $response = $wijayaPay->transaction()->create($data);

    print_r($response);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
