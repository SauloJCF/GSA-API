<?php
namespace Gsi_api\Model;

use Gsi_api\dao\connection_factory\Connection_factory;

class Vaccine_model extends Connection_factory
{
    private $id;
    private $name;
    private $startOfApplication;
    private $endOfApplication;
    private $user;
    private $status;

    public function __construct()
    {
        # code...
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

    public function getStartOfApplication()
    {
        return $this->startOfApplication;
    }
 
    public function setStartOfApplication($startOfApplication)
    {
        $this->startOfApplication = $startOfApplication;
    }

    public function getEndOfApplication()
    {
        return $this->endOfApplication;
    }
 
    public function setEndOfApplication($endOfApplication)
    {
        $this->endOfApplication = $endOfApplication;
    }
     
    public function getUser()
    {
        return $this->user;
    }
 
    public function setUser($user)
    {
        $this->user = $user;
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