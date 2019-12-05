<?php

$auth = new \PavelMaca\OpenBanking\Auth\StandardAuthentication();
$auth->setCertificate(__DIR__ . '/../data/cert.crt', 'secretPassword');
$auth->setAccessToken('timeLimitedToken');

$connector = new \PavelMaca\OpenBanking\Bank\StandardConnector($auth, 'http://banka.cz/', 'v1');
$ais = new \PavelMaca\OpenBanking\Standard\AccountInformation($connector);
try {
    $accountList = $ais->getAccountList();
    var_dump($accountList);
} catch (\PavelMaca\OpenBanking\Standard\Exception\StandardException $ex) {
    var_dump($ex);
}
