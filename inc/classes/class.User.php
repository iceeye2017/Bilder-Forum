<?php

class User{

    private $email;
    private $username;

    private $image;
    private $imageType;

    public function __construct($username, $email, $image = null, $imageType = ""){
        $this->username = $username;
        $this->email = $email;
        $this->image = $image;
        $this->imageType = $imageType;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->$email = $email;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->$image = $image;
    }

    public function getImageType(){
        return $this->imageType;
    }

    public function setImageType($imageType){
        $this->imageType = $imageType;
    }

}

?>