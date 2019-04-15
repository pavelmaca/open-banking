<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP;

use PavelMaca\OpenBanking\Standard\PISP\Parts\DomesticPaymentHelper;
use PavelMaca\OpenBanking\Standard\PISP\Parts\ExchangeRateInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PartyIdentification;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentAgent;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentIdentification;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentTypeInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\RemittanceInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\SimplePartyIdentification;
use PavelMaca\OpenBanking\Standard\RequestObject;

abstract class Payment implements RequestObject
{
    use DomesticPaymentHelper;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="paymentIdentification",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentIdentification")
     * @var PaymentIdentification
     */
    protected $paymentIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="paymentTypeInformation",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentTypeInformation")
     * @var PaymentTypeInformation|null
     */
    protected $paymentTypeInformation = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.instructedAmount.value")
     * @var float
     */
    protected $amount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.instructedAmount.currency")
     * @var string
     */
    protected $currency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="requestedExecutionDate")
     * @var string|null
     */
    protected $requestedExecutionDate = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="exchangeRateInformation",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\ExchangeRateInformation")
     * @var ExchangeRateInformation|null
     */
    protected $exchangeRateInformation = null;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="chargesAccount.identification.iban")
     * @var string|null
     */
    protected $chargesAccountIban = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="chargesAccount.currency")
     * @var string|null
     */
    protected $chargesAccountCurrency = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="ultimateDebtor",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $ultimateDebtor = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtor",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\SimplePartyIdentification")
     * @var SimplePartyIdentification|null
     */
    protected $debtor = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtorAccount.identification.iban")
     * @var string
     */
    protected $debtorAccountIban;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtorAccount.currency")
     * @var string|null
     */
    protected $debtorAccountCurrency = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="intermediaryAgent1",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentAgent")
     * @var PaymentAgent|null
     */
    protected $intermediaryAgent1 = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditorAgent",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentAgent")
     * @var PaymentAgent|null
     */
    protected $creditorAgent = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditor",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\SimplePartyIdentification")
     * @var SimplePartyIdentification|null
     */
    protected $creditor = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditorAccount.identification.iban")
     * @var string
     */
    protected $creditorAccountIban;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditorAccount.currency")
     * @var string|null
     */
    protected $creditorAccountCurrency = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="ultimateCreditor",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PartyIdentification")
     * @var PartyIdentification|null
     */
    protected $ultimateCreditor = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="purpose.code")
     * @var string|null
     */
    protected $purposeCode = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="purpose.proprietary")
     * @var string|null
     */
    protected $purposeProprietary = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionForNextAgent")
     * @var string|null
     */
    protected $instructionForNextAgent = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="remittanceInformation",type="\PavelMaca\OpenBanking\Standard\PISP\Parts\RemittanceInformation")
     * @var RemittanceInformation|null
     */
    protected $remittanceInformation;

    /**
     * @return PaymentIdentification
     */
    public function getPaymentIdentification(): PaymentIdentification
    {
        return $this->paymentIdentification;
    }

    /**
     * @return PaymentTypeInformation|null
     */
    public function getPaymentTypeInformation(): ?PaymentTypeInformation
    {
        return $this->paymentTypeInformation;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getRequestedExecutionDate(): ?string
    {
        return $this->requestedExecutionDate;
    }

    /**
     * @return ExchangeRateInformation|null
     */
    public function getExchangeRateInformation(): ?ExchangeRateInformation
    {
        return $this->exchangeRateInformation;
    }

    /**
     * @return string|null
     */
    public function getChargesAccountIban(): ?string
    {
        return $this->chargesAccountIban;
    }

    /**
     * @return string|null
     */
    public function getChargesAccountCurrency(): ?string
    {
        return $this->chargesAccountCurrency;
    }

    /**
     * @return PartyIdentification|null
     */
    public function getUltimateDebtor(): ?PartyIdentification
    {
        return $this->ultimateDebtor;
    }

    /**
     * @return SimplePartyIdentification|null
     */
    public function getDebtor(): ?SimplePartyIdentification
    {
        return $this->debtor;
    }

    /**
     * @return string
     */
    public function getDebtorAccountIban(): string
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
     * @return SimplePartyIdentification|null
     */
    public function getCreditor(): ?SimplePartyIdentification
    {
        return $this->creditor;
    }

    /**
     * @return PaymentAgent
     */
    public function getIntermediaryAgent1(): ?PaymentAgent
    {
        return $this->intermediaryAgent1;
    }

    /**
     * @return PaymentAgent
     */
    public function getCreditorAgent(): ?PaymentAgent
    {
        return $this->creditorAgent;
    }


    /**
     * @return string
     */
    public function getCreditorAccountIban(): string
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

    /**
     * @return string|null
     */
    public function getPurposeCode(): ?string
    {
        return $this->purposeCode;
    }

    /**
     * @return string|null
     */
    public function getPurposeProprietary(): ?string
    {
        return $this->purposeProprietary;
    }

    /**
     * @return string|null
     */
    public function getInstructionForNextAgent(): ?string
    {
        return $this->instructionForNextAgent;
    }

    /**
     * @return RemittanceInformation|null
     */
    public function getRemittanceInformation(): ?RemittanceInformation
    {
        return $this->remittanceInformation;
    }
}
