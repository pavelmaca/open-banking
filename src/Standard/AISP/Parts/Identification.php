<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class Identification implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="organisationIdentification",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\OrganizationIdentification")
     * @var OrganizationIdentification|null
     */
    protected $organisationIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="privateIdentification",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PrivateIdentification")
     * @var PrivateIdentification|null
     */
    protected $privateIdentification;

    /**
     * @return OrganizationIdentification|null
     */
    public function getOrganisationIdentification(): ?OrganizationIdentification
    {
        return $this->organisationIdentification;
    }

    /**
     * @return PrivateIdentification|null
     */
    public function getPrivateIdentification(): ?PrivateIdentification
    {
        return $this->privateIdentification;
    }
}
