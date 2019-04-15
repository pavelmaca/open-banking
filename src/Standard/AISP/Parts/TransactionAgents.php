<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class TransactionAgents implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="relatedAgents.debtorAgent"type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAgent")
     * @var TransactionAgent|null
     */
    protected $debtorAgent;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="relatedAgents.creditorAgent"type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAgent")
     * @var TransactionAgent|null
     */
    protected $creditorAgent;

    /**
     * @return TransactionAgent|null
     */
    public function getDebtorAgent(): ?TransactionAgent
    {
        return $this->debtorAgent;
    }

    /**
     * @return TransactionAgent|null
     */
    public function getCreditorAgent(): ?TransactionAgent
    {
        return $this->creditorAgent;
    }
}
