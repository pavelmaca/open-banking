<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Mapping;

use PavelMaca\OpenBanking\Hydratation\Helper;
use PavelMaca\OpenBanking\Standard\ResponseObject;
use ReflectionClass;
use ReflectionException;

/**
 * @package OpenBanking
 * @Annotation
 * @Target({"PROPERTY"})
 * @Attributes({
 *   @Attribute("path", type = "string", required = true),
 *   @Attribute("type", type = "string", required = false),
 * })
 */
class Property
{

    /**
     * @var string[]
     */
    protected $keyPath;

    /**
     * @var string
     */
    protected $type;

    public function __construct(array $values)
    {
        $this->keyPath = explode('.', $values['path']);
        $this->type = isset($values['type']) ? $values['type'] : 'string';
    }

    public function isResponseObject(): bool
    {
        if (!class_exists($this->type, true)) {
            return false;
        }
        try {
            $reflection = new ReflectionClass($this->type);
            return $reflection->implementsInterface(ResponseObject::class);
        } catch (ReflectionException $ex) {
            return false;
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function parseValue(array $data)
    {
        return Helper::readValueFromArrayByPath($this->keyPath, $data);
    }

    /**
     * Use path annotation to map given value inside given array, creating sructure of nasted arrays in prcess
     * @param array $data
     * @param mixed $value
     * @return array
     */
    public function setValue(array $data, $value): array
    {
        return Helper::setValueIntoArrayByPath($this->keyPath, $value, $data);
    }
}
