<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class CounterValueAmount implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.value")
     * @var float
     */
    protected $amount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.currency")
     * @var string
     */
    protected $currency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="currencyExchange",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionCurrencyExchange")
     * @var TransactionCurrencyExchange|null
     */
    protected $currencyExchange;

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
     * @return TransactionCurrencyExchange|null
     */
    public function getCurrencyExchange(): ?TransactionCurrencyExchange
    {
        return $this->currencyExchange;
    }
}
