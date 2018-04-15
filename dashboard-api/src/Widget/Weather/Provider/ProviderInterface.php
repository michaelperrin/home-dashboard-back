<?php

namespace Dashboard\Widget\Weather\Provider;

use Dashboard\Widget\Weather\Model\WeatherForecast;

interface ProviderInterface
{
    /**
     * Gets weather forecast
     *
     * @var float $latitude
     * @var float $longitude
     */
    public function getWeatherForecast(float $latitude, float $longitude): WeatherForecast;
}
