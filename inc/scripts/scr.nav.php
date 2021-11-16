<body>

    <nav>
        
        <div class = "logo">

           <a href="#">Picture Forum</a>

        </div>

    
                
        <ul class = nav-elements>

            <li><a href="?site=discover">Discover</a></li>

            <li <?php echo empty($_SESSION["user"]) ? "style='display:none'":" "?>><a href="?site=gallery">Gallery</a></li>

            <li <?php echo empty($_SESSION["user"]) ? "style='display:none'":" "?>><a href="?site=profile">Profile</a></li>
            
            <!-- Login Icon -->

            <li class="loginIcon">
                <div>
                
                    <?php

                        if(!isset($_SESSION["user"])){
                             
                    ?>
                    <a href="?site=login"><i class="fas fa-sign-in-alt"></i>Login</a>

                    <?php

                        }else{

                    ?>
                    <a href="?site=logout"><i class="fas fa-sign-in-alt"></i>Logout</a>
            
                    <?php

                        }

                    ?>

                </div>
            </li>

            
    
        </ul>

        




        <div class= "burger">

            <div class = "line1"></div>
            <div class = "line2"></div>
            <div class = "line3"></div>

        </div>
        

    </nav>
    