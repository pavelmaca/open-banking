<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use PavelMaca\OpenBanking\Hydratation\CISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\Exception\StandardException;

interface CISPConnector extends Connector
{

    /**
     * @param BalanceCheckRequest $balanceChackRequest
     * @return mixed
     * @throws StandardException
     */
    public function getBalanceCheck(BalanceCheckRequest $balanceChackRequest);

    public function getCISPHydratator(): CISPHydratatorInterface;
}
