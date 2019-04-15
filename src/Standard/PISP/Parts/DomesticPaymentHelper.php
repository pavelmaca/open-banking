<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\PISP\Parts;

use PavelMaca\OpenBanking\Hydratation\HydratationException;

trait DomesticPaymentHelper
{

    /**
     * @var RemittanceInformation|null
     */
    protected $remittanceInformation;

    public function getVariableSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('VS:');
    }

    /**
     * @param string|null $variableSymbol
     * @throws HydratationException
     */
    public function setVariableSymbol(?string $variableSymbol): void
    {
        $this->setCreditorReferenceInformation('VS:', $variableSymbol);
    }

    public function getConstantSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('KS:');
    }

    /**
     * @param string|null $constantSymbol
     * @throws HydratationException
     */
    public function setConstantSymbol(?string $constantSymbol): void
    {
        $this->setCreditorReferenceInformation('KS:', $constantSymbol);
    }

    public function getSpecificSymbol(): ?string
    {
        return $this->searchCreditorReferenceInformation('SS:');
    }

    /**
     * @param string|null $specificSymbol
     * @throws HydratationException
     */
    public function setSpecificSymbol(?string $specificSymbol): void
    {
        $this->setCreditorReferenceInformation('SS:', $specificSymbol);
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

    /**
     * @param string $key
     * @param mixed $value
     * @throws HydratationException
     */
    private function setCreditorReferenceInformation(string $key, $value): void
    {
        if ($this->remittanceInformation === null) {
            $this->remittanceInformation = new RemittanceInformation();
            $this->remittanceInformation->setCreditorReferenceInformation([$key . $value]);
            return;
        }

        $info = $this->remittanceInformation->getCreditorReferenceInformation();

        if (empty($info)) {
            $info = [];
        }

        if (!is_array($info)) {
            throw new HydratationException('Invalid value in remittanceInformation.creditorReferenceInformation, expected array');
        }

        foreach ($info as $i => $part) {
            if (strpos($part, $key) === 0) {
                $info[$i] = $key . $value;
                break;
            }
        }

        $this->remittanceInformation->setCreditorReferenceInformation($info);
    }
}
