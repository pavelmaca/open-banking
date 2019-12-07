<?php
declare(strict_types=1);

namespace PavelMaca\OpenBanking\Standard\Exception;

use PavelMaca\OpenBanking\OpenBankingException;
use Throwable;

class StandardException extends OpenBankingException
{
    /** @var ResponseError[] */
    protected $responseErrors = [];

    public function __construct($message = "", $code = 0, Throwable $previous = null, array $responseErrors = [])
    {
        parent::__construct($message, $code, $previous);
        $this->responseErrors = $responseErrors;
    }

    /**
     * @return ResponseError[]
     */
    public function getResponseErrors(): array
    {
        return $this->responseErrors;
    }
}
