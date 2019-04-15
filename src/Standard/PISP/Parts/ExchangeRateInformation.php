<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class ExchangeRateInformation implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="exchangeRate")
     * @var string|null
     */
    protected $exchangeRate = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="rateType")
     * @var string|null
     */
    protected $rateType = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="contractIdentification")
     * @var string|null
     */
    protected $contractIdentification = null;

    /**
     * @return string|null
     */
    public function getExchangeRate(): ?string
    {
        return $this->exchangeRate;
    }

    /**
     * @param string|null $exchangeRate
     */
    public function setExchangeRate(?string $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return string|null
     */
    public function getRateType(): ?string
    {
        return $this->rateType;
    }

    /**
     * @param string|null $rateType
     */
    public function setRateType(?string $rateType): void
    {
        $this->rateType = $rateType;
    }

    /**
     * @return string|null
     */
    public function getContractIdentification(): ?string
    {
        return $this->contractIdentification;
    }

    /**
     * @param string|null $contractIdentification
     */
    public function setContractIdentification(?string $contractIdentification): void
    {
        $this->contractIdentification = $contractIdentification;
    }
}
