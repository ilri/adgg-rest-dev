<?php



namespace App\EventListener;

use App\Entity\Farm;
use App\Entity\FarmMetadata;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class FarmMetadataListener
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof FarmMetadata) {
            // Check if herd_id is provided in the post payload
            if ($entity->getFarm() !== null) {
                return; // Skip execution if herd_id is already provided
            }

            // Fetch the herd_id using the stored function
            $farmId = $this->fetchFarmMetdataId($entity->getFarm());

            // Set the herd_id on the Animal entity if it's not null
            if ($farmId !== null) {
                $entity->setFarm($farmId);

                // Flush the changes
                $this->entityManager->flush();
            }
        }
    }

    private function fetchFarmMetdataId($mobFarmMetadataDataId)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('farmId', 'farmId');

        $sql = 'SELECT fn_getFarmID_mob(:mobFarmDataId) as farmId';
        $query = $this->entityManager->createNativeQuery($sql, $rsm);
        $query->setParameter('mobFarmMetadataDataId', $mobFarmMetadataDataId);

        $result = $query->getSingleResult();

        return $result['farmId'];
    }
}
