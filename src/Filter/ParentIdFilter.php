<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\CountryUnits;
use Doctrine\ORM\QueryBuilder;

class ParentIdFilter extends AbstractContextAwareFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property !== 'countryunits') {
            return;
        }


        $countryUnitRepository = $this->managerRegistry->getRepository(CountryUnits::class);
        $country = $countryUnitRepository->findOneBy(['countryunits' => $value]);
        $regioncode = $country ? $country->getCode() : 0;

        $alias = $queryBuilder->getRootAliases()[0];
        $valueParameter = $queryNameGenerator->generateParameterName('parent_id');
        $queryBuilder
            ->andWhere(sprintf('%s.parent_id = :%s', $alias, $valueParameter))
            ->setParameter($valueParameter, $regioncode)
        ;
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'parentid' => [
                'name' => 'Parent id',
                'property' => null,
                'type' => 'int',
                'required' => false,
                'description' => 'use the parent id to filter',
                'openapi' => [
                    'allowEmptyValue' => false,
                ]
            ]
        ];
    }
}