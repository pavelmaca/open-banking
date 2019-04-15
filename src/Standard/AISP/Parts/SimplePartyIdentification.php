<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class SimplePartyIdentification implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="name")
     * @var string|null
     */
    protected $name = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="postalAddress",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\PostalAddress")
     * @var PostalAddress|null
     */
    protected $postalAddress = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return PostalAddress|null
     */
    public function getPostalAddress(): ?PostalAddress
    {
        return $this->postalAddress;
    }
}
