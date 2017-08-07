<?php

namespace AppBundle\Import;

use AppBundle\Entity\City;
use Doctrine\Common\Persistence\ObjectManager;

class CityImporter
{
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    const BATCH_SIZE = 40;
    const CSV_SEPARATOR = ';';

    /**
     * Imports city file
     *
     * @param  string $filePath File path to the CSV file to import
     * @return int              Number of imported cities
     */
    public function importFile(string $filePath) : int
    {
        $this->resetCities();

        $nbImported = 0;

        $stream = fopen($filePath, 'r');

        // Skip header
        $this->getLine($stream);

        while (($cityData = $this->getLine($stream)) !== false) {
            $city = $this->getCity($cityData);

            $this->om->persist($city);
            $nbImported++;

            if ($nbImported % self::BATCH_SIZE === 0) {
                $this->om->flush();
                $this->om->clear();
            }
        }

        $this->om->flush();
        $this->om->clear();

        return $nbImported;
    }

    private function getLine($stream)
    {
        return fgetcsv($stream, 1000, self::CSV_SEPARATOR);
    }

    private function resetCities()
    {
        $this->om
            ->createQueryBuilder()
            ->delete('AppBundle:City', 'c')
            ->getQuery()
            ->execute()
        ;
    }

    private function getCity(array $cityData)
    {
        $city = new City();

        $city
            ->setInseeCode($cityData[0])
            ->setName($cityData[1])
            ->setZipCode($cityData[2])
        ;

        return $city;
    }
}
