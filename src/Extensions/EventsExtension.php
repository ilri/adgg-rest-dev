<?php

namespace App\Extensions;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NewEventsExtension
 * @package App\Extensions
 * @see https://api-platform.com/docs/core/extensions/
 * @see https://symfonycasts.com/screencast/api-platform-security/query-extension
 */
class EventsExtension implements QueryCollectionExtensionInterface
{

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($operationName !== 'custom_events') {
            return;
        }

        //Retrieves the request path (e.g. /animal_events/calving_events)
        $request_path = Request::createFromGlobals()->getPathInfo();
        //Retrieves the event type's lookup value
        $event_type = $this->retrieveEventTypeConstantValue($request_path);

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->andWhere(sprintf('%s.eventType = :eventType', $rootAlias))
            ->setParameter('eventType', $event_type)
        ;
    }

    /**
     * Retrieves the constant (e.g. EVENT_TYPE_CALVING) associated with a given
     * request parameter (e.g. calving_events) and returns its value (e.g. 1)
     *
     * @param $request_path
     * @return mixed
     */
    public function retrieveEventTypeConstantValue($request_path){
        preg_match('/animal_events\/(.*?)_events/', $request_path, $matches);
        $eventParameter = $matches[1];
        $eventTypeConstant = strtoupper('EVENT_TYPE_'.$eventParameter);
        if (defined('\App\Entity\AnimalEvent::'.$eventTypeConstant)){
            return constant('\App\Entity\AnimalEvent::'.$eventTypeConstant);
        }
    }

}
