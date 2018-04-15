<?php

namespace Dashboard\Widget\Weather\Provider;

use Dashboard\Widget\Weather\Transformer\DarkSkyTransformer;
use GuzzleHttp\Client;

/**
 * Dark Sky weather provider
 */
class DarkSkyProvider extends AbstractProvider implements ProviderInterface
{
    const BASE_API_URL = 'https://api.darksky.net';

    /**
     * @var DarkSkyTransformer
     */
    private $transformer;

    /**
     * @var Client
     */
    private $client;

    private $forecast;

    private $apiKey;

    public function __construct(DarkSkyTransformer $transformer, string $apiKey)
    {
        $this->transformer = $transformer;
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritDoc}
     */
    protected function getCurrentWeather(): string
    {
        $currentWeather = $this->forecast['currently']['icon'] ?? null;

        if (null !== $currentWeather) {
            return $this->transformer->transformWeather($currentWeather);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    protected function getCurrentTemperature(): float
    {
        $temperature = $this->forecast['currently']['temperature'] ?? null;

        if (null !== $temperature) {
            return $this->transformer->transformTemperature($temperature);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPrecipitationProbabilityUntilEndOfDay(): int
    {
        throw new \Exception('Not implemented yet');
    }

    /**
     * {@inheritDoc}
     */
    protected function fetchForecast(float $latitude, float $longitude)
    {
        if (!$this->forecast) {
            $response = $this->getApiClient()->request(
                'GET',
                sprintf('/forecast/%s/%F,%F', $this->apiKey, $latitude, $longitude)
            );

            $this->forecast = json_decode($response->getBody(), true);
        }
    }

    private function getApiClient(): Client
    {
        if (!isset($this->client)) {
            $this->client = new Client(['base_uri' => self::BASE_API_URL]);
        }

        return $this->client;
    }
}
