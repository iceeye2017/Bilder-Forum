<?php

    require_once "inc/classes/class.User.php";
    require_once "inc/classes/class.UserManager.php";

    include_once "inc/scripts/scr.head.php";
  
    UserManager::connect("root", "", "localhost", "bilderforum");

?>
<body>


    <?php

        include_once "inc/scripts/scr.nav.php";
        include_once "inc/scripts/scr.slider.php";
        include_once "inc/scripts/scr.slider.php";
        include_once "inc/scripts/scr.footer.php";

    ?>

</body>

<?php

  UserManager::close();

?>