<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class OtherIdentificaion implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification")
     * @var string|null
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
     * @return string|null
     */
    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    /**
     * @return string|null
     */
    public function getSchemeNameProprietary(): ?string
    {
        return $this->schemeNameProprietary;
    }

    /**
     * @return string|null
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }
}
