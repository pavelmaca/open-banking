<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

class PartyIdentification extends SimplePartyIdentification
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\Identificaion")
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

    /**
     * @param Identification|null $identification
     */
    public function setIdentification(?Identification $identification): void
    {
        $this->identification = $identification;
    }
}
