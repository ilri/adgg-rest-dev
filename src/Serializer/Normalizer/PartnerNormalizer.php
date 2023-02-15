<?php
namespace App\Serializer\Normalizer;

use App\Entity\Farm;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

//implement the NormalizerInterface to create a normalizer for a specific object
class PartnerNormalizer implements NormalizerInterface
{
    //add security field
    private $security;

    //inject the Security component
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    // Normalize a given object
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$object instanceof Farm || !in_array('farm:partner:get', $context['groups'])) {
            return [];
        }
        
        //Get the user
        $user = $this->security->getUser();
        
        //Verify if user is a partner
        if (!$user || !in_array('ROLE_PARTNER', $user->getRoles())) {
            return [];
        }   

        //normalize the related objects 
        foreach($object->getRelatedObjects() as $relatedObject){
            $normalizedObjects[] = (new AbstractNormalizer())->normalize($relatedObject, $format, $context);
        }
        
        return $normalizedObjects;
    }
    // Verify if the object is an instance of Farm
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Farm && in_array('farm:partner:get', $context['groups']);
    }


}

