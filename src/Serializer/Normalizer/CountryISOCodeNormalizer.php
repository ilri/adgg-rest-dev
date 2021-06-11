<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\{
    CacheableSupportsMethodInterface,
    DenormalizerInterface,
    NormalizerInterface,
    ObjectNormalizer};

class CountryISOCodeNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    private const TRAIT = 'App\Entity\Traits\CountryTrait';

    /**
     * @var ObjectNormalizer
     */
    private $normalizer;

    /**
     * CountryISOCodeNormalizer constructor.
     * @param ObjectNormalizer $normalizer
     */
    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        // Here: add, edit, or delete some data

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null): bool
    {
        //return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
        return false;
    }

    /**
     * @return bool
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        //return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
        return false;
    }
}
