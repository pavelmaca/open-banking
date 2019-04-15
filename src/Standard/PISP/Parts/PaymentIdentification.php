<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class PaymentIdentification implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionIdentification")
     * @var string
     */
    protected $instructionIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="endToEndIdentification")
     * @var string|null
     */
    protected $endToEndIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="transactionIdentification")
     * @var string|null
     */
    protected $transactionIdentification;

    public function __construct(string $instructionIdentification)
    {
        $this->instructionIdentification = $instructionIdentification;
    }

    /**
     * @return string
     */
    public function getInstructionIdentification(): string
    {
        return $this->instructionIdentification;
    }

    /**
     * @param string $instructionIdentification
     */
    public function setInstructionIdentification(string $instructionIdentification): void
    {
        $this->instructionIdentification = $instructionIdentification;
    }

    /**
     * @return string|null
     */
    public function getEndToEndIdentification(): ?string
    {
        return $this->endToEndIdentification;
    }

    /**
     * @param string|null $endToEndIdentification
     */
    public function setEndToEndIdentification(?string $endToEndIdentification): void
    {
        $this->endToEndIdentification = $endToEndIdentification;
    }

    /**
     * @return string|null
     */
    public function getTransactionIdentification(): ?string
    {
        return $this->transactionIdentification;
    }

    /**
     * @param string|null $transactionIdentification
     */
    public function setTransactionIdentification(?string $transactionIdentification): void
    {
        $this->transactionIdentification = $transactionIdentification;
    }
}
