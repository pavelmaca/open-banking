<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class TransactionDetails implements ResponseObject
{
    use DomesticTransactionHelper;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="references", type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionReferences")
     * @var TransactionReferences|null
     */
    protected $references;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="amountDetails", type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAmountDetails")
     * @var TransactionAmountDetails|null
     */
    protected $amountDetails;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="charges.bearer")
     * @var string|null
     */
    protected $chargesBearer;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="relatedParties", type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionParties")
     * @var TransactionParties|null
     */
    protected $relatedParties;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="relatedAgents", type="\PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAgents")
     * @var TransactionAgents|null
     */
    protected $relatedAgents;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="purpose.code")
     * @var string|null
     */
    protected $purposeCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="purpose.proprietary")
     * @var string|null
     */
    protected $purposeProprietary;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="remittanceInformation",type="\PavelMaca\OpenBanking\Standard\AISP\Parts\RemittanceInformation")
     * @var RemittanceInformation|null
     */
    protected $remittanceInformation;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="additionalTransactionInformation")
     * @var string|null
     */
    protected $additionalTransactionInformation;

    /**
     * @return TransactionReferences|null
     */
    public function getReferences(): ?TransactionReferences
    {
        return $this->references;
    }

    /**
     * @return TransactionAmountDetails|null
     */
    public function getAmountDetails(): ?TransactionAmountDetails
    {
        return $this->amountDetails;
    }

    /**
     * @return string|null
     */
    public function getChargesBearer(): ?string
    {
        return $this->chargesBearer;
    }

    /**
     * @return TransactionParties|null
     */
    public function getRelatedParties(): ?TransactionParties
    {
        return $this->relatedParties;
    }

    /**
     * @return TransactionAgents|null
     */
    public function getRelatedAgents(): ?TransactionAgents
    {
        return $this->relatedAgents;
    }

    /**
     * @return string|null
     */
    public function getPurposeCode(): ?string
    {
        return $this->purposeCode;
    }

    /**
     * @return string|null
     */
    public function getPurposeProprietary(): ?string
    {
        return $this->purposeProprietary;
    }

    /**
     * @return RemittanceInformation|null
     */
    public function getRemittanceInformation(): ?RemittanceInformation
    {
        return $this->remittanceInformation;
    }

    /**
     * @return string|null
     */
    public function getAdditionalTransactionInformation(): ?string
    {
        return $this->additionalTransactionInformation;
    }
}
