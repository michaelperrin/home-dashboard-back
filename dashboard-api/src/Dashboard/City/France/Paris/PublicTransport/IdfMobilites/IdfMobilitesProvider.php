<?php

namespace Dashboard\City\France\Paris\PublicTransport\IdfMobilites;

use GuzzleHttp\Client;

/**
 * Data provider for IDF Mobilités (public transport authority in Paris and its region)
 */
class IdfMobilitesProvider
{
    const BASE_API_URL = 'https://api-lab-trone-stif.opendata.stif.info';
    const SCHEDULE_APPROACHING = 'A l\'approche';
    const SCHEDULE_ARRIVED = 'A quai';

    private $apiKey;
    private $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get next departures times
     *
     * @param  string $lineId
     * @param  string $stopId
     * @param  int    $direction
     * @return array
     */
    public function getDirectionNextDepartures(string $lineId, string $stopId, int $direction) : array
    {
        $data = $this->nextDeparturesQuery($lineId, $stopId);

        // Filter on direction
        $departuresData = array_filter($data, function ($departure) use ($direction) {
            return isset($departure['sens']) && (int) $departure['sens'] === $direction;
        });

        // Only keep time in response
        $departures = array_map([$this, 'getDepartureTime'], $departuresData);

        return array_values($departures);
    }

    public function getStationNextDepartures(string $lineId, string $stopId) : array
    {
        $departuresByDirection = [];
        $departures = $this->nextDeparturesQuery($lineId, $stopId);
        $directions = [];

        foreach ($departures as $departure) {
            if (!isset($departure['lineDirection'])) {
                // TODO : log
                continue;
            }

            $direction = $departure['lineDirection'];

            if (!isset($departuresByDirection[$direction])) {
                $departuresByDirection[$direction] = [
                    'direction'  => $direction,
                    'times'      => [],
                ];
            }

            $departuresByDirection[$direction]['times'][] = $this->getDepartureTime($departure);
        }

        return array_values($departuresByDirection);
    }

    private function getDepartureTime(array $departure) : ?int
    {
        if (isset($departure['time'])) {
            return (int) $departure['time'];
        } elseif (isset($departure['schedule'])) {
            if (in_array($departure['schedule'], [self::SCHEDULE_APPROACHING, self::SCHEDULE_ARRIVED])) {
                return 0;
            }
        }

        return null;
    }

    private function nextDeparturesQuery(string $lineId, string $stopId) : array
    {
        $response = $this->getApiClient()->request('GET', '/service/tr-vianavigo/departures', [
            'query' => [
                'apikey'        => $this->apiKey,
                'line_id'       => $lineId,
                'stop_point_id' => $stopId,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    private function getApiClient() : Client
    {
        if (!isset($this->client)) {
            $this->client = new Client([
                'base_uri' => self::BASE_API_URL,
            ]);
        }

        return $this->client;
    }
}
