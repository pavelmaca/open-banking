<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP;

use PavelMaca\OpenBanking\Standard\PagingInterface;

interface TransactionList extends PagingInterface
{

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array;
}
