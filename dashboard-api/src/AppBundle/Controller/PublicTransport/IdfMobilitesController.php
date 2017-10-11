<?php

namespace AppBundle\Controller\PublicTransport;

use Dashboard\City\France\Paris\PublicTransport\IdfMobilites\IdfMobilitesProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/public-transport/idf-mobilites")
 */
class IdfMobilitesController
{
    /**
     * @Route("/next-departures")
     */
    public function nextDeparturesAction(Request $request, IdfMobilitesProvider $dataProvider)
    {
        $lineId = $request->query->get('line_id');
        $stopId = $request->query->get('stop_id');
        $direction = $request->query->getInt('direction');

        $nextDepartures = $dataProvider->getNextDepartures($lineId, $stopId, $direction);

        return new JsonResponse(['next_departures' => $nextDepartures]);
    }
}
