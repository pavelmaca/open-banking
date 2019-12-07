<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test\Standard;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Nette\Utils\Json;
use PavelMaca\OpenBanking\Standard\BalanceCheck;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest;
use PavelMaca\OpenBanking\Standard\CISP\BalanceCheckStatus;
use PavelMaca\OpenBanking\Standard\CISP\Parts\Card;
use PavelMaca\OpenBanking\Standard\CISP\Parts\Merchant;
use PavelMaca\OpenBanking\Standard\CISP\Parts\TransactionDetail;
use PavelMaca\OpenBanking\Standard\Exception\InvalidParametrException;
use PavelMaca\OpenBanking\Test\Fixtures\Authenticator;
use PavelMaca\OpenBanking\Test\Fixtures\Connector;
use PHPUnit\Framework\TestCase;

class BalanceCheckTest extends TestCase
{
    /** @var Connector */
    protected $connector;

    protected function setUp(): void
    {
        parent::setUp();
        $mock = new MockHandler();
        $auth = new Authenticator();
        $baseUri = 'http://bank.cz';
        $this->connector = new Connector($auth, $baseUri, 'v1', $mock);
    }

    public function testGetBalanceCheck()
    {
        $cisp = new BalanceCheck($this->connector);

        $this->connector->getMockHandler()->append(new Response(200, [], file_get_contents(__DIR__ . '/../data/cisp/balanceCheck200.json')));

        $transactionDetail = new TransactionDetail('CZK', 100);
        $balanceCheckRequest = new BalanceCheckRequest('', '', $transactionDetail);
        $balanceCheck = $cisp->getBalanceCheck($balanceCheckRequest);

        $this->assertInstanceOf(BalanceCheckStatus::class, $balanceCheck);

        $this->assertSame(98765, $balanceCheck->getId());
        $this->assertSame(123456, $balanceCheck->getExchangeIdentification());
        $this->assertSame('APPR', $balanceCheck->getResponse());
        $this->assertTrue($balanceCheck->isApproved());
    }

    public function testGetBalanceCheckRequest()
    {
        $transactionDetail = new TransactionDetail('CZK', 10050.15);
        $balanceCheckRequest = new BalanceCheckRequest('123456', 'CZ0708000000001019382023', $transactionDetail);
        $balanceCheckRequest->setDebtorAccountCurrency('CZK');

        $card = new Card('1234***********6789');
        $card->setCardholderName('Jan Novák');
        $balanceCheckRequest->setCard($card);

        $merchant = new Merchant("471 16 129", "NEOLUXOR", "Neoluxor s.r.o.", "5192");
        $merchant->setAddress("Hlavní 5, Praha 1");
        $merchant->setCountryCode('CZ');
        $balanceCheckRequest->setMerchant($merchant);

        $balanceCheckRequest->setAuthenticationMethod('NPIN');

        $data = $this->connector->getCISPHydratator()->serializeBalanceCheckRequest($balanceCheckRequest);

        $exampleData = Json::decode(file_get_contents(__DIR__ . '/../data/cisp/balanceCheck_request.json'), Json::FORCE_ARRAY);
        $this->assertEquals($exampleData, $data);
    }

    public function testGetBalanceCheckInvalidRequest()
    {
        $cisp = new BalanceCheck($this->connector);

        $this->connector->getMockHandler()->append(new Response(400, [], file_get_contents(__DIR__ . '/../data/cisp/balanceCheck_400.json')));

        $this->expectException(InvalidParametrException::class);
        try {
            $transactionDetail = new TransactionDetail('CZK', 100);
            $balanceCheckRequest = new BalanceCheckRequest('', '', $transactionDetail);
            $accountBalance = $cisp->getBalanceCheck($balanceCheckRequest);
        } catch (InvalidParametrException $ex) {
            $this->assertCount(2, $ex->getResponseErrors());

            $error = $ex->getResponseErrors()[0];
            $this->assertSame('FIELD_MISSING', $error->getError());
            $this->assertSame('merchant.identification', $error->getScope());
            throw  $ex;
        }
    }
}
