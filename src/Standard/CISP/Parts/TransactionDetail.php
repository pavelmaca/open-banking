<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\CISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;

class TransactionDetail implements RequestObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="currency")
     * @var string
     */
    protected $currency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="totalAmount")
     * @var float
     */
    protected $totalAmount;

    /**
     * TransactionDetailsRequestPart constructor.
     * @param string $currency
     * @param float $totalAmount
     */
    public function __construct(string $currency, float $totalAmount)
    {
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     */
    public function setTotalAmount(float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }
}
