<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * @see https://symfonycasts.com/screencast/api-platform-extending/post-load-listener
 */
class AttributesListener
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns a modified additionalAttributes object, without null values
     * and with keys translated into human-readable labels.
     *
     * @param $entity
     * @param LifecycleEventArgs $event
     */
    public function postLoad($entity, LifecycleEventArgs $event)
    {
        if(!$entity->getAdditionalAttributes()){
            return;
        }
        $modifiedAdditionalAttributes = array();
        foreach ($entity->getAdditionalAttributes() as $key => $value) {
            if (!empty($value) && $value!==[""]) {
                $label = $this->retrieveAttributeLabel($key);
                $modifiedAdditionalAttributes[$label] = $value;
            }
        }
        $entity->setAdditionalAttributes($modifiedAdditionalAttributes);
    }

    /**
     * Retrieves a CoreTableAttribute object based on its ID
     * and returns the attributeLabel property value.
     *
     * @param $id
     * @return mixed
     */
    private function retrieveAttributeLabel($id)
    {
        $repository = $this->entityManager->getRepository("App:CoreTableAttribute");
        return $repository->find($id)->getAttributeLabel();
    }
}
