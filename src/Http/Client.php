<?php

namespace WijayaPay\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use WijayaPay\Config;

class Client
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var GuzzleClient
     */
    private $httpClient;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new GuzzleClient([
            'base_uri' => $config->getBaseUrl(),
            'timeout' => 30,
        ]);
    }

    /**
     * Send a POST request to the API.
     *
     * @param string $endpoint
     * @param array $data
     * @param array $headers
     * @return array
     * @throws \Exception
     */
    public function post(string $endpoint, array $data = [], array $headers = []): array
    {
        // Add default parameters to body
        $payload = array_merge([
            'code_merchant' => $this->config->getMerchantCode(),
            'api_key' => $this->config->getApiKey(),
        ], $data);

        // Prepare headers
        $defaultHeaders = [
            'Content-Type' => 'application/x-www-form-urlencoded', // Doc says x-www-form-urlencoded for request
            'Accept' => 'application/json',
            'User-Agent' => 'WijayaPay-PHP/1.0',
        ];

        $options = [
            'form_params' => $payload, // Guzzle uses form_params for x-www-form-urlencoded
            'headers' => array_merge($defaultHeaders, $headers),
        ];

        return $this->request('POST', $endpoint, $options);
    }

    /**
     * Send a GET request to the API.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @param array $headers
     * @return array
     * @throws \Exception
     */
    public function get(string $endpoint, array $queryParams = [], array $headers = []): array
    {
        // Add default parameters to query params
        $query = array_merge([
            'code_merchant' => $this->config->getMerchantCode(),
            'api_key' => $this->config->getApiKey(),
        ], $queryParams);

        $defaultHeaders = [
            'Accept' => 'application/json',
            'User-Agent' => 'WijayaPay-PHP/1.0',
        ];

        $options = [
            'query' => $query,
            'headers' => array_merge($defaultHeaders, $headers),
        ];

        return $this->request('GET', $endpoint, $options);
    }

    /**
     * Send request to the API.
     *
     * @param string $method
     * @param string $endpoint
     * @param array $options
     * @return array
     * @throws \Exception
     */
    private function request(string $method, string $endpoint, array $options): array
    {
        try {
            $response = $this->httpClient->request($method, $endpoint, $options);
            $body = (string) $response->getBody();
            $json = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON response: ' . $body);
            }

            return $json;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $msg = 'API Request Error: ' . $e->getMessage();
            if ($e->hasResponse()) {
                $msg .= "\nResponse: " . (string) $e->getResponse()->getBody();
            }
            throw new \Exception($msg, $e->getCode(), $e);
        } catch (GuzzleException $e) {
            throw new \Exception('API Request Error: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}
