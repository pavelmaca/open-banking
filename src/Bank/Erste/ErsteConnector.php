<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Bank\Erste;

use Nette\NotImplementedException;
use PavelMaca\OpenBanking\Auth\Authentication;
use PavelMaca\OpenBanking\Bank\StandardConnector;

class ErsteConnector extends StandardConnector
{
    const SANDBOX_BASE_URI = 'https://webapi.developers.erstegroup.com/api/csas/public/sandbox/';
    const PRODUCTION_BASE_URI = 'https://www.csas.cz/webapi/api/';

    public function __construct(Authentication $authenticator, string $baseURI = self::PRODUCTION_BASE_URI, string $apiVersion = 'v1')
    {
        parent::__construct($authenticator, $baseURI, $apiVersion);
    }

    /**
     * @param string $paymentId
     * @throws NotImplementedException
     */
    public function getPaymentStatus(string $paymentId)
    {
        throw new NotImplementedException();
    }
}
