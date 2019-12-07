<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP;

use PavelMaca\OpenBanking\Standard\PISP\Parts\ExchangeRateInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PartyIdentification;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentAgent;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentIdentification;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentTypeInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\RemittanceInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\SimplePartyIdentification;
use PavelMaca\OpenBanking\Standard\RequestObject;

class DomesticPaymentRequest extends Payment implements RequestObject
{
    public function __construct(
        string $instructionIdentification,
        float $amount,
        string $currency,
        string $creditorAccountIban,
        string $debtorAccountIban
    ) {
        $this->paymentIdentification = new PaymentIdentification($instructionIdentification);
        $this->amount = $amount;
        $this->currency = $currency;
        $this->debtorAccountIban = $debtorAccountIban;
        $this->creditorAccountIban = $creditorAccountIban;
    }

    /**
     * @return PaymentTypeInformation|null
     */
    public function getPaymentTypeInformation(): ?PaymentTypeInformation
    {
        return $this->paymentTypeInformation;
    }

    /**
     * @param PaymentTypeInformation|null $paymentTypeInformation
     */
    public function setPaymentTypeInformation(?PaymentTypeInformation $paymentTypeInformation): void
    {
        $this->paymentTypeInformation = $paymentTypeInformation;
    }

    /**
     * @return string|null
     */
    public function getRequestedExecutionDate(): ?string
    {
        return $this->requestedExecutionDate;
    }

    /**
     * @param string|null $requestedExecutionDate
     */
    public function setRequestedExecutionDate(?string $requestedExecutionDate): void
    {
        $this->requestedExecutionDate = $requestedExecutionDate;
    }

    /**
     * @return ExchangeRateInformation|null
     */
    public function getExchangeRateInformation(): ?ExchangeRateInformation
    {
        return $this->exchangeRateInformation;
    }

    /**
     * @param ExchangeRateInformation|null $exchangeRateInformation
     */
    public function setExchangeRateInformation(?ExchangeRateInformation $exchangeRateInformation): void
    {
        $this->exchangeRateInformation = $exchangeRateInformation;
    }

    /**
     * @return string|null
     */
    public function getChargesAccountIban(): ?string
    {
        return $this->chargesAccountIban;
    }

    /**
     * @param string|null $chargesAccountIban
     */
    public function setChargesAccountIban(?string $chargesAccountIban): void
    {
        $this->chargesAccountIban = $chargesAccountIban;
    }

    /**
     * @return string|null
     */
    public function getChargesAccountCurrency(): ?string
    {
        return $this->chargesAccountCurrency;
    }

    /**
     * @param string|null $chargesAccountCurrency
     */
    public function setChargesAccountCurrency(?string $chargesAccountCurrency): void
    {
        $this->chargesAccountCurrency = $chargesAccountCurrency;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getUltimateDebtor(): ?PartyIdentification
    {
        return $this->ultimateDebtor;
    }

    /**
     * @param PartyIdentification|null $ultimateDebtor
     */
    public function setUltimateDebtor(?PartyIdentification $ultimateDebtor): void
    {
        $this->ultimateDebtor = $ultimateDebtor;
    }

    /**
     * @return SimplePartyIdentification|null
     */
    public function getDebtor(): ?SimplePartyIdentification
    {
        return $this->debtor;
    }

    /**
     * @param SimplePartyIdentification|null $debtor
     */
    public function setDebtor(?SimplePartyIdentification $debtor): void
    {
        $this->debtor = $debtor;
    }

    /**
     * @return string|null
     */
    public function getDebtorAccountCurrency(): ?string
    {
        return $this->debtorAccountCurrency;
    }

    /**
     * @param string|null $debtorAccountCurrency
     */
    public function setDebtorAccountCurrency(?string $debtorAccountCurrency): void
    {
        $this->debtorAccountCurrency = $debtorAccountCurrency;
    }

    /**
     * @return SimplePartyIdentification|null
     */
    public function getCreditor(): ?SimplePartyIdentification
    {
        return $this->creditor;
    }

    /**
     * @param SimplePartyIdentification|null $creditor
     */
    public function setCreditor(?SimplePartyIdentification $creditor): void
    {
        $this->creditor = $creditor;
    }

    /**
     * @return string|null
     */
    public function getCreditorAccountCurrency(): ?string
    {
        return $this->creditorAccountCurrency;
    }

    /**
     * @param string|null $creditorAccountCurrency
     */
    public function setCreditorAccountCurrency(?string $creditorAccountCurrency): void
    {
        $this->creditorAccountCurrency = $creditorAccountCurrency;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getUltimateCreditor(): ?PartyIdentification
    {
        return $this->ultimateCreditor;
    }

    /**
     * @param PartyIdentification|null $ultimateCreditor
     */
    public function setUltimateCreditor(?PartyIdentification $ultimateCreditor): void
    {
        $this->ultimateCreditor = $ultimateCreditor;
    }

    /**
     * @return string|null
     */
    public function getPurposeCode(): ?string
    {
        return $this->purposeCode;
    }

    /**
     * @param string|null $purposeCode
     */
    public function setPurposeCode(?string $purposeCode): void
    {
        $this->purposeCode = $purposeCode;
    }

    /**
     * @return string|null
     */
    public function getPurposeProprietary(): ?string
    {
        return $this->purposeProprietary;
    }

    /**
     * @param string|null $purposeProprietary
     */
    public function setPurposeProprietary(?string $purposeProprietary): void
    {
        $this->purposeProprietary = $purposeProprietary;
    }

    /**
     * @return string|null
     */
    public function getInstructionForNextAgent(): ?string
    {
        return $this->instructionForNextAgent;
    }

    /**
     * @param string|null $instructionForNextAgent
     */
    public function setInstructionForNextAgent(?string $instructionForNextAgent): void
    {
        $this->instructionForNextAgent = $instructionForNextAgent;
    }

    /**
     * @return RemittanceInformation|null
     */
    public function getRemittanceInformation(): ?RemittanceInformation
    {
        return $this->remittanceInformation;
    }

    /**
     * @param RemittanceInformation|null $remittanceInformation
     */
    public function setRemittanceInformation(?RemittanceInformation $remittanceInformation): void
    {
        $this->remittanceInformation = $remittanceInformation;
    }

    /**
     * @param PaymentAgent|null $intermediaryAgent1
     */
    public function setIntermediaryAgent1(?PaymentAgent $intermediaryAgent1): void
    {
        $this->intermediaryAgent1 = $intermediaryAgent1;
    }

    /**
     * @param PaymentAgent|null $creditorAgent
     */
    public function setCreditorAgent(?PaymentAgent $creditorAgent): void
    {
        $this->creditorAgent = $creditorAgent;
    }
}
