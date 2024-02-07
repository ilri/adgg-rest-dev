<?php

// src/Serializer/Normalizer/MasterListNormalizer.php

namespace App\Serializer\Normalizer;

use App\Entity\VActiveCoreMasterLists;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class MasterListNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof VActiveCoreMasterLists;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            '@id' => '/api/v_master_lists/'.$object->getId(),
            '@type' => 'VActiveCoreMasterLists',
            'value' => $object->getValue(),
            'label' => $object->getLabel(),
            'isActive' => $object->getIsActive(),
            'description' => $object->getDescription(),
            'createdAt' => $object->getCreatedAt()->format(\DateTime::RFC3339),
            'createdBy' => $object->getCreatedBy(),
            'orderBy' => $object->getOrderBy(),
            'listtypeid' => $object->getListTypeId(),
        ];

        return $data;
    }
}
