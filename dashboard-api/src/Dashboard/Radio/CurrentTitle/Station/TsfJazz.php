<?php

namespace Dashboard\Radio\CurrentTitle\Station;

use Dashboard\Radio\CurrentTitle\CurrentTitleInterface;
use Dashboard\Radio\CurrentTitle\HttpDataFetcher;

class TsfJazz implements CurrentTitleInterface
{
    private $dataFetcher;
    private $config;

    public function __construct(HttpDataFetcher $dataFetcher, array $config)
    {
        $this->dataFetcher = $dataFetcher;
        $this->config = $config;
    }

    public function getCurrentTitle()
    {
        $data = $this->dataFetcher->fetchData($this->config['current_title_url']);
        list($artist, $track) = explode('|', $data);

        return [
            'artist' => $artist,
            'track'  => $track,
        ];
    }
}
