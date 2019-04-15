<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class PostalAddress implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="streetName")
     * @var string|null
     */
    protected $streetName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="buildingNumber")
     * @var string|null
     */
    protected $buildingNumber;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="postCode")
     * @var string|null
     */
    protected $postCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="townName")
     * @var string|null
     */
    protected $townName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="country")
     * @var string|null
     */
    protected $country;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="addressLine")
     * @var string|string[]|null
     */
    protected $addressLine;

    /**
     * @return string|null
     */
    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    /**
     * @param string|null $streetName
     */
    public function setStreetName(?string $streetName): void
    {
        $this->streetName = $streetName;
    }

    /**
     * @return string|null
     */
    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    /**
     * @param string|null $buildingNumber
     */
    public function setBuildingNumber(?string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string|null $postCode
     */
    public function setPostCode(?string $postCode): void
    {
        $this->postCode = $postCode;
    }

    /**
     * @return string|null
     */
    public function getTownName(): ?string
    {
        return $this->townName;
    }

    /**
     * @param string|null $townName
     */
    public function setTownName(?string $townName): void
    {
        $this->townName = $townName;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|string[]|null
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    /**
     * @param string|string[]|null $addressLine
     */
    public function setAddressLine($addressLine): void
    {
        $this->addressLine = $addressLine;
    }
}
