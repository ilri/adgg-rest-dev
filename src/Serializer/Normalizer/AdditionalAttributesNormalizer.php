<?php

namespace App\Serializer\Normalizer;

use App\Entity\TableAttribute;
use ContainerK46XZ1O\getDebug_Security_Voter_Security_Access_AuthenticatedVoterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\{
    AbstractObjectNormalizer,
    CacheableSupportsMethodInterface,
    DenormalizerInterface,
    NormalizerInterface,
    ObjectNormalizer
};

class AdditionalAttributesNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    private const TRAIT = 'App\Entity\Traits\AdditionalAttributesTrait';

    /**
     * @var ObjectNormalizer
     */
    private $normalizer;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AdditionalAttributesNormalizer constructor.
     * @param ObjectNormalizer $normalizer
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ObjectNormalizer $normalizer, EntityManagerInterface $entityManager)
    {
        $this->normalizer = $normalizer;
        $this->em = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $context[AbstractObjectNormalizer::CIRCULAR_REFERENCE_HANDLER] = function ($object, $format, $context) {
            return [$object->getId()];
        };
        $data = $this->normalizer->normalize($object, $format, $context);

        //Checks whether object contains additional attributes
        $additionalAttributes = $data['additionalAttributes'] ?? null;

        //Updates the additional attributes array
        if ($additionalAttributes) {
            $modifiedAttributes = $this->updateAdditionalAttributes($additionalAttributes, 'normalize');
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
            $modifiedAttributes = $this->updateAdditionalAttributes($additionalAttributes, 'denormalize');
            $data['additionalAttributes'] = $modifiedAttributes;
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
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
//        return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
       if ($type = 2)
       {
           return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
       }
       else
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
     * @param array $additionalAttributes
     * @param string $serializationType
     * @return array
     */
    private function updateAdditionalAttributes(array $additionalAttributes, string $serializationType): array
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
     * @param int|string $identifier
     * @return string|null
     */
    private function retrieveAttributeLabel($identifier): ?string
    {
        $attr = $this->em->getRepository(TableAttribute::class)->find($identifier);

        return $attr ? $attr->getAttributeLabel(): null;
    }

    /**
     * Retrieves a CoreTableAttribute object based on its label
     * and returns its Id.
     *
     * @param string $label
     * @return int|null
     */
    private function retrieveAttributeId(string $label): ?int
    {
        $attr = $this->em->getRepository(TableAttribute::class)
            ->findOneBy(['attributeLabel' => trim($label)])
        ;

        return $attr ? $attr->getId() : null;
    }
}
