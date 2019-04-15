<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use PavelMaca\OpenBanking\Standard\PISP\Payment;
use PavelMaca\OpenBanking\Standard\PISP\PaymentDetail;
use PavelMaca\OpenBanking\Standard\PISP\PaymentStatus;

interface PISPHydratatorInterface extends CISPHydratatorInterface
{
    public function hydratePaymentInicialization(array $data): PaymentDetail;

    public function serializePaymentInicialization(Payment $paymentInicializationRequest): array;

    public function hydratePaymentStatus(array $data): PaymentStatus;
}
