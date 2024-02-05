<?php

namespace App\Serializer\Normalizer;

use App\Entity\Animal;
use App\Entity\AnimalEvent;
use App\Entity\Farm;
use App\Entity\Herd;
use App\Entity\MobForm;
use App\Entity\MobFormField;
use App\Entity\MobFormFieldMultiple;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class IncludeNullsObjectNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof MobFormField
            || $data instanceof MobFormFieldMultiple
            || $data instanceof Farm
            || $data instanceof Herd
            || $data instanceof Animal
            || $data instanceof MobForm
            || $data instanceof AnimalEvent;
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

        // Include trait properties (createdBy, createdAt) if the trait is used
        $traitProperties = $this->getTraitProperties($object);
        foreach ($traitProperties as $traitProperty) {
            // Exclude created_at from serialization
            if ($traitProperty !== 'createdAt') {
                $data[$traitProperty] = $object->$traitProperty;
            }
        }

        return $data;
    }

    private function getTraitProperties($object)
    {
        $traitProperties = [];
        $traits = class_uses($object);

        if (in_array('App\Entity\Traits\CreatedTrait', $traits)) {
            $reflection = new \ReflectionClass($object);
            $trait = $reflection->getTraitAliases()['App\Entity\Traits\CreatedTrait'];

            foreach ($trait as $alias => $original) {
                $traitProperties[] = $original;
            }
        }

        return $traitProperties;
    }
}
