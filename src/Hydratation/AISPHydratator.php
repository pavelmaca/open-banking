<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\AISP\Account;
use PavelMaca\OpenBanking\Standard\AISP\AccountBalance;
use PavelMaca\OpenBanking\Standard\AISP\AccountList;
use PavelMaca\OpenBanking\Standard\AISP\Transaction;
use PavelMaca\OpenBanking\Standard\AISP\TransactionList;
use PavelMaca\OpenBanking\Standard\StandardPaging;

class AISPHydratator extends StandardHydratator implements AISPHydratatorInterface
{
    public function hydrateAccoountList(array $data): AccountList
    {
        $accountsData = $data['accounts'];

        $accounts = [];
        foreach ($accountsData as $accountData) {
            $accounts[] = $this->hydrate(Account::class, $accountData);
        }

        $accountList = new class($data['pageNumber'], $data['pageCount'], $data['nextPage'], $data['pageSize'], $data['totalCount'] ?? null, $accounts) extends StandardPaging implements AccountList {
            protected $accounts;

            public function __construct(?int $pageNumber = null, ?int $pageCount = null, ?int $nextPage = null, ?int $pageSize = null, ?int $totalCount = null, array $accounts = [])
            {
                parent::__construct($pageNumber, $pageCount, $nextPage, $pageSize, $totalCount);
                $this->accounts = $accounts;
            }


            public function getAccounts(): array
            {
                return $this->accounts;
            }
        };


        return $accountList;
    }

    public function hydrateAccoountBalance(array $data): AccountBalance
    {
        $balancesData = $data['balances'];
        /** @var AccountBalance $accountBalance */
        $accountBalance = $this->hydrate(AccountBalance::class, $balancesData[0]);
        return $accountBalance;
    }

    public function hydrateAccoountTransactions(array $data): TransactionList
    {
        $transactionsData = $data;

        $transactions = [];
        foreach ($transactionsData['transactions'] as $transactionData) {
            $transactions[] = $this->hydrate(Transaction::class, $transactionData);
        }

        $transactionList = new class($data['pageNumber'], $data['pageCount'], $data['nextPage'], $data['pageSize'], $data['totalCount'] ?? null, $transactions) extends StandardPaging implements TransactionList {
            protected $transactions = [];

            public function __construct(?int $pageNumber = null, ?int $pageCount = null, ?int $nextPage = null, ?int $pageSize = null, ?int $totalCount = null, array $transactions = [])
            {
                parent::__construct($pageNumber, $pageCount, $nextPage, $pageSize, $totalCount);
                $this->transactions = $transactions;
            }

            public function getTransactions(): array
            {
                return $this->transactions;
            }
        };

        return $transactionList;
    }
}
