<?php
namespace Gsi_api\Model;

use Gsi_api\dao\connection_factory\Connection_factory;

class User_model extends Connection_factory
{
    private $id;
    private $email;
    private $name;
    private $username;
    private $password;
    private $status;
    
    public function __construct($id = null)
    {
        $this->id = $id;
    }
     
    public function getId()
    {
        return $this->id;
    }
 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }
 
    public function setEmail($email)
    {
        $this->email = $email;
    }
     
    public function getName()
    {
        return $this->name;
    }
 
    public function setName($name)
    {
        $this->name = $name;
    }
     
    public function getUsername()
    {
        return $this->username;
    }
 
    public function setUsername($username)
    {
        $this->username = $username;
    }
     
    public function getPassword()
    {
        return $this->password;
    }
 
    public function setPassword($password)
    {
        $this->password = $password;
    }
     
    public function getStatus()
    {
        return $this->status;
    }
 
    public function setStatus($status)
    {
        $this->status = $status;
    }
}