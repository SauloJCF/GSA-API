<?php
namespace Gsi_api\Controller;

use Gsi_api\dao\access_object\Animal_dao;
use Gsi_api\dao\access_object\Specie_dao;
use Gsi_api\dao\access_object\User_dao;

class AnimalController
{
    private $animalDAO;

    public function __construct()
    {
        $this->animalDAO = new Animal_dao();
    }

    function list() {
        $idUser = filter_input(INPUT_POST, 'idUser');
        $results = "";
        if ($idUser) {
            $results = $this->animalDAO->findAll($idUser);
        } else {
            $results = "Dados ausentes ou incorretos";
        }

        echo json_encode($results);
    }

    public function insert()
    {
        $name = filter_input(INPUT_POST, 'name');
        $birthDate = filter_input(INPUT_POST, 'birthDate');
        $idSpecie = filter_input(INPUT_POST, 'idSpecie');
        $sex = filter_input(INPUT_POST, 'sex');
        $img = filter_input(INPUT_POST, 'img');
        $idUser = filter_input(INPUT_POST, 'idUser');

        $results = "";

        if ($name && $birthDate && $idSpecie && isset($sex) && $idUser) {

            $animalSpecie = new Specie_dao($idSpecie);
            $animalOwner = new User_dao($idUser);

            $this->animalDAO->setName($name);
            $this->animalDAO->setBirthDate($birthDate);
            $this->animalDAO->setSpecie($animalSpecie);
            $this->animalDAO->setSex($sex);
            $this->animalDAO->setImg($img);
            $this->animalDAO->setUser($animalOwner);
            $results = $this->animalDAO->create();
        } else {
            $results = "Dados ausentes ou incorretos $name";
        }
        echo json_encode($results);
    }

    public function show()
    {
        $idAnimal = filter_input(INPUT_POST, 'idAnimal');
        $results = "";
        if (isset($idAnimal)) {
            $results = $this->animalDAO->select($idAnimal);
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }

    public function remove()
    {
        $idAnimal = filter_input(INPUT_POST, 'idAnimal');
        $idUser = filter_input(INPUT_POST, 'idUser');
        $results = "";

        if (isset($idAnimal) && isset($idUser)) {
            $animal = $this->animalDAO->select($idAnimal);
            if (!$animal) {
                $results = "Animal inesistente";
            } else {
                $ownerId = $animal["idUser"];
                if ($ownerId == $idUser) {
                    $this->animalDAO->setId($idAnimal);
                    $results = $this->animalDAO->delete();
                } else {
                    $results = 'Permissão negada';
                }
            }
            
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);

    }

    public function edit()
    {
        $idAnimal = filter_input(INPUT_POST, "idAnimal");
        $name = filter_input(INPUT_POST, 'name');
        $birthDate = filter_input(INPUT_POST, 'birthDate');
        $idSpecie = filter_input(INPUT_POST, 'idSpecie');
        $sex = filter_input(INPUT_POST, 'sex');
        $img = filter_input(INPUT_POST, 'img');
        $idUser = filter_input(INPUT_POST, 'idUser');

        $results = "";


        if ($name && $birthDate && $idSpecie && isset($sex) && $idAnimal && $idUser) {
            
            $animal = $this->animalDAO->select($idAnimal);

            if (!$animal) {
                $results = "Animal inesistente";
            } else {
                $ownerId = $animal["idUser"];
                if ($ownerId != $idUser) {
                    $results = 'Permissão negada';
                } else {
                    $animalSpecie = new Specie_dao($idSpecie);

                    $this->animalDAO->setId($idAnimal);
                    $this->animalDAO->setName($name);
                    $this->animalDAO->setBirthDate($birthDate);
                    $this->animalDAO->setSpecie($animalSpecie);
                    $this->animalDAO->setSex($sex);
                    $this->animalDAO->setImg($img);
                    $results = $this->animalDAO->update();
                }
            }
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);

    }
}
