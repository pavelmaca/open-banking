<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test\Fixtures;

use PavelMaca\OpenBanking\Auth\Authentication as AuthenticationI;

class Authenticator implements AuthenticationI
{
    public function getAuthHeaders(): array
    {
        return ['X-Foo' => 'bar'];
    }

    /**
     * @inheritDoc
     */
    public function getCertificate()
    {
        return null;
    }
}
