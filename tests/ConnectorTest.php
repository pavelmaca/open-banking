<?php
declare(strict_types=1);

namespace PavelMaca\OpenBanking\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PavelMaca\OpenBanking\Bank\StandardConnector;
use PavelMaca\OpenBanking\Test\Fixtures\Authenticator;
use PavelMaca\OpenBanking\Test\Fixtures\Connector;
use PHPUnit\Framework\TestCase;

class ConnectorTest extends TestCase
{
    public function testGuzzleInicialization()
    {
        $auth = new Authenticator();
        $baseUri = 'http://bank.cz';
        $connector = new StandardConnector($auth, $baseUri, 'v1');

        $httpClient = $connector->getHttpClient();

        $this->assertInstanceOf(Client::class, $httpClient);
    }

    public function testMockHandler()
    {
        $mock = new MockHandler();
        $auth = new Authenticator();
        $baseUri = 'http://bank.cz';
        $connector = new Connector($auth, $baseUri, 'v1', $mock);

        $array = ['foo' => 'bar'];
        $connector->getMockHandler()->append(new Response(200, [], json_encode($array)));

        $this->assertEquals($array, $connector->getAccountList());
    }
}
