<?php

namespace App\Services;

use RuntimeException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    private readonly Client $client;

    public function __construct(string $baseUrl)
    {
        $this->client = new Client(['base_url' => $baseUrl]);
    }

    /**
     * Class sendMetricsApi
     * Sends metrics to the API
     */
    public function sendMetricsApi(string $metrics, string $uri): void
    {
        try {
            $response = $this->client->post(trim($uri, '/'), [
                'json' => $metrics,
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new RuntimeException('Error sending metrics '.$response->getBody());
            }
        } catch (GuzzleException $e) {
            throw new RuntimeException('Error requesting '.$e->getMessage(), $e->getCode(), $e);
        }
    }
}
