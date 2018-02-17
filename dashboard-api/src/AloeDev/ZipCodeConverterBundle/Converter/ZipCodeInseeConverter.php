<?php

namespace AloeDev\ZipCodeConverterBundle\Converter;

use AloeDev\ZipCodeConverterBundle\Entity\City;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Converts French zip code to INSEE code
 */
class ZipCodeInseeConverter
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function convert($zipCode): string
    {
        $city = $this
            ->om
            ->getRepository(City::class)
            ->findOneBy(['zipCode' => $zipCode])
        ;

        // TODO : if not found

        return $city->getInseeCode();
    }
}
