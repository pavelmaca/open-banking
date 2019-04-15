<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

class TransactionAgent extends SimplePartyIdentification
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="financialInstitutionIdentification.bic")
     * @var string|null
     */
    protected $bic;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="clearingSystemMemberIdentification.clearingSystemIdentification.code")
     * @var string|null
     */
    protected $clearingSystemMemberIdentificationCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="clearingSystemMemberIdentification.clearingSystemIdentification.proprietary")
     * @var string|null
     */
    protected $clearingSystemMemberIdentificationProprietary;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="clearingSystemMemberIdentification.memberIdentification")
     * @var string|null
     */
    protected $memberIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="other.identification")
     * @var string|null
     */
    protected $otherIdentification;

    /**
     * @return string|null
     */
    public function getBic(): ?string
    {
        return $this->bic;
    }

    /**
     * @return string|null
     */
    public function getClearingSystemMemberIdentificationCode(): ?string
    {
        return $this->clearingSystemMemberIdentificationCode;
    }

    /**
     * @return string|null
     */
    public function getClearingSystemMemberIdentificationProprietary(): ?string
    {
        return $this->clearingSystemMemberIdentificationProprietary;
    }

    /**
     * @return string|null
     */
    public function getMemberIdentification(): ?string
    {
        return $this->memberIdentification;
    }

    /**
     * @return string|null
     */
    public function getOtherIdentification(): ?string
    {
        return $this->otherIdentification;
    }
}
