<?php

// src/Serializer/Normalizer/MasterListNormalizer.php

namespace App\Serializer\Normalizer;

use App\Entity\MasterList;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class MasterListNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof MasterList;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [
            '@id' => '/api/master_lists/'.$object->getId(),
            '@type' => 'MasterList',
            'id' => $object->getId(),
            'value' => $object->getValue(),
            'label' => $object->getLabel(),
            'isActive' => $object->getIsActive(),
            'description' => $object->getDescription(),
            'createdAt' => $object->getCreatedAt()->format(\DateTime::RFC3339),
            'createdBy' => $object->getCreatedBy(),
            'orderBy' => $object->getOrderBy(),
            'listtype' => intval($object->getListType()->getId()),
        ];

        return $data;
    }
}
