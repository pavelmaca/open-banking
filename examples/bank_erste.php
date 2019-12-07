<?php
declare(strict_types=1);

use PavelMaca\OpenBanking\Bank\Erste\Authentication as ErsteAuthentication;
use PavelMaca\OpenBanking\Bank\Erste\ErsteConnector as ErsteConnector;
use PavelMaca\OpenBanking\Standard\AccountInformation as AccountInformation;

include_once __DIR__ . '/../vendor/autoload.php';

$authentication = new ErsteAuthentication('apiKey');
$authentication->setAccessToken('accessToken');
$authentication->setCertificate('cert/file.pem', 'password');

$connector = new ErsteConnector($authentication, ErsteConnector::SANDBOX_BASE_URI, 'v1');

$aispService = new AccountInformation($connector);

try {
    var_dump($aispService->getAccountList());
} catch (\PavelMaca\OpenBanking\Standard\Exception\StandardException $e) {
    var_dump($e);
}
