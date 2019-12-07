# Czech Open-Banking REST API

PHP library based on [Czech Open-Banking API standard](https://czech-ba.cz/cesky-standard-pro-open-banking).

**Supported services**
* Account information
* Balance check
* Payment initialization (partial)

## Extensibility
The goal is to support as many banks as possible using only one interface for a communication.
Library already includes a special Authenticators and Connectors for some REST APIs.

### Authentication
Requiring and handling authentication token is out of scope for this library.  
Using `\PavelMaca\OpenBanking\Auth\Authentication` interface you can use own implementation for access token handling and storage.
  
Some implementations require some different authentication parametrs or additional headers.
For this case, you can expand or implement own Authenticator using `\PavelMaca\OpenBanking\Auth\Authentication` or `\PavelMaca\OpenBanking\Auth\StandardAuthentication`.

Example:
```php
class BankB implements \PavelMaca\OpenBanking\Auth\Authentication
{

    public function getAuthHeaders(): array
    {
        return [
            'X-Special-Header' => 'foo',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];
    }

    protected function getAccessToken(){
        // Get access token via OAUth 2.0
    }

    public function getCertificate()
    {
        // Custom certificate handling
    }
}
```

### Handling HTTP connection
Using interface Conncetor, you can create own HTTP handler, for executing HTTP requests.
Library contains StandardConnector with data hydratation into objective data layer.


## Usage
```php
$auth = new \PavelMaca\OpenBanking\Auth\StandardAuthentication();
$auth->setCertificate(__DIR__ . '/../data/cert.crt', 'secretPassword');
$auth->setAccessToken('timeLimitedToken');

$connector = new \PavelMaca\OpenBanking\Bank\StandardConnector($auth, 'http://banka.cz/', 'v1'); 


try {
    $ais = new \PavelMaca\OpenBanking\Standard\AccountInformation($connector);
    $accountList = $ais->getAccountList();
    var_dump($accountList);
    
    $cisp = new \PavelMaca\OpenBanking\Standard\BalanceCheck($connector);
    $transactionDetail = new \PavelMaca\OpenBanking\Standard\CISP\Parts\TransactionDetail('CZK', 100);
    $balanceCheckRequest = new \PavelMaca\OpenBanking\Standard\CISP\BalanceCheckRequest('id', 'CZ010046464', $transactionDetail);
    $cisp->getBalanceCheck($balanceCheckRequest);

    $pisp = new \PavelMaca\OpenBanking\Standard\PaymentInitialization($connector);
    $paymentRequest = new \PavelMaca\OpenBanking\Standard\PISP\DomesticPaymentRequest('id', 100, 'CZK', 'CZ0123', 'CZ0456');
    $accountBalance = $pisp->createPayment($paymentRequest);
} catch (\PavelMaca\OpenBanking\Standard\Exception\StandardException $ex) {
    var_dump($ex);
}
```

## Supported banks
Library is aimed to copy Czech standard in version 2.0. Depending exactly on specific implementation, library should handle all banks following Czech Open-Banking standard.

**Tested**
* [Česká spořitelna a.s.](https://developers.erstegroup.com/docs/apis/bank.csas)
* [EquaBank](https://www.equabank.cz/pece-a-podpora/otevrene-bankovnictvi)
