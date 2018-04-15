<?php

namespace Dashboard\Widget\Weather\Transformer;

use Dashboard\Widget\Weather\Exception\WeatherException;
use Dashboard\Widget\Weather\Model\WeatherForecast;
use Dashboard\Widget\Weather\Transformer\TemperatureTransformer;
use Dashboard\Widget\Weather\Transformer\WeatherTransformerInterface;

/**
 * Transforms Dark Sky data to generic weather data
 */
class DarkSkyTransformer implements WeatherTransformerInterface
{
    /**
     * @var TemperatureTransformer
     */
    private $temperatureTransformer;

    public function __construct(TemperatureTransformer $temperatureTransformer)
    {
        $this->temperatureTransformer = $temperatureTransformer;
    }

    /**
     * {@inheritDoc}
     */
    public function transformWeather($weather): string
    {
        $weatherMatching = [
            'clear-day'           => WeatherForecast::WEATHER_CLEAR,
            'clear-night'         => WeatherForecast::WEATHER_CLEAR,
            'rain'                => WeatherForecast::WEATHER_RAINY,
            'snow'                => WeatherForecast::WEATHER_SUNNY,
            'sleet'               => WeatherForecast::WEATHER_SLEET,
            'wind'                => WeatherForecast::WEATHER_WIND,
            'fog'                 => WeatherForecast::WEATHER_FOG,
            'cloudy'              => WeatherForecast::WEATHER_CLOUDY,
            'partly-cloudy-day'   => WeatherForecast::WEATHER_PARTLY_CLOUDY,
            'partly-cloudy-night' => WeatherForecast::WEATHER_PARTLY_CLOUDY,
            'hail'                => WeatherForecast::WEATHER_HAIL,
            'thunderstorm'        => WeatherForecast::WEATHER_THUNDERSTORM,
            'tornado'             => WeatherForecast::WEATHER_TORNADO,
        ];

        if (!isset($weatherMatching[$weather])) {
            throw new WeatherException(
                'Could not convert Dark Sky weather to generic weather',
                ['dark_sky_weather' => $weather]
            );
        }

        return $weatherMatching[$weather];
    }

    /**
     * {@inheritDoc}
     */
    public function transformTemperature(float $temperature): float
    {
        return $this->temperatureTransformer->toCelsius($temperature);
    }
}
