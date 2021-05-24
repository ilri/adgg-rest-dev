<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Paginator;
use App\Entity\TableAttribute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * @see https://symfonycasts.com/screencast/api-platform-extending/listeners-data
 */
class AdditionalAttributesSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * AdditionalAttributesSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onRequestEvent',
        ];
    }

    /**
     * Calls the updateAdditionalAttributes() method when GET requests
     * are made on API resource classes containing the AdditionalAttributeTrait.
     *
     * @param RequestEvent $event
     */
    public function onRequestEvent(RequestEvent $event): void
    {
        $method = $event->getRequest()->getMethod();
        $entity = $event->getRequest()->attributes->get('_api_resource_class');
        $resources = $event->getRequest()->attributes->get('data');

        if ($method !== Request::METHOD_GET || !$resources) {
            return;
        }

        $entityTraits = class_uses($entity);
        if (!in_array('App\Entity\Traits\AdditionalAttributesTrait', $entityTraits)) {
            return;
        }

        if ($resources instanceof Paginator) {
            foreach ($resources as $resource) {
                $this->updateAdditionalAttributes($resource);
            }
        } else {
            $this->updateAdditionalAttributes($resources);
        }
    }

    /**
     * Returns a modified additionalAttributes array, without null values
     * and with keys translated into human-readable labels.
     *
     * @param object $resource
     */
    private function updateAdditionalAttributes(object $resource): void
    {
        if (null === $resource->getAdditionalAttributes()) {
            return;
        }

        $modifiedAdditionalAttributes = [];

        foreach ($resource->getAdditionalAttributes() as $key => $value) {
            if (!empty($value) && $value !== [""]) {
                $label = $this->retrieveAttributeLabel($key);
                if ($label) {
                    $modifiedAdditionalAttributes[$label] = $value;
                }
            }
        }

        $resource->setAdditionalAttributes($modifiedAdditionalAttributes);
    }

    /**
     * Retrieves a CoreTableAttribute object based on its ID
     * and returns the attributeLabel property value.
     *
     * @param $id
     * @return string|null
     */
    private function retrieveAttributeLabel($id): ?string
    {
        $repository = $this->entityManager->getRepository(TableAttribute::class);
        $attr = $repository->find($id);

        return $attr ? $attr->getAttributeLabel(): null;
    }
}
