<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class Account implements ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="id")
     * @var string
     */
    protected $id;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification.iban")
     * @var string
     */
    protected $iban;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="identification.other")
     * @var string|null
     */
    protected $accountNumber;


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="currency")
     * @var string|null
     */
    protected $currency;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="servicer.bankCode")
     * @var string|null
     */
    protected $servicerBankCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="servicer.countryCode")
     * @var string|null
     */
    protected $servicerCountryCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="servicer.bic")
     * @var string|null
     */
    protected $servicerBic;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="nameI18N")
     * @var string|null
     */
    protected $accountName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="productI18N")
     * @var string|null
     */
    protected $productName;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @return string|null
     */
    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getServicerBankCode(): ?string
    {
        return $this->servicerBankCode;
    }

    /**
     * @return string|null
     */
    public function getServicerCountryCode(): ?string
    {
        return $this->servicerCountryCode;
    }

    /**
     * @return string|null
     */
    public function getServicerBic(): ?string
    {
        return $this->servicerBic;
    }

    /**
     * @return string|null
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }
}
