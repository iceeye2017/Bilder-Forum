<main>

    <?php

        $username = filter_input(INPUT_POST, "username",FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "oldPassword",FILTER_SANITIZE_STRING);
        $confpassword = filter_input(INPUT_POST, "newPassword",FILTER_SANITIZE_STRING);
        $oldUsername = $_SESSION["user"]->getUsername();

        if($password == $confpassword && !empty($password))
            UserManager::updatePassword($oldUsername, $password);

        if(!empty($username)){
            
            $_SESSION["user"]->setUsername($username);
            
        }

        if(!empty($_FILES["imageUpload"]))

            $_SESSION["user"]->setImageFromSuperglobal($_FILES["imageUpload"]);

        UserManager::updateUser($_SESSION["user"], $oldUsername);
        
    ?>

    <form name="profileForm" method="post" action="?site=profile" enctype="multipart/form-data">

        <div class = "profilePic">

            <img id="profilePic" src='
            
            <?php 
            
                if($_SESSION["user"]->getImage()){

                    echo "data:".$_SESSION["user"]->getImageType().";base64,".base64_encode($_SESSION["user"]->getImage());

                }else

                    echo "./inc/picture/emptyProfile.png";
            
            ?>' alt="Profile Picture"/>
            
            <div id="profileImage" class="p-image avatar">
                <i class="fa fa-camera upload-button"></i>

            
                <input id="imageUpload" name="imageUpload" class="file-upload" type="file" accept="image/*" onchange="previewFile()"/>
        

            </div>
        </div>

        </div>

        <ul class="userInformation">

            <li>

                <input id="username" name="username" type="text" readonly placeholder='<?php
                
                    echo $_SESSION["user"]->getUsername();
                
                ?>'/>
                <div id="userpen" class="pen"><i id="usernamePen" class="fa fa-solid fa-pen"  onclick="changeUsername()"></i></div>

            </li>

            <li>

                <input id="oldPassword" name ="oldPassword"  type="password" readonly placeholder="Password"/>
                <div id="passpen" class="pen"><i id="passwordPen" class="fa fa-solid fa-pen" onclick="changePassword()"></i></div>
                
            </li>

            <li id = "newPassword">

                <input name = "newPassword" type="password" placeholder="New Password"/>
                <div id="hiddenPen" class="pen"><i class="fa fa-solid fa-pen"></i></div>
                
            </li>

        </ul>

        <div class = "profileButtons">

            <input type="submit"class="button" id ="bcancel" onclick="buttoncancel()" value="Cancel">
            <input type="submit"class="button" id ="bsave" value="Save">

        </div>


    </form> 

</main>