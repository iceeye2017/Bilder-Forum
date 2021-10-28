<?php

    const MAX_INACTIVITY_SECONDS = 60 * 60 * 10;

    require_once "inc/classes/class.User.php";
    require_once "inc/classes/class.UserManager.php";

    session_start();

    // Regeneriert die Session
    if (isset($_SESSION["lastActivity"]) && (time()-$_SESSION["lastActivity"] > MAX_INACTIVITY_SECONDS)) {
        session_destroy();
    }else{
        session_regenerate_id(true);
        $_SESSION["lastActivity"] = time();
    }

    include_once "inc/scripts/scr.head.php";
  
    UserManager::connect("root", "", "localhost", "bilderforum");

?>
<body>


    <?php

        include_once "inc/scripts/scr.nav.php";
        $site = "profile";
        if(isset($_GET["site"]) && !empty($_GET["site"])){
            $site = $_GET["site"];
            $site = strtolower($_GET["site"]);
        }
        
        switch($site){
            case "login": {
                include "inc/scripts/scr.login.php";
                break;
            }
            case "profile":{
                include "inc/scripts/scr.profile.php";
                break;
            }
        }
        include_once "inc/scripts/scr.footer.php";
    ?>

</body>

<?php

  UserManager::close();

?>