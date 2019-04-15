<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use PavelMaca\OpenBanking\Hydratation\CISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckStatus;

/**
 * Wrapper  pro kontroly zůstatku
 *
 * @package PavelMaca\OpenBanking\Standard
 */
class BalanceCheck
{
    /** @var CISPConnector */
    protected $bankApi;

    /** @var CISPHydratatorInterface */
    protected $hydratator;

    public function __construct(CISPConnector $bankApi)
    {
        $this->bankApi = $bankApi;
        $this->hydratator = $bankApi->getCISPHydratator();
    }

    /**
     * @param BalanceCheckRequest $balanceChackRequest
     * @return CISP\BalanceCheckStatus
     * @throws Exception\StandardException
     */
    public function getBalanceCheck(BalanceCheckRequest $balanceChackRequest) : BalanceCheckStatus
    {
        // 3.2.3 Dotaz na dostatek prostředků (POST /my/payments/balanceCheck)
        $data = $this->bankApi->getBalanceCheck($balanceChackRequest);
        return $this->hydratator->hydrateBalanceCheck($data);
    }
}
