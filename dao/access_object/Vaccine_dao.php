<?php
namespace Gsi_api\dao\access_object;

use PDO;
use PDOException;
use Gsi_api\Model\Vaccine_model;

class Vaccine_dao extends Vaccine_model
{
    public function create()
    {
        try {
            $con = $this->connect();
            $sql = 'INSERT INTO vaccine (name, startOfApplication, endOfApplication, idUser) VALUES (?, ?, ?, ?);';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getName());
            $pre->bindValue(2, $this->getStartOfApplication());
            $pre->bindValue(3, $this->getEndOfApplication());
            $pre->bindValue(4, $this->getUser()->getId());
            if ($pre->execute()) {
                return array('status' => 'success');
            } else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }

    public function select()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function findAll($idUser)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT * FROM vaccine WHERE status = 1 AND idUser = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $idUser);
            if ($pre->execute()) {
                return $pre->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }
}
