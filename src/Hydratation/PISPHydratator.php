<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\PISP\Payment;
use PavelMaca\OpenBanking\Standard\PISP\PaymentDetail;
use PavelMaca\OpenBanking\Standard\PISP\PaymentStatus;

class PISPHydratator extends CISPHydratator implements PISPHydratatorInterface
{
    public function hydratePaymentInitialization(array $data): PaymentDetail
    {
        /** @var PaymentDetail $paymentDetail */
        $paymentDetail = $this->hydrate(PaymentDetail::class, $data);
        return $paymentDetail;
    }

    public function serializePaymentInitialization(Payment $paymentInitializationRequest): array
    {
        return $this->serialize($paymentInitializationRequest);
    }

    public function hydratePaymentStatus(array $data): PaymentStatus
    {
        /** @var PaymentStatus $paymentStatus */
        $paymentStatus = $this->hydrate(PaymentStatus::class, $data);
        return $paymentStatus;
    }
}
