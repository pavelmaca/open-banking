<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class TransactionReferences implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="messageIdentification")
     * @var string|null
     */
    protected $messageIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="accountServicerReference")
     * @var string|null
     */
    protected $accountServicerReference;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="paymentInformationIdentification")
     * @var string|null
     */
    protected $paymentInformationIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionIdentification")
     * @var string|null
     */
    protected $instructionIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="endToEndIdentification")
     * @var string|null
     */
    protected $endToEndIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="mandateIdentification")
     * @var string|null
     */
    protected $mandateIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="chequeNumber")
     * @var string|null
     */
    protected $chequeNumber;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="clearingSystemReference")
     * @var string|null
     */
    protected $clearingSystemReference;

    /**
     * @return string|null
     */
    public function getMessageIdentification(): ?string
    {
        return $this->messageIdentification;
    }

    /**
     * @return string|null
     */
    public function getAccountServicerReference(): ?string
    {
        return $this->accountServicerReference;
    }

    /**
     * @return string|null
     */
    public function getPaymentInformationIdentification(): ?string
    {
        return $this->paymentInformationIdentification;
    }

    /**
     * @return string|null
     */
    public function getInstructionIdentification(): ?string
    {
        return $this->instructionIdentification;
    }

    /**
     * @return string|null
     */
    public function getEndToEndIdentification(): ?string
    {
        return $this->endToEndIdentification;
    }

    /**
     * @return string|null
     */
    public function getMandateIdentification(): ?string
    {
        return $this->mandateIdentification;
    }

    /**
     * @return string|null
     */
    public function getChequeNumber(): ?string
    {
        return $this->chequeNumber;
    }

    /**
     * @return string|null
     */
    public function getClearingSystemReference(): ?string
    {
        return $this->clearingSystemReference;
    }
}
