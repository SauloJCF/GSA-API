<?php
namespace Gsi_api\Controller;

use Gsi_api\dao\access_object\Specie_dao;

class SpecieController
{
    private $specieDAO;

    public function __construct()
    {
        $this->specieDAO = new Specie_dao();   
    }

    public function list()
    {
        $results = $this->specieDAO->findAll();
        echo json_encode($results);
    }
}