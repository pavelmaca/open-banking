<?php
declare(strict_types=1);



namespace PavelMaca\OpenBanking\Standard\AISP;

use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionDetails;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class Transaction implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="entryReference")
     * @var string
     */
    protected $id;

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
     * @PavelMaca\OpenBanking\Mapping\Property(path="creditDebitIndicator")
     * @var string|null
     */
    protected $creditDebitIndicator;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="reversalIndicator")
     * @var bool|null
     */
    protected $reversalIndicator;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="status")
     * @var string|null
     */
    protected $status;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="bookingDate.date")
     * @var string|null
     */
    protected $bookingDate;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="valueDate.date")
     * @var string|null
     */
    protected $valueDate;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="bankTransactionCode.proprietary.code")
     * @var string|null
     */
    protected $bankTransactionCode;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="bankTransactionCode.proprietary.issuer")
     * @var string|null
     */
    protected $bankTransactionCodeIssuer;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="entryDetails.transactionDetails",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionDetails")
     * @var TransactionDetails|null
     */
    protected $transactionDetail;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getCreditDebitIndicator(): ?string
    {
        return $this->creditDebitIndicator;
    }

    /**
     * @return bool|null
     */
    public function getReversalIndicator(): ?bool
    {
        return $this->reversalIndicator;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getBookingDate(): ?string
    {
        return $this->bookingDate;
    }

    /**
     * @return string|null
     */
    public function getValueDate(): ?string
    {
        return $this->valueDate;
    }

    /**
     * @return string|null
     */
    public function getBankTransactionCode(): ?string
    {
        return $this->bankTransactionCode;
    }

    /**
     * @return string|null
     */
    public function getBankTransactionCodeIssuer(): ?string
    {
        return $this->bankTransactionCodeIssuer;
    }

    /**
     * @return TransactionDetails|null
     */
    public function getTransactionDetail(): ?TransactionDetails
    {
        return $this->transactionDetail;
    }
}
