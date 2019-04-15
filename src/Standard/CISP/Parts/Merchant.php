<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\CISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;

class Merchant implements RequestObject
{
    const CODE_OPOI = 'OPOI'; // Point Of Interaction initiating the card payment transaction.
    const CODE_MERC = 'MERC'; // Merchant providing goods and service in the card payment transaction.
    const CODE_ACCP = 'ACCP'; // Card acceptor, party accepting the card and presenting transaction data to the acquirer.
    const CODE_ITAG = 'ITAG'; // Agent Party acting on behalf of other parties to process or forward data to other parties.
    const CODE_ACQR = 'ACQR'; // Entity acquiring card transactions.
    const CODE_CISS = 'CISS'; // Party that issues cards.
    const CODE_DLIS = 'DLIS'; // Party to whom the card issuer delegates to authorise card payment transactions.


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="currency")
     * @var string
     */
    protected $identification;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="type")
     * @var string|null @see self::CODE_
     */
    protected $type = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="shortName")
     * @var string
     */
    protected $shortName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="commonName")
     * @var string
     */
    protected $commonName;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="address")
     * @var string|null
     */
    protected $address = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="countryCode")
     * @var string|null
     */
    protected $countryCode = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="merchantCategoryCode")
     * @var string
     */
    protected $merchantCategoryCode;

    /**
     * MerchantRequestPart constructor.
     * @param string $identification
     * @param string $shortName
     * @param string $commonName
     * @param string $merchantCategoryCode
     */
    public function __construct(string $identification, string $shortName, string $commonName, string $merchantCategoryCode)
    {
        $this->identification = $identification;
        $this->shortName = $shortName;
        $this->commonName = $commonName;
        $this->merchantCategoryCode = $merchantCategoryCode;
    }

    /**
     * @return string
     */
    public function getIdentification(): string
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }


    /**
     * @return string
     */
    public function getCommonName(): string
    {
        return $this->commonName;
    }

    /**
     * @param string $commonName
     */
    public function setCommonName(string $commonName): void
    {
        $this->commonName = $commonName;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     */
    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getMerchantCategoryCode(): string
    {
        return $this->merchantCategoryCode;
    }

    /**
     * @param string $merchantCategoryCode
     */
    public function setMerchantCategoryCode(string $merchantCategoryCode): void
    {
        $this->merchantCategoryCode = $merchantCategoryCode;
    }
}
