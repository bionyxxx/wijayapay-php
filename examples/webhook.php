<?php

require __DIR__ . '/../vendor/autoload.php';

use WijayaPay\Webhook\WebhookHandler;

// Simulate incoming request for testing
// $_POST or php://input would normally be populated
// This script is intended to be run by a webhook caller, or you can test by sending POST to this file.

$handler = new WebhookHandler();

echo "Waiting for webhook...\n";

$data = $handler->parse();

if (!empty($data)) {
    echo "Received Webhook Data:\n";
    print_r($data);
} else {
    echo "No data received or invalid JSON.\n";
}

// Send response
header('Content-Type: application/json');
echo $handler->successResponse();
