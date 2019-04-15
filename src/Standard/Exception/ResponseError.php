<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Standard\Exception;

class ResponseError
{

    /** @var string */
    protected $error;

    /** @var array|null */
    protected $parameters;

    /** @var string|null */
    protected $scope;

    /** @var string|null */
    protected $message;

    /**
     * ResponseError constructor.
     * @param string $error
     * @param array|null $parameters
     * @param string|null $scope
     * @param string|null $message
     */
    public function __construct(string $error, ?array $parameters = null, ?string $scope = null, ?string $message = null)
    {
        $this->error = $error;
        $this->parameters = $parameters;
        $this->scope = $scope;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return array|null
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @return string|null
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
