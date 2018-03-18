<?php

namespace Dashboard\Controller\PublicTransport;

use Dashboard\Widget\City\France\Paris\PublicTransport\IdfMobilites\IdfMobilitesProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/public-transport/idf-mobilites")
 */
class IdfMobilitesController
{
    /**
     * @Route("/station/next-departures")
     */
    public function stationNextDeparturesAction(Request $request, IdfMobilitesProvider $dataProvider)
    {
        $lineId = $request->query->get('line_id');
        $stopId = $request->query->get('stop_id');

        $nextDepartures = $dataProvider->getStationNextDepartures($lineId, $stopId);

        return new JsonResponse(['next_departures' => $nextDepartures]);
    }

    /**
     * @Route("/direction/next-departures")
     */
    public function directionNextDeparturesByDirectionAction(Request $request, IdfMobilitesProvider $dataProvider)
    {
        $lineId = $request->query->get('line_id');
        $stopId = $request->query->get('stop_id');
        $direction = $request->query->getInt('direction');

        $nextDepartures = $dataProvider->getDirectionNextDepartures($lineId, $stopId, $direction);

        return new JsonResponse(['next_departures' => $nextDepartures]);
    }
}
