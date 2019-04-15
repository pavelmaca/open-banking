<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckStatus;

class CISPHydratator extends StandardHydratator implements CISPHydratatorInterface
{
    public function hydrateBalanceCheck(array $data): BalanceCheckStatus
    {
        /** @var BalanceCheckStatus $balanceCheck */
        $balanceCheck = $this->hydrate(BalanceCheckStatus::class, $data);
        return $balanceCheck;
    }

    public function serializeBalanceCheckRequest(BalanceCheckRequest $balanceCheck): array
    {
        return $this->serialize($balanceCheck);
    }
}
