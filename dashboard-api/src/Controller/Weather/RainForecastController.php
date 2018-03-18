<?php

namespace Dashboard\Controller\Weather;

class RainForecastController
{
    public function oneHourForecastAction()
    {
        return $this->render('.html.twig');
    }
}
