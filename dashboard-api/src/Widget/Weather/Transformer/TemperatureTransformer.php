<?php

namespace Dashboard\Widget\Weather\Transformer;

/**
 * Celsius ↔ Farenheit temperature converter
 */
class TemperatureTransformer
{
    /**
     * Converts Celsius temperature to Farenheit temperature
     *
     * @param float $temperature
     * @param int $precision
     * @return float
     */
    public function toFarenheit(float $temperature, int $precision = 2): float
    {
        return round(($temperature * 9 / 5) + 32, 2);
    }

    /**
     * Converts Farenheit temperature to Celsius temperature
     *
     * @param float $temperature
     * @param int $precision
     * @return float
     */
    public function toCelsius(float $temperature, int $precision = 2): float
    {
        return round(($temperature - 32) * (5 / 9), 2);
    }
}
