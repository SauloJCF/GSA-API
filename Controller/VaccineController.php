<?php
namespace Gsi_api\Controller;

use Gsi_api\dao\access_object\Vaccine_dao;
use Gsi_api\dao\access_object\User_dao;

class VaccineController
{
    private $vaccineDAO;

    public function __construct()
    {
        $this->vaccineDAO = new Vaccine_dao();
    }

    function list() {
        $idUser = filter_input(INPUT_POST, 'idUser');
        $results = "";
        if ($idUser) {
            $results = $this->vaccineDAO->findAll($idUser);
        } else {
            $results = "Dados ausentes ou incorretos";
        }

        echo json_encode($results);
    }

    public function insert()
    {
        $name = filter_input(INPUT_POST, 'name');
        $startOfApplication = filter_input(INPUT_POST, 'startOfApplication');
        $endOfApplication = filter_input(INPUT_POST, 'endOfApplication');
        $idUser = filter_input(INPUT_POST, 'idUser');
        $results = "";

        if ($name && $startOfApplication && $endOfApplication && $idUser) {
            
            $vaccineCreator = new User_dao($idUser);
            $this->vaccineDAO->setName($name);
            $this->vaccineDAO->setStartOfApplication($startOfApplication);
            $this->vaccineDAO->setEndOfApplication($endOfApplication);
            $this->vaccineDAO->setUser($vaccineCreator);

            $results = $this->vaccineDAO->create();
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }
}