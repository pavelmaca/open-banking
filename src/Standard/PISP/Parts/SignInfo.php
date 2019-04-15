<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class SignInfo implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="state")
     * @var string
     */
    protected $state;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="signId")
     * @var string
     */
    protected $signId;

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getSignId(): string
    {
        return $this->signId;
    }
}
