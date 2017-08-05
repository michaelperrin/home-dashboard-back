<?php

namespace Dashboard\Radio\CurrentTitle\Station;

use Dashboard\Radio\CurrentTitle\CurrentTitleRetrieverInterface;
use Dashboard\Radio\CurrentTitle\HttpDataFetcher;

class Fip implements CurrentTitleRetrieverInterface
{
    private $dataFetcher;
    private $config;

    public function __construct(HttpDataFetcher $dataFetcher, array $config)
    {
        $this->dataFetcher = $dataFetcher;
        $this->config = $config;
    }

    public function getCurrentTitle() : array
    {
        $rawData = $this->dataFetcher->fetchData($this->config['current_title_url']);
        $data = json_decode($rawData, true);

        $position = $data['levels'][0]['position'];
        $itemId = $data['levels'][0]['items'][$position];

        $trackInfo = $data['steps'][$itemId];

        return [
            'artist' => $trackInfo['authors'],
            'track'  => $trackInfo['title'],
            'album'  => [
                'name'    => $trackInfo['titreAlbum'] ?? null,
                'picture' => $trackInfo['visual'] ?? null,
            ],
        ];
    }
}
