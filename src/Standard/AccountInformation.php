<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use DateTimeInterface;
use PavelMaca\OpenBanking\Hydratation\AISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\AISP\AccountBalance;
use PavelMaca\OpenBanking\Standard\AISP\AccountList;
use PavelMaca\OpenBanking\Standard\AISP\TransactionList;
use PavelMaca\OpenBanking\Standard\Exception\StandardException;

/**
 * Wrapper  pro informace o účtu
 *
 * @package PavelMaca\OpenBanking\Standard
 */
class AccountInformation
{
    /** @var AISConnector */
    protected $bankApi;

    /** @var AISPHydratatorInterface */
    protected $hydratator;

    public function __construct(AISConnector $bankApi)
    {
        $this->bankApi = $bankApi;
        $this->hydratator = $bankApi->getAISPHydratator();
    }


    /**
     * @param int|null $pageSize
     * @param int|null $pageNumber
     * @param string|null $sort
     * @param string|null $order
     * @return AccountList
     * @throws StandardException
     */
    public function getAccountList(
        ?int $pageSize = null,
        ?int $pageNumber = null,
        ?string $sort = null,
        ?string $order = null
    ): AccountList {
        // 3.1.3 Seznam platebních účtů klienta
        // GET /my/accounts{?size,page,sort,order}

        $data = $this->bankApi->getAccountList($pageSize, $pageNumber, $sort, $order);
        return $this->hydratator->hydrateAccoountList($data);
    }


    /**
     * Zůstatek konkrétního účtu klienta podle referenčního id účtu.
     * @param string $accountId
     * @param string|null $currency
     * @return AccountBalance
     * @throws StandardException
     */
    public function getAccountBalance(string $accountId, string $currency = null) : AccountBalance
    {
        // 3.1.4 Zůstatek na účtu
        $data = $this->bankApi->getAccountBalance($accountId, $currency);
        return $this->hydratator->hydrateAccoountBalance($data);
    }

    /**
     * @param string $accountId
     * @param string|null $currency
     * @param DateTimeInterface|null $dateFrom
     * @param DateTimeInterface|null $dateTo
     * @param int|null $pageSize
     * @param int|null $pageNumber
     * @param string|null $sort
     * @param string|null $order
     * @return TransactionList
     * @throws StandardException
     */
    public function getAccountTransactions(
        string $accountId,
        ?string $currency = null,
        ?DateTimeInterface $dateFrom = null,
        ?DateTimeInterface $dateTo = null,
        ?int $pageSize = null,
        ?int $pageNumber = null,
        ?string $sort = null,
        ?string $order = null
    ): TransactionList {
        $data = $this->bankApi->getAccountTransactions(
            $accountId,
            $currency,
            $dateFrom,
            $dateTo,
            $pageSize,
            $pageNumber,
            $sort,
            $order
        );
        return $this->hydratator->hydrateAccoountTransactions($data);
    }
}
