<?php
declare(strict_types=1);


$authenticator = new \PavelMaca\OpenBanking\Bank\EquaBank\Authentication();
$authenticator->setAccessToken('demoAccessToken');

$connector = new \PavelMaca\OpenBanking\Bank\EquaBank\EquaBankConnector($authenticator, 'https://api.equa.cz/sandbox/');
$connector->setAISPGetBalance('2.0.4');
$connector->setAISPGetAccountsVersion('2.0.5');
$connector->setAISPGetTransactionsVersion('2.0.4');
$connector->setCISPVersion('2.0.4');
$connector->setPaymentServicesVersion('2.0.4');


$accountInfo = new \PavelMaca\OpenBanking\Standard\AccountInformation($connector);
try {
    var_dump($accountInfo->getAccountList());
} catch (\PavelMaca\OpenBanking\Standard\Exception\StandardException $e) {
    var_dump($e);
}