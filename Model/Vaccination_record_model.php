<?php
namespace Gsi_api\Model;

use Gsi_api\dao\connection_factory\Connection_factory;

class Vaccine_model extends Connection_factory
{
    private $animal;
    private $vaccine;
    private $date;
    private $status;

    public function __construct()
    {
        # code...
    }
 
    public function getAnimal()
    {
        return $this->animal;
    }
 
    public function setAnimal($animal)
    {
        $this->animal = $animal;
    }
 
    public function getVaccine()
    {
        return $this->vaccine;
    }
 
    public function setVaccine($vaccine)
    {
        $this->vaccine = $vaccine;
    }
 
    public function getDate()
    {
        return $this->date;
    }
 
    public function setDate($date)
    {
        $this->date = $date;
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