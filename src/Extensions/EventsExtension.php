<?php

namespace App\Extensions;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\ContextAwareQueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * EventsExtension
 *
 * @package App\Extensions
 * @see https://api-platform.com/docs/core/extensions/
 * @see https://symfonycasts.com/screencast/api-platform-security/query-extension
 */
class EventsExtension implements ContextAwareQueryCollectionExtensionInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null, array $context = []): void
    {
        if ($operationName !== 'custom_events') {
            return;
        }

        $requestUri = $context['request_uri'];
        $pathParameter = $this->retrievePathParameter($requestUri);

        //If the {event_type} parameter is invalid, return a 404 exception.
        if (!$this->retrieveConstantValue($pathParameter)) {
            throw new NotFoundHttpException(
                sprintf(
                    'Resources for parameter value \'%s\' have not been found. 
                    See the API documentation for a full list of 
                    available parameters.',
                    $pathParameter
                )
            );
        }

        $constantValue = $this->retrieveConstantValue($pathParameter);
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->andWhere(sprintf('%s.eventType = :eventType', $rootAlias))
            ->setParameter('eventType', $constantValue);
    }

    /**
     * Retrieves the {event_type} path parameter of a given request URI.
     *
     * @param $requestUri
     * @return mixed
     */
    private function retrievePathParameter($requestUri): ?string
    {
        preg_match('/animal_events\/(.*?_events)/', $requestUri, $matches);

        return $matches[1];
    }

    /**
     * Retrieves the constant (e.g. EVENT_TYPE_CALVING) associated with a given
     * path parameter (e.g. calving_events) and returns its value (e.g. 1).
     *
     * @param $pathParameter
     * @return mixed
     */
    private function retrieveConstantValue($pathParameter): ?string
    {
        $eventType = preg_replace('/_events/', '', $pathParameter);
        $eventTypeConstant = strtoupper('EVENT_TYPE_'.$eventType);

        if (defined('\App\Entity\AnimalEvent::'.$eventTypeConstant)) {
            return constant('\App\Entity\AnimalEvent::'.$eventTypeConstant);
        }
    }
}
