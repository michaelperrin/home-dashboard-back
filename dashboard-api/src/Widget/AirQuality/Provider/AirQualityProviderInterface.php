<?php

namespace Dashboard\Widget\AirQuality\Provider;

interface AirQualityProviderInterface
{
    /**
     * Returns current air quality index
     *
     * @return int
     */
    public function getCurrentAirQualityIndex(): int;
}
