<?php
namespace Gsi_api\dao\access_object;

use PDO;
use PDOException;
use Gsi_api\Model\User_model;

class User_dao extends User_model
{
    public function create()
    {
        try {
            $con = $this->connect();
            $sql = 'INSERT INTO user (email, name, username, password) VALUES (?, ?, ?, MD5(?));';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getEmail());
            $pre->bindValue(2, $this->getName());
            $pre->bindValue(3, $this->getUsername());
            $pre->bindValue(4, $this->getPassword());
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
            $sql = 'UPDATE user SET email=?, name=?, username=? WHERE id = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $this->getEmail());
            $pre->bindValue(2, $this->getName());
            $pre->bindValue(3, $this->getUsername());
            $pre->bindValue(4, $this->getId());
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

    public function selectWithEmail($email)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT COUNT(*) AS EmailUses FROM user WHERE email = ? AND status = 1;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $email);
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

    public function selectWithCredentials($login, $password)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT * FROM user WHERE (username = ? OR email = ?) AND password = MD5(?);';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $login);
            $pre->bindValue(2, $login);
            $pre->bindValue(3, $password);
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

    public function select($idUser)
    {
        try {
            $con = $this->connect();
            $sql = 'SELECT * FROM user WHERE status = 1 AND id = ?;';
            $pre = $con->prepare($sql);
            $pre->bindValue(1, $idUser);
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

}