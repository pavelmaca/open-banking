<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class PostalAddress implements ResponseObject
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
     * @return string|null
     */
    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @return string|null
     */
    public function getTownName(): ?string
    {
        return $this->townName;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|string[]|null
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }
}
