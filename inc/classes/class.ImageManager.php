<?php
class ImageManager{
    const DIR = "./images/"; 

    private static $con;

    public static function connect($username, $password, $host, $databasename){
        self::$con = new MySQLi($host, $username, $password, $databasename);
        if (self::$con->connect_errno) {
          echo "Failed to connect to MySQL: " . self::$con->connect_error;
          exit();
        }
    }

    public static function close(){
        if(self::$con){
            self::$con->close();
        }
    }

    public static function getImagePath($image){
        return self::DIR . $image->getName();
    }

    public static function getImagesFromUser($userId){
        if(!$userId)
            return;

        $stmt = self::$con->prepare("SELECT iname, uid FROM images WHERE uid=?");
        if(self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt->store_result();
        
        $stmt->bind_result($iname, $uid);

        $ret = [];
        while($stmt->fetch()){
            $ret[] = new Image($iname, $uid);
        }

        $stmt->close();

        return $ret;
    }

    public static function saveImageFromSuperglobal($image, $userId) {
        if (isset($image) && $image["error"] == UPLOAD_ERR_OK && isset($userId)) {
            $type = explode("/", $image["type"])[1];
            $name = self::generateRandomString() . $type;
            $file = $image["tmp_name"];

            if (!file_exists(self::DIR)) {
                mkdir(self::DIR);
            }
            copy($file, self::DIR . $name);

            $image = new Image($name, $userId);
            self::addImage($image);
        }
    }

    private static function addImage($image){
        if(!$image)
            return;

        $stmt = self::$con->prepare("INSERT INTO `images`(`iname`, `uid`) VALUES (?,?);");

        if (self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }

        $iname = $image->getName();
        $uid = $image->getUserId();
        
        $stmt->bind_param("si", $iname, $uid);

        $stmt->execute();

        if (self::$con->errno) {
          if (self::$con->errno == 1062)
            $ret = false;
          else
            trigger_error(self::$con->error, E_USER_WARNING);
            $ret = false;
        } else {
          $ret = true;
        }
        $stmt->close();

        return $ret;

    }

    private static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
?>