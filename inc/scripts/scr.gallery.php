<form id="gallery_form" method="post" action="?site=gallery" enctype="multipart/form-data">
    <input id="imageUpload" name="imageUpload" class="button" type="file" accept="image/*" data-buttonText="Add image"/>
</form>

<?php

// TODO: Search for username if in get params
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $images = ImageManager::getImagesFromUser($user);
    foreach($images as $image){
        $path = ImageManager::getImagePath($image);
        echo <<<EOM
        <img src="$path" alt="Image" />
EOM;
    }
}

?>