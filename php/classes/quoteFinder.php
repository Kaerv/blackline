<?php 
     require_once 'quoteManager.php';

     class QuoteFinder extends QuoteManager {
         public function __construct($token) {
             parent::__construct($token);
         }
 
         public function findQuotes($data) {
            $this->phrase = $data["phrase"];

             $query = 
             "SELECT 
                 quotes.quote_id AS id, 
                 quotes.content AS content, 
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
                 quotes_categories_sets.quote_id = quotes.quote_id AND (
                     quotes.content LIKE '%$this->phrase%' OR 
                     quotes_authors.author_name LIKE '%$this->phrase%' OR
                     quotes_authors.author_name LIKE '%$this->phrase%') LIMIT 20";
                            
             $quotes = $this->mysqli->query($query);
             while($quote = $quotes->fetch_assoc()) {
                 $id = $quote["id"];
                 $content = $quote["content"];
                 $author = $quote["author"];
                 $category = $quote["category"];
                 $dateAdded = $quote["date_added"];
                 $visitDaily = $quote["visit_daily"];
                 $visitMonthly = $quote["visit_monthly"];
                 $visitYearly = $quote["visit_yearly"];
                 echo "$id|$content|$author|$category|$dateAdded|$visitDaily|$visitMonthly|$visitYearly*";
            }
         }
     }
?>