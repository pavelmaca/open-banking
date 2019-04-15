<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class OrganizationIdentification implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="organisationIdentification")
     * @var string|null
     */
    protected $organisationIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="bicOrBei")
     * @var string|null
     */
    protected $bicOrBei;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="other",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\OtherIdentificaion")
     * @var OtherIdentificaion|null
     */
    protected $other;

    /**
     * @return string|null
     */
    public function getOrganisationIdentification(): ?string
    {
        return $this->organisationIdentification;
    }

    /**
     * @return string|null
     */
    public function getBicOrBei(): ?string
    {
        return $this->bicOrBei;
    }

    /**
     * @return OtherIdentificaion|null
     */
    public function getOther(): ?OtherIdentificaion
    {
        return $this->other;
    }
}
