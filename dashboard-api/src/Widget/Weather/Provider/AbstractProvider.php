<?php

namespace Dashboard\Widget\Weather\Provider;

use Dashboard\Widget\Weather\Model\WeatherForecast;

abstract class AbstractProvider
{
    /**
     * Gets current weather
     */
    abstract protected function getCurrentWeather(): string;

    /**
     * Gets current temperature in Celcius degrees
     */
    abstract protected function getCurrentTemperature(): float;

    /**
     * Get precipitation probability until end of day as a percentage
     */
    abstract protected function getPrecipitationProbabilityUntilEndOfDay(): int;

    abstract protected function fetchForecast(float $latitude, float $longitude);

    /**
     * {@inheritDoc}
     */
    public function getWeatherForecast(float $latitude, float $longitude): WeatherForecast
    {
        $weatherForecast = new WeatherForecast();

        $this->fetchForecast($latitude, $longitude);

        $weatherForecast
            ->setCurrentWeather($this->getCurrentWeather())
            ->setCurrentTemperature($this->getCurrentTemperature())
        ;

        return $weatherForecast;
    }
}
