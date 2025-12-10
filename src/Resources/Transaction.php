<?php

namespace WijayaPay\Resources;

use WijayaPay\Http\Client;
use WijayaPay\Utils\Signature;

class Transaction
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Create a new transaction.
     *
     * @param array $data
     *  - ref_id (required)
     *  - code_payment (required)
     *  - nominal (required)
     * @return array
     * @throws \Exception
     */
    public function create(array $data): array
    {
        if (empty($data['ref_id'])) {
            throw new \InvalidArgumentException('ref_id is required');
        }

        // Generate Signature
        // usage: md5(code_merchant + api_key + ref_id)
        $config = $this->client->getConfig();
        $signature = Signature::generate(
            $config->getMerchantCode(),
            $config->getApiKey(),
            $data['ref_id']
        );

        // Headers
        $headers = [
            'X-Signature' => $signature,
        ];

        // Endpoint: /api/transaction/create
        return $this->client->post('transaction/create', $data, $headers);
    }
}
