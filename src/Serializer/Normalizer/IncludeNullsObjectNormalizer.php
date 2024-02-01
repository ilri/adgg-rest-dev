<?php

namespace App\Serializer\Normalizer;

use App\Entity\MobFormField;
use App\Entity\MobFormFieldMultiple;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class IncludeNullsObjectNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof MobFormField || $data instanceof MobFormFieldMultiple;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        $data = [];

        // Get all properties of the entity model
        $reflectionClass = new \ReflectionClass($object);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($object);
            $propertyName = $property->getName();

            // Set null if value is not set
            $data[$propertyName] = $value ?? null;
        }

        return $data;
    }
}
