<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test\Fixtures;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PavelMaca\OpenBanking\Auth\Authentication;
use PavelMaca\OpenBanking\Bank\StandardConnector;

class Connector extends StandardConnector
{

    /** @var MockHandler */
    protected $mockHandler;

    public function __construct(Authentication $authenticator, string $baseURI, string $apiVersion, MockHandler $mockHandler)
    {
        $this->mockHandler = $mockHandler;
        parent::__construct($authenticator, $baseURI, $apiVersion);
    }

    protected function httpClientFactory(): Client
    {
        $handler = HandlerStack::create($this->mockHandler);
        return new Client(
            [
                'handler' => $handler,
            ]
        );
    }

    public function getMockHandler(): MockHandler
    {
        return $this->mockHandler;
    }
}
