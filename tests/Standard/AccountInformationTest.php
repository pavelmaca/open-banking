<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Test\Standard;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PavelMaca\OpenBanking\Standard\AccountInformation;
use PavelMaca\OpenBanking\Standard\AISP\Account;
use PavelMaca\OpenBanking\Standard\AISP\AccountBalance;
use PavelMaca\OpenBanking\Standard\AISP\AccountList;
use PavelMaca\OpenBanking\Standard\AISP\Parts\CounterValueAmount;
use PavelMaca\OpenBanking\Standard\AISP\Parts\PartyIdentification;
use PavelMaca\OpenBanking\Standard\AISP\Parts\RemittanceInformation;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAgent;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAgents;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionAmountDetails;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionCurrencyExchange;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionDetails;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionParties;
use PavelMaca\OpenBanking\Standard\AISP\Parts\TransactionReferences;
use PavelMaca\OpenBanking\Standard\AISP\Transaction;
use PavelMaca\OpenBanking\Standard\AISP\TransactionList;
use PavelMaca\OpenBanking\Standard\Exception\InvalidParametrException;
use PavelMaca\OpenBanking\Standard\Exception\NotFoundException;
use PavelMaca\OpenBanking\Test\Fixtures\Authenticator;
use PavelMaca\OpenBanking\Test\Fixtures\Connector;
use PHPUnit\Framework\TestCase;

class AccountInformationTest extends TestCase
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

    public function testGetAccountList()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(200, [], file_get_contents(__DIR__ . '/../data/aisp/accounts.json')));
        $accountList = $aisp->getAccountList();
        $this->assertInstanceOf(AccountList::class, $accountList);

        // Test paging
        $this->assertTrue($accountList->hasPaging());
        $this->assertSame(0, $accountList->getPageNumber());
        $this->assertSame(2, $accountList->getPageCount());
        $this->assertSame(100, $accountList->getPageSize());
        $this->assertSame(null, $accountList->getTotalCount());
        $this->assertSame(1, $accountList->getNextPage());

        $accounts = $accountList->getAccounts();
        $this->assertCount(2, $accounts);
        $this->containsOnlyInstancesOf(Account::class)->evaluate($accounts);

        $firstAccount = reset($accounts);
        $this->assertSame('Muj hlavni osobni ucet', $firstAccount->getAccountName());
        $this->assertSame('1019382023', $firstAccount->getAccountNumber());
        $this->assertSame('CZK', $firstAccount->getCurrency());
        $this->assertSame('CZ0708000000001019382023', $firstAccount->getIban());
        $this->assertSame('D2C8C1DCC51A3738538A40A4863CA288E0225E52', $firstAccount->getId());
        $this->assertSame('Osobní účet ČS', $firstAccount->getProductName());
        $this->assertSame('0800', $firstAccount->getServicerBankCode());
        $this->assertSame('GIBACZPX', $firstAccount->getServicerBic());
        $this->assertSame('CZ', $firstAccount->getServicerCountryCode());
    }

    public function testGetAccountListPageInvalidRequest()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(400, [], file_get_contents(__DIR__ . '/../data/aisp/accounts_400.json')));

        $this->expectException(InvalidParametrException::class);
        try {
            $aisp->getAccountList();
        } catch (InvalidParametrException $ex) {
            $this->assertCount(2, $ex->getResponseErrors());

            $secondError = $ex->getResponseErrors()[1];
            $this->assertSame('PARAMETER_INVALID', $secondError->getError());
            $this->assertSame('sort', $secondError->getScope());
            throw  $ex;
        }
    }

    public function testGetAccountBalance()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(200, [], file_get_contents(__DIR__ . '/../data/aisp/accounts_balance.json')));
        $accountBalance = $aisp->getAccountBalance('');
        $this->assertInstanceOf(AccountBalance::class, $accountBalance);

        $this->assertSame('PRCD', $accountBalance->getType());
        $this->assertEquals(4520.15, $accountBalance->getBalanceAmount());
        $this->assertSame('CZK', $accountBalance->getBalanceCurrency());
        $this->assertEquals(10000, $accountBalance->getCreditAmount());
        $this->assertSame('CZK', $accountBalance->getCreditCurrency());
        $this->assertSame('DBIT', $accountBalance->getCreditDebitIndicator());
        $this->assertSame(true, $accountBalance->getCreditIncluded());
    }

    public function testGetAccountBalanceNotFound()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(404, [], file_get_contents(__DIR__ . '/../data/aisp/accounts_balance_404.json')));

        $this->expectException(NotFoundException::class);
        try {
            $accountBalance = $aisp->getAccountBalance('invalidId');
        } catch (NotFoundException $ex) {
            $this->assertCount(1, $ex->getResponseErrors());

            $error = $ex->getResponseErrors()[0];
            $this->assertSame('ID_NOT_FOUND', $error->getError());
            throw  $ex;
        }
    }

    public function testGetAccountBalanceBadRequest()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(400, [], file_get_contents(__DIR__ . '/../data/aisp/accounts_balance_400.json')));

        $this->expectException(InvalidParametrException::class);
        try {
            $accountBalance = $aisp->getAccountBalance('');
        } catch (InvalidParametrException $ex) {
            $this->assertCount(1, $ex->getResponseErrors());

            $error = $ex->getResponseErrors()[0];
            $this->assertSame('AM03', $error->getError());
            $this->assertSame('currency', $error->getScope());
            throw  $ex;
        }
    }

    public function testGetAccountTransactions()
    {
        $aisp = new AccountInformation($this->connector);

        $this->connector->getMockHandler()->append(new Response(200, [], file_get_contents(__DIR__ . '/../data/aisp/transactions.json')));
        $transactionList = $aisp->getAccountTransactions('');
        $this->assertInstanceOf(TransactionList::class, $transactionList);

        // Test paging
        $this->assertTrue($transactionList->hasPaging());
        $this->assertSame(0, $transactionList->getPageNumber());
        $this->assertSame(2, $transactionList->getPageCount());
        $this->assertSame(100, $transactionList->getPageSize());
        $this->assertSame(null, $transactionList->getTotalCount());
        $this->assertSame(1, $transactionList->getNextPage());

        $transactions = $transactionList->getTransactions();
        $this->assertCount(7, $transactions);
        $this->containsOnlyInstancesOf(Transaction::class)->evaluate($transactions);

        // Test first transaction
        $transactionOne = $transactions[0];
        $this->assertSame('RB-4567813', $transactionOne->getId());
        $this->assertEquals(10000, $transactionOne->getAmount());
        $this->assertSame('CZK', $transactionOne->getCurrency());
        $this->assertSame('BOOK', $transactionOne->getStatus());
        $this->assertSame('DBIT', $transactionOne->getCreditDebitIndicator());
        $this->assertSame('2017-01-31T00:00:00.000+01', $transactionOne->getBookingDate());
        $this->assertSame('2017-01-31T00:00:00.000+01', $transactionOne->getValueDate());
        $this->assertSame('00001000010', $transactionOne->getBankTransactionCode());
        $this->assertSame('CBA', $transactionOne->getBankTransactionCodeIssuer());

        $this->assertInstanceOf(TransactionDetails::class, $transactionOne->getTransactionDetail());
        $this->assertEquals(10000, $transactionOne->getTransactionDetail()->getAmountDetails()->getInstructedAmount());
        $this->assertSame('CZK', $transactionOne->getTransactionDetail()->getAmountDetails()->getInstructedAmountCurrency());

        $transactionParties = $transactionOne->getTransactionDetail()->getRelatedParties();
        $this->assertInstanceOf(TransactionParties::class, $transactionParties);
        $this->assertInstanceOf(PartyIdentification::class, $transactionParties->getDebtor());
        $this->assertSame('Novák Jan', $transactionParties->getDebtor()->getName());

        $this->assertSame('CZ0827000000002108589434', $transactionParties->getCreditorAccountIban());

        $relatedAgents = $transactionOne->getTransactionDetail()->getRelatedAgents();
        $this->assertInstanceOf(TransactionAgents::class, $relatedAgents);
        $this->assertInstanceOf(TransactionAgent::class, $relatedAgents->getCreditorAgent());
        $this->assertSame('BACXCZPP', $relatedAgents->getCreditorAgent()->getBic());
        $this->assertSame('2700', $relatedAgents->getCreditorAgent()->getMemberIdentification());

        $remittanceInfo = $transactionOne->getTransactionDetail()->getRemittanceInformation();
        $this->assertInstanceOf(RemittanceInformation::class, $transactionOne->getTransactionDetail()->getRemittanceInformation());

        $this->assertSame('VS:123456","KS:456789","SS:879213546', $remittanceInfo->getCreditorReferenceInformation());
        $this->assertSame('Domácí platba - S24/IB,záloha plyn Bohemia Energy', $transactionOne->getTransactionDetail()->getAdditionalTransactionInformation());


        // Test additional transactions data
        $transactions[1];
        $this->assertInstanceOf(TransactionDetails::class, $transactions[1]->getTransactionDetail());
        $this->assertInstanceOf(TransactionReferences::class, $transactions[1]->getTransactionDetail()->getReferences());
        $this->assertSame('xxxxxxxxxxxx1248', $transactions[1]->getTransactionDetail()->getReferences()->getChequeNumber());

        $this->assertInstanceOf(TransactionAmountDetails::class, $transactions[1]->getTransactionDetail()->getAmountDetails());
        $this->assertInstanceOf(CounterValueAmount::class, $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount());
        $this->assertEquals(105.25, $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getAmount());
        $this->assertSame('CZK', $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getCurrency());

        $this->assertInstanceOf(TransactionCurrencyExchange::class, $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getCurrencyExchange());
        $this->assertEquals(10.525, $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getCurrencyExchange()->getExchangeRate());
        $this->assertSame('CZK', $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getCurrencyExchange()->getSourceCurrency());
        $this->assertSame('GBP', $transactions[1]->getTransactionDetail()->getAmountDetails()->getCounterValueAmount()->getCurrencyExchange()->getTargetCurrency());
    }
}
