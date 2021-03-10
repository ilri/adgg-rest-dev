<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Country;
use Doctrine\ORM\QueryBuilder;

class CountryISOCodeFilter extends AbstractContextAwareFilter
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
        $id = $country ? $country->getId() : 0;

        $alias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->andWhere(sprintf('%s.countryId = :countryId', $alias))
            ->setParameter('countryId', $id)
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