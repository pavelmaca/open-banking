<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Bank\EquaBank;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use PavelMaca\OpenBanking\Auth\AuthenticationException;
use RuntimeException;

/**
 * @see https://developers.equa.cz/store/site/themes/wso2/templates/api/documentation/download.jag?tenant=carbon.super&resourceUrl=/registry/resource/_system/governance/apimgt/applicationdata/provider/admin/TPPPublicRegistration/1.1.11/documentation/files/How%20to%20call%20PSD2%20API%20v5.pdf
 *
 * Class Authenticator
 * @package PavelMaca\OpenBankingEquaBank
 */
class Authentication implements \PavelMaca\OpenBanking\Auth\Authentication
{
    const SCOPE_AISP_ACCOUNTS = 'AISP_ACCOUNTS';
    const SCOPE_AISP_TRANSACTIONS = 'AISP_TRANSACTIONS';
    const SCOPE_AISP_BALANCE = 'AISP_BALANCE';

    const TOKEN_URL = 'https://api.equa.cz/token';
    const AUTHORIZE_URL = 'https://api.equa.cz/authorize';

    /** @var string */
    protected $accessToken;

    /** @var string|array|null */
    protected $accessCertificate = null;


    /**
     * @param string $clientId @see Consumer Key in application setting
     * @param string $redirectUrl @see Callback URL in application setting
     * @param array|null $scopes @see self::SCOPE_* constants
     * @return string
     */
    public function getAuthorizationUrl(string $clientId, string $redirectUrl, ?array $scopes = []): string
    {
        // https://api.equa.cz/authorize?
        //  scope=AISP_ACCOUNTS%20AISP_BALANCE%20AISP_TRANSACTIONS
        //  &response_type=code
        //  &redirect_uri=https://knedlik.neco/callback&client_id=<clientId>

        $scopeString = empty($scopes) ? [] : implode($scopes, ' ');
        $query = http_build_query([
            'response_type' => 'code',
            'scope' => $scopeString,
            'redirect_uri' => $redirectUrl,
            'client_id' => $clientId,
        ]);
        return self::AUTHORIZE_URL . '?' . $query;
    }

    /**
     * @param string $clientId @see Consumer Key in application setting
     * @param string $clientSecret
     * @param string $redirectUrl @see Callback URL in application setting
     * @param string $authCode code returned from succes authorization process in bank form via redirectUri
     * @return array
     * @throws AuthenticationException
     */
    public function getAccessToken(string $clientId, string $clientSecret, string $redirectUrl, string $authCode): array
    {
        try {
            $httpClient = new Client();
            $response = $httpClient->request('GET', self::TOKEN_URL, [
                'auth' => [
                    $clientId,
                    $clientSecret,
                ],
                'query' => [
                    'grant_type' => 'authorization_code',
                    'code' => $authCode,
                    'redirect_uri' => $redirectUrl,

                ]
            ]);

            if ($response->getStatusCode() == 200) {

                /* '{"access_token":"52ae61ce-121c-3ae5-a7ab3d6801d86021","refresh_token":"da256707-4676-3785-a516-
         3f1b05812798","scope":"AISP_ACCOUNTS AISP_BALANCE
         AISP_TRANSACTIONS","token_type":"Bearer","expires_in": 7776000}';*/
                return json_decode($response->getBody()->getContents());
            } else {
                throw new AuthenticationException('Invalid authentication request', $response->getStatusCode());
            }
        } catch (GuzzleException $ex) {
            throw new AuthenticationException($ex->getMessage(), $ex->getCode(), $ex);
        } catch (RuntimeException $ex) {
            throw new AuthenticationException('Error while reading authentication response.', $ex->getCode(), $ex);
        } catch (InvalidArgumentException $ex) {
            throw new AuthenticationException('Error while creating authentication request.', $ex->getCode(), $ex);
        }
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
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
    }
}
