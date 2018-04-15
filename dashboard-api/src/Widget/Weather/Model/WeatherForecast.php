<?php

namespace Dashboard\Widget\Weather\Model;

class WeatherForecast
{
    const WEATHER_CLEAR = 'clear';
    const WEATHER_RAINY = 'rainy';
    const WEATHER_SUNNY = 'sunny';
    const WEATHER_SLEET = 'sleet';
    const WEATHER_WIND = 'wind';
    const WEATHER_FOG = 'fog';
    const WEATHER_CLOUDY = 'cloudy';
    const WEATHER_PARTLY_CLOUDY = 'partly-cloudy';
    const WEATHER_HAIL = 'hail';
    const WEATHER_THUNDERSTORM = 'thunderstorm';
    const WEATHER_TORNADO = 'tornado';

    private $currentWeather;
    private $currentTemperature;

    /**
     * @return mixed
     */
    public function getCurrentWeather()
    {
        return $this->currentWeather;
    }

    /**
     * @param mixed $currentWeather
     *
     * @return self
     */
    public function setCurrentWeather($currentWeather)
    {
        $this->currentWeather = $currentWeather;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentTemperature()
    {
        return $this->currentTemperature;
    }

    /**
     * @param mixed $currentTemperature
     *
     * @return self
     */
    public function setCurrentTemperature($currentTemperature)
    {
        $this->currentTemperature = $currentTemperature;

        return $this;
    }
}
