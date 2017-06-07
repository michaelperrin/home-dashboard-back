<?php

namespace AppBundle\Controller\Radio;

use Dashboard\Radio\CurrentTitle\Station\Fip;
use Dashboard\Radio\CurrentTitle\Station\Nova;
use Dashboard\Radio\CurrentTitle\Station\TsfJazz;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/radio/current-title")
 */
class CurrentTitleController
{
    /**
     * @Route("/fip", defaults={"_format": "json"})
     */
    public function fipAction(Fip $currentTitleRetriever)
    {
        $trackInfo = $currentTitleRetriever->getCurrentTitle();

        return new JsonResponse($trackInfo);
    }

    /**
     * @Route("/nova", defaults={"_format": "json"})
     */
    public function novaAction(Nova $currentTitleRetriever)
    {
        $trackInfo = $currentTitleRetriever->getCurrentTitle();

        return new JsonResponse($trackInfo);
    }

    /**
     * @Route("/tsf-jazz", defaults={"_format": "json"})
     */
    public function tsfJazzAction(TsfJazz $currentTitleRetriever)
    {
        $trackInfo = $currentTitleRetriever->getCurrentTitle();

        return new JsonResponse($trackInfo);
    }
}
