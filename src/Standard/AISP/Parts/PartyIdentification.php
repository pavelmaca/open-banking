<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

class PartyIdentification extends SimplePartyIdentification
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\Identification")
     * @var Identification|null
     */
    protected $identification = null;

    /**
     * @return Identification|null
     */
    public function getIdentification(): ?Identification
    {
        return $this->identification;
    }
}
