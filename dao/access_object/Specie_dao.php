<?php
namespace Gsi_api\dao\access_object;

use PDO;
use PDOException;
use Gsi_api\Model\Specie_model;

class Specie_dao extends Specie_model
{
    public function findAll()
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT * FROM specie WHERE status = 1;';
            if ($data = $con->query($sql)) {
                return $data->fetchAll(PDO::FETCH_ASSOC);
            }
            else {
                return array('status' => 'error');
            }
        } catch (PDOException $pdoex) {
            return array('status' => 'error: ' . $pdoex);
        }
    }
}