<?php

namespace App\Model\Entity;

use App\Model\Traits\Hydrator;

abstract class BaseEntity
{

    protected int $id;

    use Hydrator;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }




    // getter and setter
    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        return $this->id = $id;
    }
}
