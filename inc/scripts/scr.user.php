<?php

    //Check if user exists 

    if(empty($_GET["user"]))
        header("Location:index.php");
    else
        $user = UserManager::getUser($_GET["user"]);



?>
<div class = "user">

    <div class = "upicUname">

        <img id="uPic" src='
                
        <?php 
        
            if($user->getImage()){

                echo "data:".$user->getImageType().";base64,".base64_encode($user->getImage());

            }else

                echo "./inc/picture/emptyProfile.png";
                
        ?>' alt="Profile Picture"/>

        

        <h2><?php echo $user->getUsername(); ?></h2>

    </div>

    
    <div class="slider" <?php 
    if(empty(ImageManager::getImagesFromUser($user->getId()))) 
        echo "style='display:none'";
    ?>>
        <div class="slideshow-container">
            <?php

                foreach(ImageManager::getImagesFromUser($user->getId()) as $key => $value){

                    echo "<div class='slide'>
                        <img src=".ImageManager::getImagePath($value)." style='width:100%'>
                    </div>";
            
                }           

            ?>
            
            <a class="ctrl prev">&#10094;</a>
            <a class="ctrl next">&#10095;</a>
            <div class="dots"></div>
        </div>
    </div>
    

</div>