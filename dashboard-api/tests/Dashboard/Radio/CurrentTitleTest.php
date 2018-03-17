<?php

namespace Dashboard\Radio;

use Dashboard\Radio\CurrentTitle\CurrentTitleRetrieverInterface;
use Dashboard\Radio\CurrentTitle\Station\Fip;
use Dashboard\Radio\CurrentTitle\Station\Nova;
use Dashboard\Radio\CurrentTitle\Station\TsfJazz;
use PHPUnit\Framework\TestCase;

class CurrentTitleTest extends TestCase
{
    private $prophet;

    public function setUp()
    {
        $this->prophet = new \Prophecy\Prophet();
    }

    public function testFip()
    {
        $artist = 'And Also The Trees';
        $track = 'Candace';
        $album = '(Listen for) The Rag and Bone Man';
        $picture = 'http://www.example.com/image.png';

        $fakeResponse = <<<EOT
{
    "steps": {
        "key1": {},
        "key2": {
            "authors": "$artist",
            "title": "$track",
            "titreAlbum": "$album",
            "visual": "$picture"
        },
        "key3": {}
    },
    "levels": [
        {
            "items": ["key1", "key2", "key3"],
            "position": 1
        }
    ]
}
EOT;

        $currentTitleRetriever = new Fip($this->getDataFetcher($fakeResponse), ['current_title_url' => 'http://fake_station_url.com']);

        $expectedResult = [
            'artist' => $artist,
            'track'  => $track,
            'album'  => [
                'name'    => $album,
                'picture' => $picture,
            ]
        ];

        $this->assertEquals($currentTitleRetriever->getCurrentTitle(), $expectedResult);
    }

    public function testNova()
    {
        $fakeResponse = <<<'EOD'
{"track": {"markup": "<div class=\"ontheair-text\"><div class=\"artist\">Fink</div><div class=\"title\">See it all</div></div>"}}
EOD;

        $currentTitleRetriever = new Nova($this->getDataFetcher($fakeResponse), ['current_title_url' => 'http://fake_station_url.com']);

        $expectedResult = [
            'artist' => 'Fink',
            'track'  => 'See it all',
        ];

        $this->checkCurrentTitle($currentTitleRetriever, 'Fink', 'See it all');
    }

    public function testTsfJazz()
    {
        $fakeResponse = 'GOGO PENGUIN|ALL RES';
        $currentTitleRetriever = new TsfJazz($this->getDataFetcher($fakeResponse), ['current_title_url' => 'http://fake_station_url.com']);

        $this->checkCurrentTitle($currentTitleRetriever, 'GOGO PENGUIN', 'ALL RES');
    }

    protected function checkCurrentTitle(CurrentTitleRetrieverInterface $titleRetriever, string $artist, string $track)
    {
        $expectedResult = [
            'artist' => $artist,
            'track'  => $track,
        ];

        $this->assertEquals($titleRetriever->getCurrentTitle(), $expectedResult);
    }

    protected function getDataFetcher(string $fakeResponse)
    {
        $dataFetcher = $this->prophet->prophesize('Dashboard\Radio\CurrentTitle\HttpDataFetcher');
        $dataFetcher->fetchData('http://fake_station_url.com')->willReturn($fakeResponse);

        return $dataFetcher->reveal();
    }
}
