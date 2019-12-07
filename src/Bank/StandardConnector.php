<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Bank;

use DateTimeInterface;
use InvalidArgumentException;
use PavelMaca\OpenBanking\Auth\Authentication;
use PavelMaca\OpenBanking\Connector;
use PavelMaca\OpenBanking\Hydratation\AISPHydratator;
use PavelMaca\OpenBanking\Hydratation\AISPHydratatorInterface;
use PavelMaca\OpenBanking\Hydratation\CISPHydratator;
use PavelMaca\OpenBanking\Hydratation\CISPHydratatorInterface;
use PavelMaca\OpenBanking\Hydratation\PISPHydratator;
use PavelMaca\OpenBanking\Hydratation\PISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\AISConnector;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\CISPConnector;
use PavelMaca\OpenBanking\Standard\Exception\InvalidParametrException;
use PavelMaca\OpenBanking\Standard\Exception\InvalidResponseException;
use PavelMaca\OpenBanking\Standard\Exception\NotFoundException;
use PavelMaca\OpenBanking\Standard\Exception\UnauthorisedException;
use PavelMaca\OpenBanking\Standard\Exception\UnknowRequestErrorException;
use PavelMaca\OpenBanking\Standard\PISP\Payment;
use PavelMaca\OpenBanking\Standard\PISPConnector;

class StandardConnector extends Connector implements AISConnector, CISPConnector, PISPConnector
{
    /** @var string */
    protected $apiVersion;

    /**
     * StandardConnector constructor.
     * @param Authentication $authenticator
     * @param string $baseURI
     * @param string $apiVersion
     * @throws InvalidArgumentException
     */
    public function __construct(Authentication $authenticator, string $baseURI, string $apiVersion)
    {
        parent::__construct($authenticator, $baseURI);
        $this->apiVersion = $apiVersion;
    }


    /**
     * @param int|null $pageSize
     * @param int|null $pageNumber
     * @param string|null $sort
     * @param string|null $order
     * @return array
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    public function getAccountList(?int $pageSize = null, ?int $pageNumber = null, ?string $sort = null, ?string $order = null): array
    {
        return $this->get('account-information/my/accounts', [
            'page' => $pageNumber,
            'size' => $pageSize,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    /**
     * @param string $accountId
     * @param string|null $currency
     * @return array
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    public function getAccountBalance(string $accountId, ?string $currency = null): array
    {
        return $this->get('account-information/my/accounts/' . $accountId . '/balance', [
            'currency' => $currency,
        ]);
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
     * @return array
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
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
    ): array {
        return $this->get('account-information/my/accounts/' . $accountId . '/transactions', [
            'currency' => $currency,
            'fromDate' => $dateFrom ? $dateFrom->format(DateTimeInterface::ISO8601) : null,
            'tomDate' => $dateTo ? $dateTo->format(DateTimeInterface::ISO8601) : null,
            'page' => $pageNumber,
            'size' => $pageSize,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    public function getAISPHydratator(): AISPHydratatorInterface
    {
        return new AISPHydratator();
    }

    /**
     * @param BalanceCheckRequest $balanceChackRequest
     * @return array|mixed
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    public function getBalanceCheck(BalanceCheckRequest $balanceChackRequest)
    {
        return $this->post(
            'payment-initiation/my/payments/balanceCheck',
            [],
            $this->getCISPHydratator()->serializeBalanceCheckRequest($balanceChackRequest)
        );
    }

    public function getCISPHydratator(): CISPHydratatorInterface
    {
        return new CISPHydratator();
    }


    /**
     * @param Payment $paymentInitialization
     * @return array
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    public function createPayment(Payment $paymentInitialization)
    {
        return $this->post(
            'payment-initiation/my/payments',
            [],
            $this->getPISPHydratator()->serializePaymentInitialization($paymentInitialization)
        );
    }

    /**
     * @param string $paymentId
     * @return array
     * @throws InvalidParametrException
     * @throws InvalidResponseException
     * @throws NotFoundException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    public function getPaymentStatus(string $paymentId)
    {
        return $this->get('payment-initiation/my/payments/' . $paymentId . '/status');
    }


    public function getPISPHydratator(): PISPHydratatorInterface
    {
        return new PISPHydratator();
    }


    protected function get(string $path, array $queryParams = []): array
    {
        return parent::get($this->apiVersion . '/' . $path, $queryParams);
    }

    protected function post(string $path, array $queryParams, array $bodyParametrs): array
    {
        return parent::post($this->apiVersion . '/' . $path, $queryParams, $bodyParametrs);
    }
}
