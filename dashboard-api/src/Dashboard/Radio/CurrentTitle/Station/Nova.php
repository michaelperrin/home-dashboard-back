<?php

namespace Dashboard\Radio\CurrentTitle\Station;

use Dashboard\Radio\CurrentTitle\CurrentTitleRetrieverInterface;
use Dashboard\Radio\CurrentTitle\HttpDataFetcher;
use Symfony\Component\DomCrawler\Crawler;

class Nova implements CurrentTitleRetrieverInterface
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
        $rawData = $this->dataFetcher->fetchData($this->config['current_title_url']);
        $data = json_decode($rawData, true);

        $markup = $data['track']['markup'];
        $crawler = new Crawler($markup);

        $artist = trim($crawler->filter('.ontheair-text > .artist')->eq(0)->text());
        $track = trim($crawler->filter('.ontheair-text > .title')->eq(0)->text());

        return [
            'artist' => $artist,
            'track'  => $track,
        ];
    }
}
