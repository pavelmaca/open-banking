<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class PrivateIdentification implements RequestObject, ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="other", type="\PavelMaca\OpenBanking\Standard\PISP\Parts\OtherIdentificaion")
     * @var OtherIdentificaion|null
     */
    protected $other;

    /**
     * @return OtherIdentificaion|null
     */
    public function getOther(): ?OtherIdentificaion
    {
        return $this->other;
    }

    /**
     * @param OtherIdentificaion|null $other
     */
    public function setOther(?OtherIdentificaion $other): void
    {
        $this->other = $other;
    }
}
