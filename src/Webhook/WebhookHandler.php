<?php

namespace WijayaPay\Webhook;

class WebhookHandler
{
    /**
     * Parse incoming webhook request.
     *
     * @return array
     */
    public function parse(): array
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }

        return $data;
    }

    /**
     * Generate success response for webhook.
     *
     * @return string
     */
    public function successResponse(): string
    {
        return json_encode(['status' => true]);
    }
}
