<div class="discover_content">
    <h1>Discover</h1>

    <?php
        //Inlcudes the slideshows
    $html = ImageManager::getRandomImagesHTML();
    echo $html;

    ?>

</div>

<button id="load_more">Load more</button>