<?php

    require_once "inc/classes/class.User.php";
    require_once "inc/classes/class.UserManager.php";

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