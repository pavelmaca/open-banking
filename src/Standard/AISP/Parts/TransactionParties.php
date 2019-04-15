<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class TransactionParties implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtor",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $debtor;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtorAccount.identification.iban")
     * @var string|null
     */
    protected $debtorAccountIban;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtorAccount.currency")
     * @var string|null
     */
    protected $debtorAccountCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="ultimateDebtor",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $ultimateDebtor;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditor",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $creditor;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditorAccount.identification.iban")
     * @var string|null
     */
    protected $creditorAccountIban;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditorAccount.currency")
     * @var string|null
     */
    protected $creditorAccountCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="ultimateCreditor",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $ultimateCreditor;

    /**
     * @return PartyIdentification|null
     */
    public function getDebtor(): ?PartyIdentification
    {
        return $this->debtor;
    }

    /**
     * @return string|null
     */
    public function getDebtorAccountIban(): ?string
    {
        return $this->debtorAccountIban;
    }

    /**
     * @return string|null
     */
    public function getDebtorAccountCurrency(): ?string
    {
        return $this->debtorAccountCurrency;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getUltimateDebtor(): ?PartyIdentification
    {
        return $this->ultimateDebtor;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getCreditor(): ?PartyIdentification
    {
        return $this->creditor;
    }

    /**
     * @return string|null
     */
    public function getCreditorAccountIban(): ?string
    {
        return $this->creditorAccountIban;
    }

    /**
     * @return string|null
     */
    public function getCreditorAccountCurrency(): ?string
    {
        return $this->creditorAccountCurrency;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getUltimateCreditor(): ?PartyIdentification
    {
        return $this->ultimateCreditor;
    }
}
