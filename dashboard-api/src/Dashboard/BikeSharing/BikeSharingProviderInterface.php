<?php

namespace Dashboard\BikeSharing;

use Dashboard\BikeSharing\AbstractStation;

interface BikeSharingProviderInterface
{
    /**
     * Retrieves station information
     *
     * @param StationInterface $station Station to be updated
     */
    public function fetchStationInfo(AbstractStation $station);
}
