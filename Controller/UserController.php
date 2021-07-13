<?php
namespace Gsi_api\Controller;

use Gsi_api\dao\access_object\User_dao;

class UserController
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new User_dao();   
    }

    public function insert()
    {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $results = "";

        if ($name && $email && $username && $password) {
            $this->userDAO->setName($name);
            $this->userDAO->setEmail($email);
            $this->userDAO->setUsername($username);
            $this->userDAO->setPassword($password);
            $results = $this->userDAO->create();
        }
        else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }

    public function validateCredentials()
    {
        $login = filter_input(INPUT_POST, 'login');
        $password = filter_input(INPUT_POST, 'password');
        $results = "";
        if ($login && $password) {
            $results = $this->userDAO->selectWithCredentials($login, $password);
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }

    public function existWithEmail()
    {
        $email = filter_input(INPUT_POST, 'email');
        $results = "";

        if ($email) {
            $results = $this->userDAO->selectWithEmail($email);
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }

    public function edit()
    {
        $idUser = filter_input(INPUT_POST, "idUser");
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $username = filter_input(INPUT_POST, 'username');

        $results = "";


        if ($idUser && $name && $email && $username) {
            $this->userDAO->setId($idUser);
            $this->userDAO->setName($name);
            $this->userDAO->setEmail($email);
            $this->userDAO->setUsername($username);
            $results = $this->userDAO->update();
        }
        else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);

    }

    public function show()
    {
        $idUser = filter_input(INPUT_POST, 'idUser');
        $results = "";
        if (isset($idUser)) {
            $results = $this->userDAO->select($idUser);
        } else {
            $results = 'Dados ausentes ou incorretos';
        }
        echo json_encode($results);
    }
}