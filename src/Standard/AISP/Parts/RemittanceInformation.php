<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class RemittanceInformation implements ResponseObject
{
    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="unstructured")
     * @var string|null
     */
    protected $unstructured;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="structured.creditorReferenceInformation.reference")
     * @var string|null
     */
    protected $creditorReferenceInformation;

    /**
     * @return string|null
     */
    public function getUnstructured(): ?string
    {
        return $this->unstructured;
    }

    /**
     * @return string|null
     */
    public function getCreditorReferenceInformation(): ?string
    {
        return $this->creditorReferenceInformation;
    }
}
