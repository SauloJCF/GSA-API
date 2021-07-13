<?php
namespace Gsi_api\Model;

use Gsi_api\dao\connection_factory\Connection_factory;

class Specie_model extends Connection_factory
{
    private $id;
    private $name;
    private $status;

    public function __construct($id = null)
    {
        $this->id = $id;
    }
     
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
     
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}