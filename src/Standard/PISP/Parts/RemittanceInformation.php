<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Standard\RequestObject;
use PavelMaca\OpenBanking\Standard\ResponseObject;

class RemittanceInformation implements ResponseObject, RequestObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="unstructured")
     * @var string
     */
    protected $unstructured;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="structured.creditorReferenceInformation.reference")
     * @var string[]
     */
    protected $creditorReferenceInformation;

    /**
     * @return string
     */
    public function getUnstructured(): string
    {
        return $this->unstructured;
    }

    /**
     * @param string $unstructured
     */
    public function setUnstructured(string $unstructured): void
    {
        $this->unstructured = $unstructured;
    }

    /**
     * @return string[]
     */
    public function getCreditorReferenceInformation(): array
    {
        return $this->creditorReferenceInformation;
    }

    /**
     * @param string[] $creditorReferenceInformation
     */
    public function setCreditorReferenceInformation(array $creditorReferenceInformation): void
    {
        $this->creditorReferenceInformation = $creditorReferenceInformation;
    }
}
