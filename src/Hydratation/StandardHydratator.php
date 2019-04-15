<?php
declare(strict_types=1);


namespace PavelMaca\OpenBanking\Hydratation;

use Doctrine\Common\Annotations\AnnotationReader;
use PavelMaca\OpenBanking\Mapping\Property;
use PavelMaca\OpenBanking\Standard\RequestObject;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use function class_exists;

class StandardHydratator
{
    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    public function __construct()
    {
        // this ensure that class is loaded before AnnotationReader can use it
        class_exists(Property::class, true);
        $this->annotationReader = new AnnotationReader();
    }


    /**
     * @param string $dataObjectClass
     * @param array $data
     * @return object
     */
    protected function hydrate(string $dataObjectClass, array $data)
    {
        $reflectionClass = new ReflectionClass($dataObjectClass);
        $properties = $reflectionClass->getProperties();

        $classInstance = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($properties as $property) {
            $value = $this->getPropertyValue($property, $data);
            if ($property->isProtected()) {
                $property->setAccessible(true);
            }
            $property->setValue($classInstance, $value);
        }

        return $classInstance;
    }

    protected function getPropertyValue(ReflectionProperty $property, $data)
    {
        /** @var Property|null $mapping */
        $mapping = $this->annotationReader->getPropertyAnnotation($property, Property::class);

        if ($mapping === null) {
            return null;
        }

        $value = $mapping->parseValue($data);
        if (empty($value)) {
            return null;
        }

        if ($mapping->isResponseObject()) {
            return $this->hydrate($mapping->getType(), $value);
        }

        return $value;
    }


    protected function serialize($object): array
    {
        $reflectionObject = new ReflectionObject($object);
        $properties = $reflectionObject->getProperties();

        $data = [];
        foreach ($properties as $property) {
            if ($property->isProtected()) {
                $property->setAccessible(true);
            }
            $value = $property->getValue($object);

            /** @var Property|null $mapping */
            $mapping = $this->annotationReader->getPropertyAnnotation($property, Property::class);

            if ($mapping === null) {
                continue;
            }

            if ($value instanceof RequestObject) {
                $value = $this->serialize($value);
            }
            $data = $mapping->setValue($data, $value);
        }

        return $data;
    }
}
