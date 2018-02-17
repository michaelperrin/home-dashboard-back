<?php

namespace Dashboard\BikeSharing;

abstract class AbstractStation
{
    private $open;
    private $availableBikes;
    private $availableStands;

    /**
     * Tells whether station is open or not
     */
    public function isOpen(): bool
    {
        return $this->open;
    }

    /**
     * Sets whether station is open or not
     */
    public function setOpen(bool $open): AbstractStation
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Returns number of available bikes at the station
     */
    public function getAvailableBikes(): int
    {
        return $this->availableBikes;
    }

    /**
     * Sets number of available bikes at the station
     */
    public function setAvailableBikes(int $availableBikes): AbstractStation
    {
        $this->availableBikes = $availableBikes;

        return $this;
    }

    /**
     * Returns number of available bike stands at the station
     */
    public function getAvailableStands(): int
    {
        return $this->availableStands;
    }

    /**
     * Sets number of available bike stands at the station
     */
    public function setAvailableStands(int $availableStands): AbstractStation
    {
        $this->availableStands = $availableStands;

        return $this;
    }
}
