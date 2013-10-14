<?php

namespace KL\BaseBundle\Model;

use Doctrine\ORM\EntityManager;
use KL\BaseBundle\Entity\BaseEntity;

abstract class BaseManager
{
    
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class)
    {
        $this->objectManager = $em;
        $this->repository = $em->getRepository($class);
        
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->getName();
        
    }
    
    public function clear()
    {
        $this->objectManager->clear();
    }
    
    public function save(BaseEntity $entity)
    {
        $this->objectManager->persist($entity);
        $this->objectManager->flush();
    }
    
    public function delete(BaseEntity $entity)
    {
        $this->objectManager->remove($entity);
        $this->objectManager->flush();
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function getRepository()
    {
        return $this->repository;
    }
    
}