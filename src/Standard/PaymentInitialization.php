<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use PavelMaca\OpenBanking\Hydratation\PISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\PISP\Payment;
use PavelMaca\OpenBanking\Standard\PISP\PaymentDetail;
use PavelMaca\OpenBanking\Standard\PISP\PaymentStatus;

/**
 * Wrapper  pro inicializaci plateb
 *
 * @package PavelMaca\OpenBanking\Standard
 */
class PaymentInitialization extends BalanceCheck
{
    /** @var PISPConnector */
    protected $bankApi;

    /** @var PISPHydratatorInterface */
    protected $hydratator;

    public function __construct(PISPConnector $bankApi)
    {
        parent::__construct($bankApi);
        $this->bankApi = $bankApi;
        $this->hydratator = $bankApi->getPISPHydratator();
    }


    /**
     * @param Payment $paymentInitialization
     * @return PaymentDetail
     * @throws Exception\StandardException
     */
    public function createPayment(Payment $paymentInitialization): PaymentDetail
    {
        //3.2.4
        $data = $this->bankApi->createPayment($paymentInitialization);
        var_dump($data);
        return $this->hydratator->hydratePaymentInitialization($data);
    }

    /**
     * @param string $paymentId
     * @return PISP\PaymentStatus
     */
    public function getPaymentStatus(string $paymentId): PaymentStatus
    {
        //3.2.5 Status založené/iniciované platby (GET /payments/{paymentId}/status)
        $data = $this->bankApi->getPaymentStatus($paymentId);
        return $this->hydratator->hydratePaymentStatus($data);
    }
}
