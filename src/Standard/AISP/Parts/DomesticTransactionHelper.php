<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP\Parts;

trait DomesticTransactionHelper
{
    /**
     * @var RemittanceInformation|null
     */
    protected $remittanceInformation;


    abstract public function getAdditionalTransactionInformation(): ?string;

    public function getDescription(): ?string
    {
        return $this->getAdditionalTransactionInformation();
    }

    public function getVariableSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('VS:');
    }

    public function getConstantSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('KS:');
    }

    public function getSpecificSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('SS:');
    }

    private function searchCreditorReferenceInformation(string $search): ?string
    {
        if ($this->remittanceInformation === null) {
            return null;
        }

        $info = $this->remittanceInformation->getCreditorReferenceInformation();

        if (!is_array($info)) {
            return null;
        }

        foreach ($info as $part) {
            if (strpos($part, $search) === 0) {
                return substr($part, 3, -1);
            }
        }

        return null;
    }
}
