<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class PrivateIdentification implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="other",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\OtherIdentificaion")
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
}
