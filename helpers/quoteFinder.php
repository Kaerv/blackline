<?php 
     require_once 'quoteManager.php';

     class QuoteFinder extends QuoteManager {
         public function __construct($data) {
             parent::__construct();

             $this->phrase = $data["phrase"];
             $this->byContent = $data["byContent"];
             $this->byAuthor = $data["byAuthor"];
             $this->byCategory = $data["byCategory"];

             $this->findQuotes();
         }
 
         public function findQuotes() {
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
                 quotes_categories_sets.quote_id = quotes.quote_id AND (";
            
            $criteria = array();
            if($this->byContent == "true"){
                $criteria[] = "quotes.content LIKE '%$this->phrase%'";
            }
                
            if($this->byAuthor == "true") {
                $criteria[] = "quotes_authors.author_name LIKE '%$this->phrase%'";
            }
                
            if($this->byCategory == "true") {
                $criteria[] = "quotes_categories.category_name LIKE '%$this->phrase%'";
            }
            
            $i = 0;
            foreach($criteria as $c) {
                if($i != 0) {
                    $query .= "OR";
                }
                $query .= " $c ";
                $i++;
            }
            
            $query .= ") LIMIT 20";
         
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
                 echo "$id;$content;$author;$category;$dateAdded;$visitDaily;$visitMonthly;$visitYearly*";
            }
         }
     }
 
     $finder = new QuoteFinder($_GET["data"]);

?>