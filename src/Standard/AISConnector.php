<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use DateTimeInterface;
use PavelMaca\OpenBanking\Hydratation\AISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\Exception\StandardException;

interface AISConnector extends Connector
{
    /**
     * @param int|null $pageSize
     * @param int|null $pageNumber
     * @param string|null $sort
     * @param string|null $order
     * @return array
     * @throws StandardException
     */
    public function getAccountList(?int $pageSize = null, ?int $pageNumber = null, ?string $sort = null, ?string $order = null): array;

    /**
     * @param string $accountId
     * @param string|null $currency
     * @return array
     * @throws StandardException
     */
    public function getAccountBalance(string $accountId, ?string $currency = null): array;

    /**
     * @param string $accountId
     * @param string|null $currency
     * @param DateTimeInterface|null $dateFrom
     * @param DateTimeInterface|null $dateTo
     * @param int|null $pageSize
     * @param int|null $pageNumber
     * @param string|null $sort
     * @param string|null $order
     * @return array
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
    ): array;

    public function getAISPHydratator(): AISPHydratatorInterface;
}
