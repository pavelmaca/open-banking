<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use PavelMaca\OpenBanking\Auth\Authentication;
use PavelMaca\OpenBanking\Standard\Exception\InvalidParametrException;
use PavelMaca\OpenBanking\Standard\Exception\InvalidResponseException;
use PavelMaca\OpenBanking\Standard\Exception\NotFoundException;
use PavelMaca\OpenBanking\Standard\Exception\ResponseError;
use PavelMaca\OpenBanking\Standard\Exception\UnauthorisedException;
use PavelMaca\OpenBanking\Standard\Exception\UnknowRequestErrorException;

/**
 *  Třída pro komunikaci s API zahrnujicí tvorbu HTTP dotazů a zpracování odpovědí
 * @package OpenBanking
 */
abstract class Connector implements Standard\Connector
{
    /** @var Authentication */
    protected $authenticator;

    /** @var Client */
    protected $httpClient;

    protected $baseURI;

    /**
     * Connector constructor.
     * @param Authentication $authenticator
     * @param string $baseURI
     * @throws InvalidArgumentException
     */
    public function __construct(Authentication $authenticator, string $baseURI)
    {
        $this->baseURI = $baseURI;
        $this->authenticator = $authenticator;

        $this->httpClient = new Client(
            [
                RequestOptions::VERIFY => CaBundle::getBundledCaBundlePath(),
                'base_uri' => $this->baseURI,
            ]
        );
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param string $path
     * @param array $queryParams
     * @return array
     * @throws InvalidParametrException
     * @throws NotFoundException
     * @throws InvalidResponseException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    protected function get(string $path, array $queryParams = []): array
    {
        try {
            $response = $this->httpClient->request('GET', $path, [
                RequestOptions::QUERY => $queryParams,
                RequestOptions::HEADERS => array_merge(
                    $this->authenticator->getAuthHeaders(),
                    [
                        'Content-Type' => 'application/json',
                    ]
                ),
                RequestOptions::CERT => $this->authenticator->getCertificate(),
            ]);

            $responseBody = $response->getBody();

            if ($response->getStatusCode() === 200) {
                try {
                    return Json::decode($responseBody, Json::FORCE_ARRAY);
                } catch (JsonException $e) {
                    throw new InvalidResponseException('Invalid JSON response.', $e->getCode(), $e);
                }
            } else {
                throw new InvalidResponseException('Invalid response from server: ' . $responseBody, $response->getStatusCode());
            }
        } catch (ClientException $ex) {
            $this->handleErrorRequest($ex);
        } catch (GuzzleException $ex) {
            throw new InvalidResponseException('Invalid resposnse from server', $ex->getCode(), $ex);
        }

        return [];
    }

    /**
     * @param string $path
     * @param array $queryParams
     * @param array $bodyParametrs
     * @return array
     * @throws InvalidParametrException
     * @throws NotFoundException
     * @throws InvalidResponseException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    protected function post(string $path, array $queryParams, array $bodyParametrs): array
    {
        try {
            $response = $this->httpClient->request('POST', $path, [
                RequestOptions::QUERY => $queryParams,
                RequestOptions::JSON => $bodyParametrs,
                RequestOptions::HEADERS => array_merge(
                    $this->authenticator->getAuthHeaders(),
                    [
                        'Content-Type' => 'application/json',
                    ]
                ),
                RequestOptions::CERT => $this->authenticator->getCertificate(),
            ]);

            $responseBody = $response->getBody();

            if (in_array($response->getStatusCode(), [200, 201])) {
                try {
                    return Json::decode($responseBody, Json::FORCE_ARRAY);
                } catch (JsonException $e) {
                    throw new InvalidResponseException('Invalid JSON response.', $e->getCode(), $e);
                }
            } else {
                throw new InvalidResponseException('Invalid response from server: ' . $responseBody, $response->getStatusCode());
            }
        } catch (ClientException $ex) {
            $this->handleErrorRequest($ex);
        } catch (GuzzleException $ex) {
            throw new InvalidResponseException('Invalid resposnse from server', $ex->getCode(), $ex);
        }
        return [];
    }

    /**
     * @param ClientException $exception
     * @return mixed
     * @throws InvalidParametrException
     * @throws NotFoundException
     * @throws InvalidResponseException
     * @throws UnauthorisedException
     * @throws UnknowRequestErrorException
     */
    protected function handleErrorRequest(ClientException $exception)
    {
        if ($exception->hasResponse()) {
            throw new UnknowRequestErrorException(null, $exception->getCode(), $exception);
        }

        $response = $exception->getResponse();
        $responseBody = $response !== null ? $response->getBody() : null;

        $objErrors = [];
        try {
            $responseData = Json::decode($responseBody, Json::FORCE_ARRAY);
            foreach ($responseData['errors'] as $error) {
                $objErrors[] = new ResponseError(
                    $error['error'],
                    $error['parameters'],
                    $error['scope'],
                    $error['message']
                );
            }
        } catch (JsonException $ex) {
            throw new InvalidResponseException('Invalid JSON response.', $ex->getCode(), $ex);
        }

        $responseStatusCode = $response !== null ? $response->getStatusCode() : null;
        switch ($responseStatusCode) {
            case 400:
                throw new InvalidParametrException(null, $responseStatusCode, $exception, $objErrors);
            case 401:
            case 403:
                throw new UnauthorisedException(null, $responseStatusCode, $exception, $objErrors);
            case 404:
                throw new NotFoundException(null, $responseStatusCode, $exception, $objErrors);
            default:
                throw new UnknowRequestErrorException(null, $exception->getCode(), $exception);
        }
    }
}
