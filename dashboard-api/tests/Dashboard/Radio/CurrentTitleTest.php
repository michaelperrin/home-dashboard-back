<?php

namespace Dashboard\Radio;

use Dashboard\Radio\CurrentTitle\Station\TsfJazz;
use PHPUnit\Framework\TestCase;

class CurrentTitleTest extends TestCase
{
    private $prophet;

    public function setUp()
    {
        $this->prophet = new \Prophecy\Prophet();
    }

    public function testTsfJazz()
    {
        $dataFetcher = $this->prophet->prophesize('Dashboard\Radio\CurrentTitle\HttpDataFetcher');
        $dataFetcher->fetchData('http://fake_tsf_url.com')->willReturn('GOGO PENGUIN|ALL RES');

        $tsfJazz = new TsfJazz($dataFetcher->reveal(), ['current_title_url' => 'http://fake_tsf_url.com']);

        $expectedResult = [
            'artist' => 'GOGO PENGUIN',
            'track'  => 'ALL RES',
        ];

        $this->assertEquals($tsfJazz->getCurrentTitle(), $expectedResult);
    }
}
