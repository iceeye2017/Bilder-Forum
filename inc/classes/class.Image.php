<?php

class Image{
    private $name;
    private $userId;

    public function __construct($name, $userId){
        $this->name = $name;
        $this->userId = $userId;
    }

    public function getName(){
        return $this->name;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getUser(){
        return UserManager::getUserById($this->userId);
    }

}

?>