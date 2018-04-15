<?php

namespace Dashboard\Controller;

use Dashboard\Widget\Weather\Provider\DarkSkyProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Weather forecast endpoints
 */
class WeatherForecastController
{
    /**
     * @Route("/weather/forecast")
     */
    public function forecast(Request $request, DarkSkyProvider $provider, SerializerInterface $serializer)
    {
        $latitude = $request->query->filter('latitude', null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $longitude = $request->query->filter('longitude', null, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        if (!$latitude || !$longitude) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        $weatherForecast = $provider->getWeatherForecast($latitude, $longitude);

        $json = $serializer->serialize($weatherForecast, 'json');

        return JsonResponse::fromJsonString($json);
    }
}
