<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard;

use PavelMaca\OpenBanking\Hydratation\PISPHydratatorInterface;
use PavelMaca\OpenBanking\Standard\Exception\StandardException;
use PavelMaca\OpenBanking\Standard\PISP\Payment;

interface PISPConnector extends CISPConnector
{

    /**
     * @param Payment $paymentInitialization
     * @return array
     * @throws StandardException
     */
    public function createPayment(Payment $paymentInitialization);

    /**
     * @param string $paymentId
     * @return array
     */
    public function getPaymentStatus(string $paymentId);

    public function getPISPHydratator(): PISPHydratatorInterface;
}
