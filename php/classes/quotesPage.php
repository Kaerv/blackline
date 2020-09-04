<?php 
    require_once 'quoteManager.php';

    class QuotesPage extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
            $this->categories = array();
            $this->authors = array();
        }

        public function getFiltersData() {
            return array(
                "kategorie" => $this->categories,
                "autorzy" => $this->authors
            );
        }

        public function getQuotes($start) {
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
                quotes_categories_sets.quote_id = quotes.quote_id 
            LIMIT $start, 30";
            $quotes = $this->mysqli->query($query);
            if($this->mysqli->errno) {
                echo $this->mysqli->error;
            }
            else {
                $ready_quotes = array();
                while($quote = $quotes->fetch_assoc()) {
                    $category = $quote["category"];
                    $author = $quote["author"];

                    if(!in_array($category, $this->categories))
                        $this->categories[] = $category;
                    
                    if(!in_array($author, $this->authors))
                        $this->authors[] = $author;

                    $existSameQuote = false;
                    foreach($ready_quotes as $q) {
                        if($quote["id"] == $q["id"]) {
                            $existSameQuote = true;
                            $q["categories"][] = $quote["category"];
                        }
                    }

                    if(!$existSameQuote) {
                        $quote["categories"] = array($quote["category"]);
                        unset($quote["category"]);
                        $ready_quotes[] = $quote;
                    }
                }
                return $ready_quotes;
            }
        }
    }
?>