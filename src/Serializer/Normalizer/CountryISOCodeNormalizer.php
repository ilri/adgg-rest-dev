<?php

namespace App\Serializer\Normalizer;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\{
    AbstractObjectNormalizer,
    CacheableSupportsMethodInterface,
    DenormalizerInterface,
    NormalizerInterface,
    ObjectNormalizer
};

class CountryISOCodeNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    private const TRAIT = 'App\Entity\Traits\CountryTrait';

    /**
     * @var ObjectNormalizer
     */
    private $normalizer;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CountryISOCodeNormalizer constructor.
     * @param ObjectNormalizer $normalizer
     * @param EntityManagerInterface $em
     */
    public function __construct(ObjectNormalizer $normalizer, EntityManagerInterface $em)
    {
        $this->normalizer = $normalizer;
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $context[AbstractObjectNormalizer::CIRCULAR_REFERENCE_HANDLER] = function ($object, $format, $context) {
            return [$object->getId()];
        };
        $data = $this->normalizer->normalize($object, $format, $context);

        if (isset($data['countryId'])) {
            $country = $this->em->getRepository(Country::class)
                ->findOneBy(['id' => $data['countryId']])
            ;
            $data['countryISOCode'] = $country->getCountry();
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
        if (isset($data['countryISOCode'])) {
            $country = $this->em->getRepository(Country::class)
                ->findOneBy(['country' => $data['countryISOCode']])
            ;
            $data['countryId'] = $country->getId();
        }

        return $this->normalizer->denormalize($data, $type, $format, $context);
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return 'object' === gettype($data) && in_array(self::TRAIT, class_uses($data));
    }
}
