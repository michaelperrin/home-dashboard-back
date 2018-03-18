<?php

namespace Dashboard\Widget\City\France\Paris\BikeSharing\Velib;

use Dashboard\Widget\BikeSharing\AbstractStation;
use Dashboard\Widget\BikeSharing\BikeSharingProviderInterface;
use Dashboard\Widget\City\France\Paris\BikeSharing\Velib\Station;
use GuzzleHttp\Client;

class DataProvider implements BikeSharingProviderInterface
{
    private $apiKey;
    private $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchStationInfo(AbstractStation $station)
    {
        $stationData = $this->getStationInfo($station);

        $station
            ->setOpen($stationData['status'] === Station::STATUS_OPEN)
            ->setAvailableBikes($stationData['available_bikes'])
            ->setAvailableStands($stationData['bike_stands'])
        ;
    }

    private function getStationInfo(AbstractStation $station): array
    {
        $response = $this->getApiClient()->request('GET', 'stations/'.$station->getId(), [
            'query' => [
                'apiKey' => $this->apiKey,
                'contract' => $station->getContract(),
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function getApiClient(): Client
    {
        if (!isset($this->client)) {
            $this->client = new Client([
                'base_uri' => 'https://api.jcdecaux.com/vls/v1/',
            ]);
        }

        return $this->client;
    }
}
