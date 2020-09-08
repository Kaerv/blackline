<?php 
    require_once 'quoteManager.php';

    class QuotesPageController extends QuoteManager {
        private $start = 0;

        public function __construct($token) {
            parent::__construct($token);
            $this->categories = array();
            $this->authors = array();
        }

        public function initContent($smarty) {
            $filters = $this->prepareFilters();
            $quotes = $this->getQuotes($this->start, $filters);
            $smarty->assign('quotes', $quotes);
            $smarty->assign('filters', $this->getFiltersData());
            $smarty->display("page.tpl");
        }

        private function prepareFilters() {
            if($_GET["q"]) {
                $q = $_GET["q"];
                $filters = explode("/", $q);

                $parsedFilters = "";
                foreach($filters as $filter) {
                    $parsedFilters .= $this->prepareFiltersQuery($filter);
                }

                return $parsedFilters;
            }

            else return "";
        }

        private function prepareFiltersQuery($filter) {
            $f = explode("-", $filter);
            $result = " AND ";
            switch($f[0]) {
                case "kategoria": $result .= "quotes_categories.category_name"; break;
                case "autor": $result .= "quotes_authors.author_name"; break;
            }

            $filterValue = $f[1];
            $result .= " = '$filterValue' ";
            return $result;
        }

        private function getFiltersData() {
            return array(
                "kategoria" => $this->getAllValues("category_name", "quotes_categories"),
                "autor" => $this->getAllValues("author_name", "quotes_authors")
            );
        }
        
        private function getAllValues($value, $table) {
            $result = array();
            $query = "SELECT $value FROM $table";

            $rows = $this->mysqli->query($query);
            if($this->mysqli->errno) 
                echo $this->mysqli->error;
            
            while($row = $rows->fetch_array()) 
                $result[] = $row[0];

            return $result;
        }

        public function getQuotes($start, $filters) {
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
                $filters
            LIMIT $start, 25";

            $quotes = $this->mysqli->query($query);
            if($this->mysqli->errno) {
                echo $this->mysqli->error;
            }
            else {
                $ready_quotes = array();
                while($quote = $quotes->fetch_assoc()) {

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