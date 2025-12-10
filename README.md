# WijayaPay PHP Library

This is the official PHP wrapper for the WijayaPay Payment Gateway API.

## Installation

```bash
composer require bionyxxx/wijayapay-php
```

## Usage

### Configuration

```php
use WijayaPay\Config;
use WijayaPay\WijayaPay;

$config = new Config(
    'YOUR_MERCHANT_CODE', // code_merchant
    'YOUR_API_KEY',       // api_key
    true                  // isProduction (true/false)
);

$wijayaPay = new WijayaPay($config);
```

### Get Payment Channels

Get the list of active payment channels.

```php
try {
    $channels = $wijayaPay->payment()->getChannels();
    print_r($channels);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Create Transaction

Create a new payment request.

```php
try {
    $response = $wijayaPay->transaction()->create([
        'ref_id'       => 'ORDER-12345',
        'code_payment' => 'QRIS',
        'nominal'      => 100000,
        // Add other parameters if needed
    ]);

    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### Webhook Handling

Handle incoming callbacks from WijayaPay.

```php
use WijayaPay\Webhook\WebhookHandler;

$handler = new WebhookHandler();

// Get the data
$data = $handler->parse();

// Process your logic here with $data...
// e.g. update transaction status in database

// Return success response to WijayaPay
header('Content-Type: application/json');
echo $handler->successResponse();
```
