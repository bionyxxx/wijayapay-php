<?php

namespace WijayaPay\Resources;

use WijayaPay\Http\Client;

class Payment
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
     * Get available payment channels.
     *
     * @return array
     * @throws \Exception
     */
    public function getChannels(): array
    {
        // Endpoint: /api/get-payment
        // Method: GET
        // Params: code_merchant, api_key (handled by Client)

        return $this->client->get('get-payment');
    }
}
