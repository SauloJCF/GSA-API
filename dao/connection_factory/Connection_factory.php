<?php

namespace Gsi_api\dao\connection_factory;

use PDO;
use Exception;

class Connection_factory {

     private $user = 'root',
            $pass = '',
            $host = 'localhost',
            $dataBase = 'gsa';

    protected function connect(){
        try{
            $conectDB = new PDO("mysql:host=".$this->host.";dbname=".$this->dataBase, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' "));
            return $conectDB;
        } catch (Exception $ex){
            exit($ex);
        }
    }
}
