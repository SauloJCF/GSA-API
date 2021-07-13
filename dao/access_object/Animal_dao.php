<?php
namespace Gsi_api\dao\access_object;

use PDO;
use PDOException;
use Gsi_api\Model\Animal_model;

class Animal_dao extends Animal_model
{
    public function create()
    {
        try {
            $con = $this->connect();
            $sql = 'INSERT INTO animal (name, birthDate, idSpecie, sex, img, idUser) VALUES (?, ?, ?, ?, ?, ?);';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getName());
            $pre->bindValue(2, $this->getBirthDate());
            $pre->bindValue(3, $this->getSpecie()->getId());
            $pre->bindValue(4, $this->getSex());
            $pre->bindValue(5, $this->getImg());
            $pre->bindValue(6, $this->getUser()->getId());
            if ($pre->execute()) {
                return array('status' => 'success');
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }

    public function select($idAnimal)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT id, name, DATE(birthDate) as birthDate, idSpecie, sex, img, idUser, status FROM animal WHERE status = 1 AND id = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $idAnimal);
            if ($pre->execute()) {
                $data = $pre->fetchAll(PDO::FETCH_ASSOC);
                if ($data) {     
                    return $data[0];
                } 
                return null;
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }

    public function findAll($idUser)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT a.*, s.name as specieName FROM animal a INNER JOIN specie s ON a.idSpecie = s.id WHERE a.status = 1 AND idUser = ? ORDER BY a.name ASC;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $idUser);
            if ($pre->execute()) {
                return $pre->fetchAll(PDO::FETCH_ASSOC);
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }

    public function delete()
    {
        try {
            $con = $this->connect();
            $sql = 'UPDATE Animal SET status = 0 WHERE id = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getId());
            if ($pre->execute()) {
                return array('status' => 'success');
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }

    public function update()
    {
        try {
            $con = $this->connect();
            $sql = 'UPDATE Animal SET name = ?, birthDate = ?, idSpecie = ?, sex = ?, img = ? WHERE id = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getName());
            $pre->bindValue(2, $this->getBirthDate());
            $pre->bindValue(3, $this->getSpecie()->getId());
            $pre->bindValue(4, $this->getSex());
            $pre->bindValue(5, $this->getImg());
            $pre->bindValue(6, $this->getId());
            if ($pre->execute()) {
                return array('status' => 'success');
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }
}