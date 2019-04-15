<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class Identification implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="organisationIdentification", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\OrganizationIdentification")
     * @var OrganizationIdentification|null
     */
    protected $organisationIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="privateIdentification", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PrivateIdentification")
     * @var PrivateIdentification|null
     */
    protected $privateIdentification = null;

    /**
     * @return OrganizationIdentification|null
     */
    public function getOrganisationIdentification(): ?OrganizationIdentification
    {
        return $this->organisationIdentification;
    }

    /**
     * @param OrganizationIdentification|null $organisationIdentification
     */
    public function setOrganisationIdentification(?OrganizationIdentification $organisationIdentification): void
    {
        $this->organisationIdentification = $organisationIdentification;
    }

    /**
     * @return PrivateIdentification|null
     */
    public function getPrivateIdentification(): ?PrivateIdentification
    {
        return $this->privateIdentification;
    }

    /**
     * @param PrivateIdentification|null $privateIdentification
     */
    public function setPrivateIdentification(?PrivateIdentification $privateIdentification): void
    {
        $this->privateIdentification = $privateIdentification;
    }
}
