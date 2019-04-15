<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class OrganizationIdentification implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="organisationIdentification")
     * @var string
     */
    protected $organisationIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="bicOrBei")
     * @var string
     */
    protected $bicOrBei;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="other", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\OtherIdentificaion")
     * @var OtherIdentificaion|null
     */
    protected $other;

    /**
     * @return string
     */
    public function getOrganisationIdentification(): string
    {
        return $this->organisationIdentification;
    }

    /**
     * @param string $organisationIdentification
     */
    public function setOrganisationIdentification(string $organisationIdentification): void
    {
        $this->organisationIdentification = $organisationIdentification;
    }

    /**
     * @return string
     */
    public function getBicOrBei(): string
    {
        return $this->bicOrBei;
    }

    /**
     * @param string $bicOrBei
     */
    public function setBicOrBei(string $bicOrBei): void
    {
        $this->bicOrBei = $bicOrBei;
    }

    /**
     * @return OtherIdentificaion|null
     */
    public function getOther(): ?OtherIdentificaion
    {
        return $this->other;
    }

    /**
     * @param OtherIdentificaion|null $other
     */
    public function setOther(?OtherIdentificaion $other): void
    {
        $this->other = $other;
    }
}
