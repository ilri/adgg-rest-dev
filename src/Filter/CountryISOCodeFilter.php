<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Country;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class CountryISOCodeFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property !== 'countryCode') {
            return;
        }

        $countryRepository = $this->managerRegistry->getRepository(Country::class);
        $country = $countryRepository->findOneBy(['country' => $value]);

        $alias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.countryId = :countryId', $alias))
            ->setParameter('countryId', $country->getId())
        ;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(string $resourceClass): array
    {
        return [
          'countryCode' => [
              'property' => null,
              'type' => 'string',
              'required' => false,
              'openapi' => [
                  'description' => 'Provide the country ISO 3166-1 alpha-2 code'
              ]
          ]
        ];
    }
}