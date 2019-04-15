<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Bank\Erste;

use PavelMaca\OpenBanking\Auth\StandardAuthentication;

class Authentication extends StandardAuthentication
{
    public function getAuthHeaders(): array
    {
        $authHeaders = parent::getAuthHeaders();
        unset($authHeaders['API-key']);
        $authHeaders['WEB-API-key'] = $this->apiKey;
        return $authHeaders;
    }
}
