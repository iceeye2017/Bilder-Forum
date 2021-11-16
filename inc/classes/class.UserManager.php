<?php

class UserManager {

    private static $con;

    public static function connect($username, $password, $host, $databasename){
        self::$con = new MySQLi($host, $username, $password, $databasename);
        if (self::$con->connect_errno) {
          echo "Failed to connect to MySQL: " . self::$con->connect_error;
          exit();
        }
    }

    public static function addUser($user, $password){
        if(!$user)
            return;

        $stmt = self::$con->prepare("INSERT INTO users(uname, uemail, upassword, uprofileimg, uprofileimgtype) VALUES (?,?,?,?,?);");

        if (self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }

        $uname = $user->getUsername();
        $uemail = $user->getEmail();
        $upassword = password_hash($password, PASSWORD_DEFAULT);
        $null = null;
        $uprofileimgtype = $user->getImageType();

        $stmt->bind_param("sssbs", $uname, $uemail, $upassword, $null, $uprofileimgtype);

        $stmt->send_long_data(4, $user->getImage());

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

    public static function getUser($username){
        if(!$username)
            return;

        $stmt = self::$con->prepare("SELECT uname, uemail, uprofileimg, uprofileimgtype FROM users WHERE uname=?");
        if(self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }
        
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $stmt->store_result();
        
        $stmt->bind_result($username, $email, $profileimg, $profileimgtype);

        if($stmt->fetch()){
            return new User($username, $email, $profileimg, $profileimgtype);
        }

        $stmt->close();

        return false;
    }

    public static function getUserById($userId){
        if(!$userId)
            return;

        $stmt = self::$con->prepare("SELECT uname, uemail, uprofileimg, uprofileimgtype FROM users WHERE uid=?");
        if(self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    
        $stmt->store_result();
        
        $stmt->bind_result($username, $email, $profileimg, $profileimgtype);

        if($stmt->fetch()){
            return new User($username, $email, $profileimg, $profileimgtype);
        }

        $stmt->close();

        return false;
    }

    public static function updateUser($user, $oldUsername){
        if(!$user || !$oldUsername)
            return;

        $sql = <<<EOM
            UPDATE users
            SET
            uname=?,
            uemail=?,
            uprofileimg=?,
            uprofileimgtype=?
            WHERE
            uname=?;
EOM;

        $stmt = self::$con->prepare($sql);
        if(self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }

        $uname = $user->getUsername();
        $uemail = $user->getEmail();
        $null = null;
        $uprofileimgtype = $user->getImageType();

        $stmt->bind_param("ssbss", $uname, $uemail, $null, $uprofileimgtype, $oldUsername);
        $stmt->send_long_data(4, $user->getImage());

        $stmt->execute();

        $ret = false;
        if (self::$con->errno) {
            if (self::$con->errno == 1062)
              $user->setError("username", "Benutzername bereits vergeben");
            else
              trigger_error($con->error, E_USER_WARNING);
              $ret = false;
          } else {
            $ret = true;
          }
          $stmt->close();
          return $ret;
    }

    public static function deleteUser($username){
        if(!$username)
            return;
        $ret = false;

        $sql = <<<EOM
            DELETE FROM users WHERE uname=?;
EOM;
        $stmt = self::$con->prepare($sql);
        if (self::$con->errno) {
            trigger_error($con->error, E_USER_WARNING);
            return false;
        }

        $stmt->bind_param("s", $username);

        $stmt->execute();
        if (!self::$con->errno) {
            $ret = true;
        }
      
        $stmt->close();
        return $ret;
    }

    public static function loginUser($username, $password){

        $ret = false;

        if(empty($username)||empty($password)){

            return $ret;

        }

        $sql = "SELECT upassword FROM users WHERE uname=?";

        $stmt = self::$con->prepare($sql);
        if (self::$con->errno) {
            trigger_error(self::$con->error, E_USER_WARNING);
            return false;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($uhashpass);

        if($stmt->fetch()){
            
            $ret = password_verify($password,$uhashpass);    

        }

        $stmt->close();

        return $ret;

    }

    public static function close(){
        if(self::$con){
            self::$con->close();
        }
    }

}

?>