<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\MasterList;
use Doctrine\ORM\QueryBuilder;

class ListTypeFilter extends AbstractContextAwareFilter
{

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null) {
        if ($property !== 'masterlist') {
            return;
        }
        $masterListRepository = $this->managerRegistry->getRepository(MasterList::class);
        $masterlist = $masterListRepository->findOneBy(['masterlist' => $value]);
        $masterlistlistype = $masterlist ? $masterlist->getId() : 0;

        $alias = $queryBuilder->getRootAliases()[0];
        $valueParameter = $queryNameGenerator->generateParameterName('listtype');
        $queryBuilder->andWhere(sprintf('%s.listtype = :%s', $alias, $valueParameter))
            ->setParameter($valueParameter, $masterlistlistype)
        ;

    }

    public function getDescription(string $resourceClass): array {
        return [
            'listtypeid' => [
                'name' => 'list type id key',
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'use the id from master list type end point to filter',
                'openapi' => [
                    'allowEmptyValue' => false,
                ]
            ]
        ];

    }
}