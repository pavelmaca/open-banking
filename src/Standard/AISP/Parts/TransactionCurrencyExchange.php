<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class TransactionCurrencyExchange implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="sourceCurrency")
     * @var string
     */
    protected $sourceCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="targetCurrency")
     * @var string
     */
    protected $targetCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="exchangeRate")
     * @var float
     */
    protected $exchangeRate;

    /**
     * @return string
     */
    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    /**
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    /**
     * @return float
     */
    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }
}
