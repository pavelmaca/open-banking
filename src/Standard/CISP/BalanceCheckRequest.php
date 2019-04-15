<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\CISP;

use PavelMaca\OpenBanking\Standard\CISP\Parts\Card;
use PavelMaca\OpenBanking\Standard\CISP\Parts\Merchant;
use PavelMaca\OpenBanking\Standard\CISP\Parts\TransactionDetail;
use PavelMaca\OpenBanking\Standard\RequestObject;

class BalanceCheckRequest implements RequestObject
{

    /**
     * Clear query identification
     * @PavelMaca\OpenBanking\Mapping\Property(path="exchangeIdentification")
     * @var string
     */
    protected $exchangeIdentification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="card",type="\PavelMaca\OpenBanking\Standard\CISP\Parts\Card")
     * @var Card|null
     */
    protected $card = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="debtorAccount.iban")
     * @var string
     */
    protected $debtorAccountIban;

    /**
     *  In case that the third party and merchant are different entities.
     * @PavelMaca\OpenBanking\Mapping\Property(path="merchant",type="\PavelMaca\OpenBanking\Standard\CISP\Parts\Merchant")
     * @var Merchant|null
     */
    protected $merchant = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="transactionDetails",type="\PavelMaca\OpenBanking\Standard\CISP\Parts\TransactionDetail")
     * @var TransactionDetail
     */
    protected $transactionDetails;


    public function __construct(string $exchangeIdentification, string $debtorAccountIban, TransactionDetail $transactionDetails)
    {
        $this->exchangeIdentification = $exchangeIdentification;
        $this->debtorAccountIban = $debtorAccountIban;
        $this->transactionDetails = $transactionDetails;
    }

    /**
     * @return string
     */
    public function getExchangeIdentification(): string
    {
        return $this->exchangeIdentification;
    }

    /**
     * @param string $exchangeIdentification
     */
    public function setExchangeIdentification(string $exchangeIdentification): void
    {
        $this->exchangeIdentification = $exchangeIdentification;
    }

    /**
     * @return Card|null
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * @param Card|null $card
     */
    public function setCard(?Card $card): void
    {
        $this->card = $card;
    }

    /**
     * @return string
     */
    public function getDebtorAccountIban(): string
    {
        return $this->debtorAccountIban;
    }

    /**
     * @param string $debtorAccountIban
     */
    public function setDebtorAccountIban(string $debtorAccountIban): void
    {
        $this->debtorAccountIban = $debtorAccountIban;
    }

    /**
     * @return Merchant|null
     */
    public function getMerchant(): ?Merchant
    {
        return $this->merchant;
    }

    /**
     * @param Merchant|null $merchant
     */
    public function setMerchant(?Merchant $merchant): void
    {
        $this->merchant = $merchant;
    }

    /**
     * @return TransactionDetail
     */
    public function getTransactionDetails(): TransactionDetail
    {
        return $this->transactionDetails;
    }

    /**
     * @param TransactionDetail $transactionDetails
     */
    public function setTransactionDetails(TransactionDetail $transactionDetails): void
    {
        $this->transactionDetails = $transactionDetails;
    }
}
