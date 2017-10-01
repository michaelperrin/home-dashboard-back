<?php

namespace AloeDev\ZipCodeConverterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="city", indexes={
 *     @ORM\Index(name="city_insee_code_idx", columns={"insee_code"}),
 *     @ORM\Index(name="city_zip_code_idx", columns={"zip_code"}),
 *     @ORM\Index(name="city_name_idx", columns={"name"})
 * })
 */
class City
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $inseeCode;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set inseeCode
     *
     * @param string $inseeCode
     *
     * @return City
     */
    public function setInseeCode($inseeCode)
    {
        $this->inseeCode = $inseeCode;

        return $this;
    }

    /**
     * Get inseeCode
     *
     * @return string
     */
    public function getInseeCode()
    {
        return $this->inseeCode;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return City
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
