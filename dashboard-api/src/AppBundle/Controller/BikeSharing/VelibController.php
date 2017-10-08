<?php

namespace AppBundle\Controller\BikeSharing;

use Dashboard\City\France\Paris\BikeSharing\Velib\DataProvider;
use Dashboard\City\France\Paris\BikeSharing\Velib\Station;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/bike-sharing/velib")
 */
class VelibController
{
    /**
     * @Route("/station-info")
     */
    public function stationInfoAction(Request $request, SerializerInterface $serializer, DataProvider $dataProvider)
    {
        $id = $request->query->get('id');
        $contract = $request->query->get('contract');

        $station = new Station($id, $contract);

        $dataProvider->fetchStationInfo($station);

        $data = $serializer->serialize(
            $station,
            'json'
        );

        $response = new JsonResponse();
        $response->setJson($data);

        return $response;
    }
}
