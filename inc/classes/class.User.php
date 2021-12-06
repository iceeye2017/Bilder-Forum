<?php

class User{

    private $id;

    private $email;
    private $username;

    private $image;
    private $imageType;

    public function __construct($id, $username, $email, $image = null, $imageType = ""){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->image = $image;
        $this->imageType = $imageType;
    }

    public function getId(){
        return $this->id;
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

    public function setImageFromSuperglobal($image) {

        if (isset($image) && $image["error"] == UPLOAD_ERR_OK) {
            
            $this->imageType = $image["type"];
            $file = fopen($image["tmp_name"], "rb");
            $this->image = fread($file, $image["size"]);
            fclose($file);

        }
    }

}

?>