<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\AISP\AccountBalance;
use PavelMaca\OpenBanking\Standard\AISP\AccountList;
use PavelMaca\OpenBanking\Standard\AISP\TransactionList;

interface AISPHydratatorInterface
{

    /**
     * @param array $data
     * @return AccountList
     */
    public function hydrateAccoountList(array $data): AccountList;

    /**
     * @param array $data
     * @return AccountBalance
     */
    public function hydrateAccoountBalance(array $data): AccountBalance;

    /**
     * @param array $data
     * @return TransactionList
     */
    public function hydrateAccoountTransactions(array $data): TransactionList;
}
