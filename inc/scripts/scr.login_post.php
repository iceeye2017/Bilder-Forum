
<?php

    $username = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    if(UserManager::loginUser($username, $password)){

        header("Location:index.php");

    }else

        header("Location:index.php?site=login");


?>