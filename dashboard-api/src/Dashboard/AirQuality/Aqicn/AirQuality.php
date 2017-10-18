<?php

namespace Dashboard\AirQuality\Aqicn;

class AirQuality
{
    private $stationId;

    /**
     * Air Quality Index (Chinese index)
     * @see https://en.wikipedia.org/wiki/Air_quality_index
     */
    private $aqi;

    private $pm25Measurement;
    private $pm10Measurement;
    private $o3Measurement;
    private $no225Measurement;
    private $so25Measurement;
    private $coMeasurement;
}
