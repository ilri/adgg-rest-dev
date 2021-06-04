<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Country;
use Doctrine\ORM\QueryBuilder;

/**
 * CountryISOCodeFilter
 *
 * Custom filter that retrieves the id from the table core_country (entity Country)
 * for a given ISO 3166-1 alpha-2 letters code.
 * The retrieved id can be then used to filter other entities for their property countryId.
 *
 * @see https://api-platform.com/docs/core/filters/#creating-custom-filters
 * @see https://symfonycasts.com/screencast/api-platform-extending/entity-filter-logic
 * @see https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
 *
 * @author Cezar Pendarovski <cezar.pendarovski@roslin.ed.ac.uk>
 */
class CountryISOCodeFilter extends AbstractContextAwareFilter
{
    /**
     * @inheritDoc
     */
    protected function filterProperty(
        string $property,
        $value,
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        if ($property !== 'countryCode') {
            return;
        }

        $countryRepository = $this->managerRegistry->getRepository(Country::class);
        $country = $countryRepository->findOneBy(['country' => $value]);
        $countryId = $country ? $country->getId() : 0;

        $alias = $queryBuilder->getRootAliases()[0];
        $valueParameter = $queryNameGenerator->generateParameterName('countryId');
        $queryBuilder->andWhere(sprintf('%s.countryId = :%s', $alias, $valueParameter))
            ->setParameter($valueParameter, $countryId)
        ;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(string $resourceClass): array
    {
        return [
            'countryCode' => [
                'name' => 'Country ISO 3166-1 alpha-2 code',
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Provide the country ISO 3166-1 alpha-2 code',
                'openapi' => [
                    'allowEmptyValue' => false,
                ]
            ]
        ];
    }
}
