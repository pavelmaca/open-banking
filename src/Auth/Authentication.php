<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Auth;

interface Authentication
{
    public function getAuthHeaders(): array;

    /** @return null|string|array */
    public function getCertificate();
}
