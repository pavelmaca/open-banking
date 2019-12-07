<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test\Standard;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Nette\Utils\Json;
use PavelMaca\OpenBanking\Standard\Exception\InvalidParametrException;
use PavelMaca\OpenBanking\Standard\Exception\NotFoundException;
use PavelMaca\OpenBanking\Standard\PaymentInitialization;
use PavelMaca\OpenBanking\Standard\PISP\DomesticPaymentRequest;
use PavelMaca\OpenBanking\Standard\PISP\Parts\PaymentTypeInformation;
use PavelMaca\OpenBanking\Standard\PISP\Parts\RemittanceInformation;
use PavelMaca\OpenBanking\Standard\PISP\PaymentStatus;
use PavelMaca\OpenBanking\Test\Fixtures\Authenticator;
use PavelMaca\OpenBanking\Test\Fixtures\Connector;
use PavelMaca\OpenBanking\Test\Helper;
use PHPUnit\Framework\TestCase;

class PaymentInitializationTest extends TestCase
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

    public function testDomesticPaymentInitialization()
    {
        $paymentRequest = new DomesticPaymentRequest('NejakeID41785962314574', 1245.44, 'CZK', 'CZ6330300000000000000123', 'CZ7508000000002108589434');

        $paymentTypeInformation = new PaymentTypeInformation();
        $paymentTypeInformation->setInstructionPriority('NORM');
        $paymentRequest->setPaymentTypeInformation($paymentTypeInformation);

        $paymentRequest->setRequestedExecutionDate('2017-01-31');

        $paymentRequest->setDebtorAccountCurrency('CZK');

        $remittanceInformation = new RemittanceInformation();
        $remittanceInformation->setUnstructured('/VS/7418529630/SS/1234567890');
        $paymentRequest->setRemittanceInformation($remittanceInformation);

        $data = $this->connector->getPISPHydratator()->serializePaymentInitialization($paymentRequest);

        $exampleData = Json::decode(file_get_contents(__DIR__ . '/../data/pisp/payment_domestic_create_request.json'), Json::FORCE_ARRAY);

        $this->assertEquals($exampleData, Helper::filterArrayRecursive($data));
    }

    public function testPaymentInitializationInvalidArgument()
    {
        $pisp = new PaymentInitialization($this->connector);

        $this->connector->getMockHandler()->append(new Response(400, [], file_get_contents(__DIR__ . '/../data/pisp/payment_create_400.json')));

        $this->expectException(InvalidParametrException::class);
        try {
            $paymentRequest = new DomesticPaymentRequest('', 1, '', '', '');
            $accountBalance = $pisp->createPayment($paymentRequest);
        } catch (InvalidParametrException $ex) {
            $this->assertCount(3, $ex->getResponseErrors());

            $error = $ex->getResponseErrors()[0];
            $this->assertSame('AC02', $error->getError());
            throw  $ex;
        }
    }

    public function testPaymentStatus()
    {
        $pisp = new PaymentInitialization($this->connector);

        $this->connector->getMockHandler()->append(new Response(200, [], file_get_contents(__DIR__ . '/../data/pisp/payment_status_200.json')));
        $paymentStatus = $pisp->getPaymentStatus('paymentId');

        $this->assertInstanceOf(PaymentStatus::class, $paymentStatus);
        $this->assertSame(PaymentStatus::STATUS_ACTC, $paymentStatus->getInstructionStatus());
    }

    public function testPaymentStatusNotFound()
    {
        $pisp = new PaymentInitialization($this->connector);

        $this->connector->getMockHandler()->append(new Response(404, [], file_get_contents(__DIR__ . '/../data/pisp/payment_status_404.json')));

        $this->expectException(NotFoundException::class);
        try {
            $pisp->getPaymentStatus('');
        } catch (NotFoundException $ex) {
            $this->assertCount(1, $ex->getResponseErrors());

            $error = $ex->getResponseErrors()[0];
            $this->assertSame('TRANSACTION_MISSING', $error->getError());
            throw  $ex;
        }
    }
}
