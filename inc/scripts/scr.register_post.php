<?php

    $username = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword", FILTER_SANITIZE_STRING);

    

    if(!empty($password) && $password == $confirmpassword && !empty($email) && !empty($username)){

        if(UserManager::addUser(new User(0, $username,$email), $password)){

             header("Location:index.php?site=login");

        }else

            header("Location:index.php?site=register");

    }else

        header("Location:index.php?site=register");


?>