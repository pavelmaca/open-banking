<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class OtherIdentificaion implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification")
     * @var string
     */
    protected $identification;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="schemeName.proprietary")
     * @var string|null
     */
    protected $schemeNameProprietary;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="issuer")
     * @var string|null
     */
    protected $issuer;

    /**
     * @return string
     */
    public function getIdentification(): string
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }

    /**
     * @return string|null
     */
    public function getSchemeNameProprietary(): ?string
    {
        return $this->schemeNameProprietary;
    }

    /**
     * @param string|null $schemeNameProprietary
     */
    public function setSchemeNameProprietary(?string $schemeNameProprietary): void
    {
        $this->schemeNameProprietary = $schemeNameProprietary;
    }

    /**
     * @return string|null
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    /**
     * @param string|null $issuer
     */
    public function setIssuer(?string $issuer): void
    {
        $this->issuer = $issuer;
    }
}
