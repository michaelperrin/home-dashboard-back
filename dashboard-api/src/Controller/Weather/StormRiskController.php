<?php

namespace Dashboard\Controller\Weather;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StormRiskController extends Controller
{
    public function indexAction()
    {
        return $this->render('.html.twig');
    }
}
