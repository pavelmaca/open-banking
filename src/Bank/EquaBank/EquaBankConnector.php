<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Bank\EquaBank;

use DateTimeInterface;
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
use PavelMaca\OpenBanking\Standard\PISP\PaymentDetail;
use PavelMaca\OpenBanking\Standard\PISPConnector;

class EquaBankConnector extends Connector implements AISConnector, CISPConnector, PISPConnector
{
    const SANDBOX_BASE_URI = 'https://api.equa.cz/sandbox/';
    const PRODUCTION_BASE_URI = 'https://api.equa.cz/';

    /** @var string|null */
    protected $AISPGetAccountsVersion = null;

    /** @var string|null */
    protected $AISPGetTransactionsVersion = null;

    /** @var string|null */
    protected $AISPGetBalance = null;

    /** @var string|null */
    protected $CISPVersion = null;

    /** @var string|null */
    protected $PaymentServicesVersion = null;

    public function __construct(Authentication $authenticator, string $baseURI = self::PRODUCTION_BASE_URI)
    {
        parent::__construct($authenticator, $baseURI);
    }

    /**
     * @return string|null
     */
    public function getAISPGetAccountsVersion(): ?string
    {
        return $this->AISPGetAccountsVersion;
    }

    /**
     * @param string|null $AISPGetAccountsVersion
     */
    public function setAISPGetAccountsVersion(?string $AISPGetAccountsVersion): void
    {
        $this->AISPGetAccountsVersion = $AISPGetAccountsVersion;
    }

    /**
     * @return string|null
     */
    public function getAISPGetTransactionsVersion(): ?string
    {
        return $this->AISPGetTransactionsVersion;
    }

    /**
     * @param string|null $AISPGetTransactionsVersion
     */
    public function setAISPGetTransactionsVersion(?string $AISPGetTransactionsVersion): void
    {
        $this->AISPGetTransactionsVersion = $AISPGetTransactionsVersion;
    }

    /**
     * @return string|null
     */
    public function getAISPGetBalance(): ?string
    {
        return $this->AISPGetBalance;
    }

    /**
     * @param string|null $AISPGetBalance
     */
    public function setAISPGetBalance(?string $AISPGetBalance): void
    {
        $this->AISPGetBalance = $AISPGetBalance;
    }

    /**
     * @return string|null
     */
    public function getCISPVersion(): ?string
    {
        return $this->CISPVersion;
    }

    /**
     * @param string|null $CISPVersion
     */
    public function setCISPVersion(?string $CISPVersion): void
    {
        $this->CISPVersion = $CISPVersion;
    }

    /**
     * @return string|null
     */
    public function getPaymentServicesVersion(): ?string
    {
        return $this->PaymentServicesVersion;
    }

    /**
     * @param string|null $PaymentServicesVersion
     */
    public function setPaymentServicesVersion(?string $PaymentServicesVersion): void
    {
        $this->PaymentServicesVersion = $PaymentServicesVersion;
    }

    protected function buildPath(string $service, ?string $version, string $path)
    {
        return $service . ($version !== null ? $version . '/' : null) . $path;
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
        return $this->get($this->buildPath('aisp/accounts/', $this->AISPGetAccountsVersion, 'my/accounts'), [
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
        return $this->get($this->buildPath('aisp/balances/', $this->AISPGetBalance, 'my/accounts/' . $accountId . '/balance'), [
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
        $data = $this->get(
            $this->buildPath('aisp/transactions/', $this->AISPGetTransactionsVersion, 'my/accounts/' . $accountId . '/transactions'),
            [
            'currency' => $currency,
            'fromDate' => $dateFrom ? $dateFrom->format(DateTimeInterface::ISO8601) : null,
            'tomDate' => $dateTo ? $dateTo->format(DateTimeInterface::ISO8601) : null,
            'page' => $pageNumber,
            'size' => $pageSize,
            'sort' => $sort,
            'order' => $order,
        ]
        );
        return $data['transactions'];
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
            $this->buildPath('cisp/', $this->CISPVersion, 'accounts/balanceCheck'),
            [],
            $this->getCISPHydratator()->serializeBalanceCheckRequest($balanceChackRequest)
        );
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
            $this->buildPath('pisp/', $this->PaymentServicesVersion, 'my/payments'),
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
        return $this->get($this->buildPath('pisp/', $this->PaymentServicesVersion, 'my/payments/' . $paymentId . '/status'));
    }


    public function getPISPHydratator(): PISPHydratatorInterface
    {
        return new class() extends PISPHydratator {
            public function hydratePaymentInitialization(array $data): PaymentDetail
            {
                if (is_array($data['requestedExecutionDate'])) {
                    // TODO sandbox bug
                    $data['requestedExecutionDate'] = $data['requestedExecutionDate'][0] . '-' . $data['requestedExecutionDate'][1] . '-' . $data['requestedExecutionDate'][2];
                }

                // fix VS, KS, SS structure
                if (isset($data['remittanceInformation']['structured']['creditorReferenceInformation']['reference']) &&
                    !is_array($data['remittanceInformation']['structured']['creditorReferenceInformation']['reference'])) {
                    $data['remittanceInformation']['structured']['creditorReferenceInformation']['reference']
                        = explode(',', $data['remittanceInformation']['structured']['creditorReferenceInformation']['reference'], 3);
                    foreach ($data['remittanceInformation']['structured']['creditorReferenceInformation']['reference'] as $i => $val) {
                        $data['remittanceInformation']['structured']['creditorReferenceInformation']['reference'][$i] = trim($val);
                    }
                }
                return parent::hydratePaymentInitialization($data);
            }
        };
    }

    public function getCISPHydratator(): CISPHydratatorInterface
    {
        return new CISPHydratator();
    }

    public function getAISPHydratator(): AISPHydratatorInterface
    {
        return new AISPHydratator();
    }
}
