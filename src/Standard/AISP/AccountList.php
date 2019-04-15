<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\AISP;

use PavelMaca\OpenBanking\Standard\PagingInterface;

interface AccountList extends PagingInterface
{

    /**
     * @return Account[]
     */
    public function getAccounts(): array;
}
