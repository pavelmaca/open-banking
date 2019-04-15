<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class PaymentStatus implements ResponseObject
{
    /**
     * Authentication and syntactical and semantical validation are successful
     */
    const STATUS_ACTC = 'ACTC';

    /**
     * Payment initiation or individual transaction included in the payment initiation has been rejected
     */
    const STATUS_REJECTED = 'RJCT';

    /**
     * All preceding checks such as technical validation and customer profile were successful and
     * therefore the payment initiation has been accepted for execution
     */
    const STATUS_ACCEPTED_SETTLEMENT_IN_PROCESS = 'ACSP';

    /**
     * Settlement on the debtor´s account has been completed.
     */
    const STATUS_ACCEPTED_SETTLEMENT_COMPLETED = 'ACSC';

    /**
     * Instruction is accepted but a change will be made, such as date or remittance not change
     */
    const STATUS_ACCEPTED_WITH_CHANGE = 'ACWC';


    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionStatus")
     * @var string @see self::STATUS_
     */
    protected $instructionStatus;

    /**
     * @return string
     */
    public function getInstructionStatus(): string
    {
        return $this->instructionStatus;
    }
}
