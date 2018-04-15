<?php

namespace Dashboard\Widget\Weather\Transformer;

use Dashboard\Widget\Weather\Exception\WeatherException;

interface WeatherTransformerInterface
{
    /**
     * Transforms weather from provider to generic weather
     *
     * @param mixed $weather
     * @return string
     * @throws WeatherException
     */
    public function transformWeather($weather): string;

    /**
     * Transforms temperature from provider
     *
     * @param float $temperature
     * @return float
     */
    public function transformTemperature(float $temperature): float;
}
