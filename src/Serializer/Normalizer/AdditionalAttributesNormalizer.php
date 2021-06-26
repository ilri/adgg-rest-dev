<?php

namespace App\Serializer\Normalizer;

use App\Entity\TableAttribute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AdditionalAttributesNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface, DenormalizerInterface
{
    private const TRAIT = 'App\Entity\Traits\AdditionalAttributesTrait';

    private $normalizer;
    private $attributeRepository;

    public function __construct(ObjectNormalizer $normalizer, EntityManagerInterface $entityManager)
    {
        $this->normalizer = $normalizer;
        $this->attributeRepository = $entityManager->getRepository(TableAttribute::class);
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        //Checks whether object contains additional attributes
        $additionalAttributes = $data['additionalAttributes'] ?? null;

        //Updates the additional attributes array
        if ($additionalAttributes){
            $modifiedAttributes = $this->updateAdditionalAttributesArray($additionalAttributes, 'normalize');
            $data['additionalAttributes'] = $modifiedAttributes;
        }
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        //Checks whether object contains additional attributes
        $additionalAttributes = $data['additionalAttributes'] ?? null;

        //Updates the additional attributes array
        if ($additionalAttributes){
            $modifiedAttributes = $this->updateAdditionalAttributesArray($additionalAttributes, 'denormalize');
            $data['additionalAttributes'] = $modifiedAttributes;
        }
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
    }

    /**
     * @return bool
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    /**
     * Iterates over the additional attributes array to retrieve
     * and replace IDs with labels (during normalization)
     * or labels with IDs (during de-normalization).
     *
     * @param $additionalAttributes
     * @param $serializationType
     * @return array
     */
    public function updateAdditionalAttributesArray($additionalAttributes, $serializationType): array
    {
        //Initialized to replace original additional attribute array
        $modifiedAdditionalAttributes = [];

        foreach ($additionalAttributes as $key => $value) {
            //Omits any null values and empty arrays
            if (!empty($value) && $value !== ['']) {
                //Checks whether to retrieve the attribute label or ID
                $serializationType == 'normalize'
                    ? $updated_key = $this->retrieveAttributeLabel($key)
                    : $updated_key = $this->retrieveAttributeId($key);
                if ($updated_key) {
                    $modifiedAdditionalAttributes[$updated_key] = $value;
                }
            }
        }

        return $modifiedAdditionalAttributes;
    }

    /**
     * Retrieves a CoreTableAttribute object based on its ID
     * and returns the attributeLabel property value.
     *
     * @param $id
     * @return string|null
     */
    private function retrieveAttributeLabel($identifier): ?string
    {
        $attr = $this->attributeRepository->find($identifier);

        return $attr ? $attr->getAttributeLabel(): null;
    }

    /**
     * Retrieves a CoreTableAttribute object based on its label
     * and returns its Id.
     *
     * @param $label
     * @return int|null
     */
    private function retrieveAttributeId($label): ?int
    {
        $attr = $this->attributeRepository->findOneBy(['attributeLabel' => trim($label)]);

        return $attr ? $attr->getId() : null;
    }
}
