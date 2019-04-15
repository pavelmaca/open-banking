<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

/**
 * Details of the payment amount,
 * especially if it is a conversion payment or cashback.
 * @package PavelMaca\OpenBanking\Standard\AISP\Transaction
 */
class TransactionAmountDetails implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructedAmount.amount.value")
     * @var float
     */
    protected $instructedAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructedAmount.amount.currency")
     * @var string
     */
    protected $instructedAmountCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="transactionAmount.amount.value")
     * @var float
     */
    protected $transactionAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="transactionAmount.amount.currency")
     * @var string
     */
    protected $transactionAmountCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="counterValueAmount",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\CounterValueAmount")
     * @var CounterValueAmount|null
     */
    protected $counterValueAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="proprietaryAmount.amount.value")
     * @var float
     */
    protected $proprietaryAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="proprietaryAmount.amount.currency")
     * @var string
     */
    protected $proprietaryAmountCurrency;

    /**
     * @return float
     */
    public function getInstructedAmount(): float
    {
        return $this->instructedAmount;
    }

    /**
     * @return string
     */
    public function getInstructedAmountCurrency(): string
    {
        return $this->instructedAmountCurrency;
    }

    /**
     * @return float
     */
    public function getTransactionAmount(): float
    {
        return $this->transactionAmount;
    }

    /**
     * @return string
     */
    public function getTransactionAmountCurrency(): string
    {
        return $this->transactionAmountCurrency;
    }

    /**
     * @return CounterValueAmount|null
     */
    public function getCounterValueAmount(): ?CounterValueAmount
    {
        return $this->counterValueAmount;
    }

    /**
     * @return float
     */
    public function getProprietaryAmount(): float
    {
        return $this->proprietaryAmount;
    }

    /**
     * @return string
     */
    public function getProprietaryAmountCurrency(): string
    {
        return $this->proprietaryAmountCurrency;
    }
}
