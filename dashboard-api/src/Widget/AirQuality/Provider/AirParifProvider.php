<?php

namespace Dashboard\Widget\AirQuality\Provider;

use Dashboard\Widget\AirQuality\AirQualityException;
use Dashboard\Widget\AirQuality\Provider\AirQualityProviderInterface;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

/**
 * Air quality provider using AirParif data
 */
class AirParifProvider implements AirQualityProviderInterface
{
    const BASE_API_URL = 'http://www.airparif.asso.fr/services/api/1.1';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $inseeCode;

    public function __construct(LoggerInterface $logger, string $apiKey)
    {
        $this->logger = $logger;
        $this->apiKey = $apiKey;
    }

    public function setInseeCode(string $inseeCode)
    {
        $this->inseeCode = $inseeCode;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentAirQualityIndex(): int
    {
        if (!isset($this->inseeCode)) {
            throw new AirQualityException('Location data is not set to retrieve AirParif quality air index');
        }

        $response = $this->getApiClient()->request('GET', 'idxville', [
            'query' => [
                'key'    => $this->apiKey,
                'villes' => $this->inseeCode,
            ],
        ]);

        $airQualityData = json_decode($response->getBody(), true);
        $airQualityIndex = $airQualityData[0]['jour']['indice'] ?? null;

        if (null === $airQualityIndex) {
            $this->logger->warning(
                'AirParif current air quality index could not be retrieved',
                ['insee_code' => $this->inseeCode]
            );
        }

        return $airQualityIndex;
    }

    private function getApiClient(): Client
    {
        if (!isset($this->client)) {
            $this->client = new Client(['base_uri' => self::BASE_API_URL]);
        }

        return $this->client;
    }
}
