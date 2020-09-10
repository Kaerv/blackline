<?php 
    require_once "../../classes/quotesPageController.php";
    $controller = new QuotesPageController($_GET["token"]);

    if($_GET["query"] == "quotes") {
        $filters = $controller->prepareFilters();
        $quotes = $controller->getQuotes($_GET["start"], $filters);
    
        foreach($quotes as $quote) {
            $id = $quote["id"];
            $content = $quote["content"];
            $author = $quote["author"];
            $dateAdded = $quote["date_added"];
            $visitDaily = $quote["visit_daily"];
            $visitMonthly = $quote["visit_monthly"];
            $visitYearly = $quote["visit_yearly"];
    
            $categories = "";
            foreach($quote["categories"] as $category) {
                $categories .= "$category@";
            }
            $categories = substr($categories, 0, -1);
            
            echo "$id|$content|$author|$categories|$dateAdded|$visitDaily|$visitMonthly|$visitYearly*";
        }
    }
    else if($_GET["query"] == "count") {
        $count = $controller->getQuotesCount();
        print($count);
    }

?>