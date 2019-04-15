<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP;

use PavelMaca\OpenBanking\Standard\PISP\Parts\SignInfo;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class PaymentDetail extends Payment implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="signInfo", type="\PavelMaca\OpenBanking\Standard\PISP\PaymentRequest\SignInfo")
     * @var SignInfo
     */
    protected $signInfo;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionStatus")
     * @var string|null @see PaymentStatus
     */
    protected $instructionStatus = null;

    /**
     * @return SignInfo
     */
    public function getSignInfo(): SignInfo
    {
        return $this->signInfo;
    }

    /**
     * @return string|null
     */
    public function getInstructionStatus(): ?string
    {
        return $this->instructionStatus;
    }
}
