<?php

namespace KL\BaseBundle\Entity;

class BaseEntityException extends \Exception
{
    
};

class BaseEntity
{
    public function __call($method, $args)
    {
        if (substr($method, 0, 3) === 'get') {
            $property = lcfirst((substr($method, 3)));
            
            if (!property_exists($this, $property)) {
                throw new BaseEntityException('Trying to get invalid ' . get_class($this) . ' class property');
            }
            
            return $this->$property;
        }
        
        if (substr($method, 0, 3) === 'set') {
            $property = lcfirst((substr($method, 3)));
            
            if ($property == 'id' || !property_exists($this, $property)) {
                throw new BaseEntityException('Trying to set invalid ' . get_class($this) . ' class property');
            }
            
            $this->$property = $args[0];
            return $this;
        }
        
        throw new BaseEntityException('Method does not exist');
    }
    
    public function dataSetter(array $data)
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, get_class_vars(get_class($this)))) {
                $this->$key = $value;
            }
        }
    }
}