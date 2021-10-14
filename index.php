<?php

    require_once "inc/classes/class.User.php";
    require_once "inc/classes/class.UserManager.php";

    include_once "inc/scripts/scr.head.php";
  
    UserManager::connect("root", "", "localhost", "bilderforum");

    

    UserManager::close();

?>