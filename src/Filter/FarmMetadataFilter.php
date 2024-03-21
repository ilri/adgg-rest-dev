<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Farm;
use Doctrine\ORM\QueryBuilder;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class FarmMetadataFilter extends AbstractContextAwareFilter
{
    /**
     * @param string $property
     * @param mixed $value
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     * @return void
     */
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null): void
    {
        if (!in_array($property, ['regionId', 'districtId'])) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->innerJoin($rootAlias . '.farm', 'farm');

        $parameterName = $queryNameGenerator->generateParameterName($property);
        $queryBuilder->andWhere("farm.$property = :$parameterName")
            ->setParameter($parameterName, $value);
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'regionId' => [
                'property' => null,
                'type' => 'integer',
                'required' => false,
                'description' => 'Filter by region ID',
            ],
            'districtId' => [
                'property' => null,
                'type' => 'integer',
                'required' => false,
                'description' => 'Filter by district ID',
            ],
        ];
    }
}
