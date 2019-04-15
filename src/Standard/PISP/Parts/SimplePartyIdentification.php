<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class SimplePartyIdentification implements RequestObject, ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="name")
     * @var string|null
     */
    protected $name = null;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="postalAddress", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\PostalAddress")
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
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return PostalAddress|null
     */
    public function getPostalAddress(): ?PostalAddress
    {
        return $this->postalAddress;
    }

    /**
     * @param PostalAddress|null $postalAddress
     */
    public function setPostalAddress(?PostalAddress $postalAddress): void
    {
        $this->postalAddress = $postalAddress;
    }
}
