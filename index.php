<?php

    const MAX_INACTIVITY_SECONDS = 60 * 60 * 10;

    const loginNeeded = [
        "profile",
        "gallery"
    ];

    require_once "inc/classes/class.User.php";
    require_once "inc/classes/class.Image.php";
    require_once "inc/classes/class.UserManager.php";
    require_once "inc/classes/class.ImageManager.php";

    session_start();

    // Regeneriert die Session
    if (isset($_SESSION["lastActivity"]) && (time()-$_SESSION["lastActivity"] > MAX_INACTIVITY_SECONDS)) {
        session_destroy();
    }else{
        session_regenerate_id(true);
        $_SESSION["lastActivity"] = time();
    }

    UserManager::connect("root", "", "localhost", "bilderforum");
    ImageManager::connect("root", "", "localhost", "bilderforum");

    if(isset($_GET["site"]) && !empty($_GET["site"]) && $_GET["site"] === "get_new_slider"){
        echo ImageManager::getRandomImagesHTML();
        exit();
    }

    include_once "inc/scripts/scr.head.php";

    $site = "discover";
    if(isset($_GET["site"]) && !empty($_GET["site"])){
        $site = $_GET["site"];
        $site = strtolower($_GET["site"]);
    }


    if(in_array($site, loginNeeded) && (!isset($_SESSION["user"]) || empty($_SESSION["user"]))){
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
                break;
            }
            case "gallery":{
                include "inc/scripts/scr.gallery.php";
                break;
            }

            case "user":{

                include "inc/scripts/scr.user.php";
                break;
            }
            case "discover":{
                include "inc/scripts/scr.discover.php";
                break;
            }
            
            default: {
                header("Location: ./?site=discover");
                exit();
            }

        }
        include_once "inc/scripts/scr.footer.php";
    ?>

</body>

<?php

  UserManager::close();
  ImageManager::close();

?>