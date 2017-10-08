<?php

namespace Dashboard\City\France\Paris\BikeSharing\Velib;

use Dashboard\BikeSharing\AbstractStation;

class Station extends AbstractStation
{
    const STATUS_OPEN = 'OPEN';

    private $id;
    private $contract;

    public function __construct($id, $contract)
    {
        $this->id = $id;
        $this->contract = $contract;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContract()
    {
        return $this->contract;
    }
}
