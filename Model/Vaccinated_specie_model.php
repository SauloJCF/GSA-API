<?php
namespace Gsi_api\Model;

use Gsi_api\dao\connection_factory\Connection_factory;

class Vaccine_model extends Connection_factory
{
    private $vaccine;
    private $specie;

    public function __construct()
    {
        # code...
    }

    public function getVaccine()
    {
        return $this->vaccine;
    }
 
    public function setVaccine($vaccine)
    {
        $this->vaccine = $vaccine;
    }
 
    public function getSpecie()
    {
        return $this->specie;
    }
 
    public function setSpecie($specie)
    {
        $this->specie = $specie;
    }
}