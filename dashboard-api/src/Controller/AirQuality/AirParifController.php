<?php

namespace Dashboard\Controller\AirQuality;

use Dashboard\Widget\AirQuality\Provider\AirParifProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Weather forecast endpoints
 *
 * @Route("/air-quality/air-parif")
 */
class AirParifController
{
    /**
     * Get current air quality index using AirParif
     *
     * @Route("/current")
     */
    public function current(Request $request, AirParifProvider $provider)
    {
        $inseeCode = $request->query->get('insee_code');

        if (!$inseeCode) {
            throw new BadRequestHttpException('Invalid parameters');
        }

        $provider->setInseeCode($inseeCode);
        $airQualityIndex = $provider->getCurrentAirQualityIndex($inseeCode);

        return new JsonResponse(['index' => $airQualityIndex]);
    }
}
