<?php

namespace WijayaPay\Utils;

class Signature
{
    /**
     * Generate X-Signature for WijayaPay API.
     * Formula: md5(code_merchant + api_key + ref_id)
     *
     * @param string $merchantCode
     * @param string $apiKey
     * @param string $refId
     * @return string
     */
    public static function generate(string $merchantCode, string $apiKey, string $refId): string
    {
        return md5($merchantCode . $apiKey . $refId);
    }
}
