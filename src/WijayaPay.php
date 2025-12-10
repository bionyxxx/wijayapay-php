<?php

namespace WijayaPay;

use WijayaPay\Http\Client;
use WijayaPay\Resources\Payment;
use WijayaPay\Resources\Transaction;

class WijayaPay
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->client = new Client($config);
    }

    /**
     * @return Payment
     */
    public function payment(): Payment
    {
        return new Payment($this->client);
    }

    /**
     * @return Transaction
     */
    public function transaction(): Transaction
    {
        return new Transaction($this->client);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}
