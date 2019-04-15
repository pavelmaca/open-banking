<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Auth;

class StandardAuthentication implements Authentication
{
    const SCOPE_AISP = 'AISP';
    const SCOPE_PISP = 'PISP';
    const SCOPE_CISP = 'CISP';

    /** @var string|null */
    protected $accessToken = null;

    /** @var string|null */
    protected $apiKey = null;

    /** @var string|array|null */
    protected $accessCertificate = null;


    public function __construct(?string $apiKey = null)
    {
        $this->apiKey = $apiKey;
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function setCertificate(string $certPath, ?string $certPassword)
    {
        $this->accessCertificate = empty($certPassword) ? $certPath : [$certPath, $certPassword];
    }

    public function getCertificate()
    {
        $this->accessCertificate;
    }

    public function getAuthHeaders(): array
    {
        $authHeaders = [];
        $authHeaders['Authorization'] = 'Bearer ' . $this->accessToken;
        if ($this->apiKey !== null) {
            $authHeaders['API-key'] = $this->apiKey;
        }
        return $authHeaders;
    }
}
