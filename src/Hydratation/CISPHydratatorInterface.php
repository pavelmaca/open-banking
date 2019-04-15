<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckStatus;

interface CISPHydratatorInterface
{
    public function hydrateBalanceCheck(array $data): BalanceCheckStatus;

    public function serializeBalanceCheckRequest(BalanceCheckRequest $checkRequest): array;
}
