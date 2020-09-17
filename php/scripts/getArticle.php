<?php 
    require_once "../classes/resourcesGetter.php";
    $getter = new ResourcesGetter($_GET["token"]);
    $start = $_GET["start"];
    $query = 
            "SELECT 
                articles.article_id AS id,
                articles_authors.author_name AS author,
                articles.title AS title,
                articles.date_added AS date_added,
                articles.date_publication AS date_publication,
                articles.visit_daily AS visit_daily,
                articles.visit_monthly AS visit_monthly,
                articles.visit_yearly AS visit_yearly
            FROM 
                articles, articles_authors
            WHERE
                articles.author_id = articles_authors.author_id
            ORDER BY 
                articles.date_added
            LIMIT $start, 25";

    $resources = $getter->getResources($query);
    while($resource = $resources->fetch_assoc()) {
        $id = $resource["id"];
        $author = $resource["author"];
        $visitDaily = $resource["visit_daily"];
        $visitMonthly = $resource["visit_monthly"];
        $visitYearly = $resource["visit_yearly"];
        $dateAdded = $resource["date_added"];
        $title = $resource["title"];
        $datePublication = $resource["date_publication"];
        echo "$id|$author|$dateAdded|$visitDaily|$visitMonthly|$visitYearly|$title|$datePublication*";
    }
?> 
