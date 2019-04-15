<?php
declare(strict_types=1);

namespace PavelMaca\OpenBanking\Standard\CISP;

use PavelMaca\OpenBanking\Standard\ResponseObject;

class BalanceCheckStatus implements ResponseObject
{
    const APPROVED = 'APPR';
    const DECLINED = 'DECL';

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="responseIdentification")
     * @var int
     */
    protected $id;

    /**
     * @PavelMaca\OpenBanking\Mapping\Property(path="exchangeIdentification")
     * @var int
     */
    protected $exchangeIdentification;

    /**
     * APPR Dostatek prostředků na účtu
     * DECL Nedostatek prostředků na účtu
     * @PavelMaca\OpenBanking\Mapping\Property(path="response")
     * @var string
     */
    protected $response;

    public function isApproved(): bool
    {
        return $this->response === self::APPROVED;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getExchangeIdentification(): int
    {
        return $this->exchangeIdentification;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }
}
