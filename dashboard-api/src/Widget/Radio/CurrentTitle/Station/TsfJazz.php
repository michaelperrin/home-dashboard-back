<?php

namespace Dashboard\Widget\Radio\CurrentTitle\Station;

use Dashboard\Widget\Radio\CurrentTitle\CurrentTitleRetrieverInterface;
use Dashboard\Widget\Radio\CurrentTitle\HttpDataFetcher;

class TsfJazz implements CurrentTitleRetrieverInterface
{
    private $dataFetcher;
    private $config;

    public function __construct(HttpDataFetcher $dataFetcher, array $config)
    {
        $this->dataFetcher = $dataFetcher;
        $this->config = $config;
    }

    public function getCurrentTitle(): array
    {
        $data = $this->dataFetcher->fetchData($this->config['current_title_url']);
        list($artist, $track) = explode('|', $data);

        return [
            'artist' => $artist,
            'track'  => $track,
        ];
    }
}
