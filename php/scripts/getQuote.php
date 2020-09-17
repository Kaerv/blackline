<?php 
    require_once "../classes/resourcesGetter.php";
    $getter = new ResourcesGetter($_GET["token"]);
    $start = $_GET["start"];
    $query = 
    "SELECT 
        quotes.quote_id AS id, 
        quotes.content AS content, 
        quotes.translation AS translation, 
        quotes_authors.author_name AS author, 
        quotes_categories.category_name AS category, 
        quotes.date_added AS date_added, 
        quotes.visit_daily AS visit_daily, 
        quotes.visit_monthly AS visit_monthly, 
        quotes.visit_yearly AS visit_yearly 
    FROM quotes, quotes_categories_sets, quotes_categories, quotes_authors 

    WHERE 
        quotes.author_id = quotes_authors.author_id AND 
        quotes_categories_sets.category_id = quotes_categories.category_id AND 
        quotes_categories_sets.quote_id = quotes.quote_id 
    ORDER BY quotes.date_added
    LIMIT $start, 25";

    $resources = $getter->getResources($query);
    while($resource = $resources->fetch_assoc()) {
        $id = $resource["id"];
        $author = $resource["author"];
        $visitDaily = $resource["visit_daily"];
        $visitMonthly = $resource["visit_monthly"];
        $visitYearly = $resource["visit_yearly"];
        $dateAdded = $resource["date_added"];
        $content = $resource["content"];
        $translation = $resource["translation"];
        $category = $resource["category"];
        echo "$id|$author|$dateAdded|$visitDaily|$visitMonthly|$visitYearly|$content|$translation|$category*";
    }
?> 
