<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\CISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;

class Card implements RequestObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="cardholderName")
     * @var string
     */
    protected $cardholderName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="maskedPan")
     * @var string
     */
    protected $maskedPan;

    /**
     * CardRequestPart constructor.
     * @param string $maskedPan
     */
    public function __construct(string $maskedPan)
    {
        $this->maskedPan = $maskedPan;
    }

    /**
     * @return string
     */
    public function getCardholderName(): string
    {
        return $this->cardholderName;
    }

    /**
     * @param string $cardholderName
     */
    public function setCardholderName(string $cardholderName): void
    {
        $this->cardholderName = $cardholderName;
    }

    /**
     * @return string
     */
    public function getMaskedPan(): string
    {
        return $this->maskedPan;
    }

    /**
     * @param string $maskedPan
     */
    public function setMaskedPan(string $maskedPan): void
    {
        $this->maskedPan = $maskedPan;
    }
}
