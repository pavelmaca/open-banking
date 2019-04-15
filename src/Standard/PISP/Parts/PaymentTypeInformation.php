<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class PaymentTypeInformation implements RequestObject, ResponseObject
{

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="instructionPriority")
     * @var string
     */
    protected $instructionPriority;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="serviceLevel.code")
     * @var string
     */
    protected $serviceLevelCode;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="categoryPurpose.code")
     * @var string
     */
    protected $categoryPurposeCode;

    /**
     * @return string
     */
    public function getInstructionPriority(): string
    {
        return $this->instructionPriority;
    }

    /**
     * @param string $instructionPriority
     */
    public function setInstructionPriority(string $instructionPriority): void
    {
        $this->instructionPriority = $instructionPriority;
    }

    /**
     * @return string
     */
    public function getServiceLevelCode(): string
    {
        return $this->serviceLevelCode;
    }

    /**
     * @param string $serviceLevelCode
     */
    public function setServiceLevelCode(string $serviceLevelCode): void
    {
        $this->serviceLevelCode = $serviceLevelCode;
    }

    /**
     * @return string
     */
    public function getCategoryPurposeCode(): string
    {
        return $this->categoryPurposeCode;
    }

    /**
     * @param string $categoryPurposeCode
     */
    public function setCategoryPurposeCode(string $categoryPurposeCode): void
    {
        $this->categoryPurposeCode = $categoryPurposeCode;
    }
}
