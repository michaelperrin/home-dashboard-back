<?php

namespace Dashboard\Widget\BikeSharing;

use Dashboard\Widget\BikeSharing\AbstractStation;

interface BikeSharingProviderInterface
{
    /**
     * Retrieves station information
     *
     * @param StationInterface $station Station to be updated
     */
    public function fetchStationInfo(AbstractStation $station);
}
