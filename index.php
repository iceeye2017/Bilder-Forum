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

    $site = "discover";
    if(isset($_GET["site"]) && !empty($_GET["site"])){
        $site = $_GET["site"];
        $site = strtolower($_GET["site"]);
    }

    if($site == "gallery" && $site =="profile" && empty($_SESSION["user"])){

            $site = "login";

    }


?>
<body>


    <?php

        include_once "inc/scripts/scr.nav.php";    
        
        switch($site){
            case "login": {
                include "inc/scripts/scr.login.php";
                break;
            }
            case "profile":{
                include "inc/scripts/scr.profile.php";
                break;
            }
            case "slider":{
                include "inc/scripts/scr.slider.php";
                break;
            }
            case "login_post":{
                include "inc/scripts/scr.login_post.php";
                break;
            }
            case "register":{
                include "inc/scripts/scr.register.php";
                break;
            }
            case "register_post":{

                include "inc/scripts/scr.register_post.php";
                break;
            }
            case "logout";{

                include "inc/scripts/scr.logout.php";

            }
            case "gallery":{

                include "inc/scripts/scr.gallery.php";
                break;

            }

        }
        include_once "inc/scripts/scr.footer.php";
    ?>

</body>

<?php

  UserManager::close();

?>