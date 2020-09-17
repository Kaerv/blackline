<?php 
    require_once "../classes/resourcesGetter.php";
    $getter = new ResourcesGetter($_GET["token"]);
    $getter->getResourcesCount("article");
?> 