<?php

if(isset($_POST["submit"]) && isset($_FILES["imageUpload"]) && isset($_SESSION["user"])){
    $image = $_FILES["imageUpload"];
    ImageManager::saveImageFromSuperglobal($image, $_SESSION["user"]->getId());
}

?>

<form id="gallery_form" method="post" action="?site=gallery" enctype="multipart/form-data">
    <input id="imageUpload" name="imageUpload" class="button" type="file" accept="image/*" data-buttonText="Add image"/>
    <input name="submit" type="submit" style="margin-left: 5px;" class="button" />
</form>

<div class="images">

<?php

// TODO: Search for username if in get params
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
    $images = ImageManager::getImagesFromUser($user->getId());
    foreach($images as $image){
        $path = ImageManager::getImagePath($image);
        echo <<<EOM
        <div class="image">
            <img src="$path" alt="Image" />
        </div>
EOM;
    }
}

?>

</div>