<?php

namespace WijayaPay;

class Config
{
    /**
     * @var string
     */
    private $merchantCode;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var bool
     */
    private $isProduction;

    /**
     * @param string $merchantCode
     * @param string $apiKey
     * @param bool $isProduction
     */
    public function __construct(string $merchantCode, string $apiKey, bool $isProduction = true)
    {
        $this->merchantCode = $merchantCode;
        $this->apiKey = $apiKey;
        $this->isProduction = $isProduction;
    }

    /**
     * @return string
     */
    public function getMerchantCode(): string
    {
        return $this->merchantCode;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return $this->isProduction;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->isProduction
            ? 'https://wijayapay.com/api/'
            : 'https://sandbox.wijayapay.com/api/';
    }
}
