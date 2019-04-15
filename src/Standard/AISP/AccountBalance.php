<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class AccountBalance implements ResponseObject
{
    const TYPE_CLAV = "CLAV";
    const TYPE_CLBD = "CLBD";
    const TYPE_PRCD = "PRCD";

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="type.codeOrProprietary.code")
     * @var string @see self::Type_
     */
    protected $type;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditLine.amount.value")
     * @var float|null
     */
    protected $creditAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditLine.amount.currency")
     * @var string|null
     */
    protected $creditCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditLine.included")
     * @var bool|null
     */
    protected $creditIncluded;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.value")
     * @var float
     */
    protected $balanceAmount;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amount.currency")
     * @var string
     */
    protected $balanceCurrency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditDebitIndicator")
     * @var string
     */
    protected $creditDebitIndicator;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="date.dateTime")
     * @var string
     */
    protected $dateTime;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float|null
     */
    public function getCreditAmount(): ?float
    {
        return $this->creditAmount;
    }

    /**
     * @return string|null
     */
    public function getCreditCurrency(): ?string
    {
        return $this->creditCurrency;
    }

    /**
     * @return bool|null
     */
    public function getCreditIncluded(): ?bool
    {
        return $this->creditIncluded;
    }

    /**
     * @return float
     */
    public function getBalanceAmount(): float
    {
        return $this->balanceAmount;
    }

    /**
     * @return string
     */
    public function getBalanceCurrency(): string
    {
        return $this->balanceCurrency;
    }

    /**
     * @return string
     */
    public function getCreditDebitIndicator(): string
    {
        return $this->creditDebitIndicator;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }
}
