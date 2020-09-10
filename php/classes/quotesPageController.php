<?php 
    require_once 'quoteManager.php';

    class QuotesPageController extends QuoteManager {

        public function __construct($token) {
            parent::__construct($token);
            $this->categories = array();
            $this->authors = array();
        }

        public function initContent($smarty, $start) {
            $filters = $this->prepareFilters();
            $quotes = $this->getQuotes($start, $filters);

            $smarty->assign('quotes', $quotes);
            $smarty->assign('filters', $this->getFiltersData());
            $smarty->assign('selectedFilter', (isset($this->selectedFilter)? $this->selectedFilter : 0));
            $smarty->display("page.tpl");
        }

        public function getQuotesCount() {
            $filters = $this->prepareFilters();
            $count = 0;
            
            $query = "SELECT COUNT(DISTINCT quotes.quote_id)
            FROM quotes, quotes_authors, quotes_categories, quotes_categories_sets
            WHERE 
                quotes.author_id = quotes_authors.author_id AND 
                quotes_categories_sets.category_id = quotes_categories.category_id AND 
                quotes_categories_sets.quote_id = quotes.quote_id
                $filters
            ";

            $rows = $this->mysqli->query($query);
            if($this->mysqli->errno) 
                echo $this->mysqli->error;

            $row = $rows->fetch_array();
            $count = $row[0];

            
            return $count;
        }

        public function prepareFilters() {
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
            $f = explode(":", $filter);
            $this->selectedFilter = array($f[0], $f[1]);
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
            $query = "SELECT $value FROM $table ORDER BY $value";

            $rows = $this->mysqli->query($query);
            if($this->mysqli->errno) 
                echo $this->mysqli->error;
            
            while($row = $rows->fetch_array()) 
                $result[] = $row[0];

            return $result;
        }

        public function getQuotes($start, $filter) {
            $ready_quotes = array();
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
                $filter
                ORDER BY quotes.date_added
            LIMIT $start, 25";

            $quotes = $this->mysqli->query($query);
            if($this->mysqli->errno) {
                echo $this->mysqli->error;
                exit();
            }
            while($quote = $quotes->fetch_assoc()) {

                $existSameQuote = false;
                foreach($ready_quotes as $q) {
                    $existSameQuote = ($quote["id"] == $q["id"]) ? true : $existSameQuote;
                }

                if(!$existSameQuote) {
                    $quote["author"] .= ($quote["author"] == "")? "Autor nieznany" : "";
                    $ready_quotes[] = $this->getQuoteCategories($quote);
                }
            }
            return $ready_quotes;
        }

        private function getQuoteCategories($quote) {
            unset($quote["category"]);
            $quote["categories"] = array();
            $id = $quote["id"];
            $query = 
            "SELECT 
                category_name 
            FROM 
                quotes_categories, quotes, quotes_categories_sets 
            WHERE 
                quotes.quote_id = $id AND 
                quotes_categories_sets.category_id = quotes_categories.category_id AND 
                quotes_categories_sets.quote_id = quotes.quote_id";

            $categories = $this->mysqli->query($query);
            if($this->mysqli->errno) {
                echo $this->mysqli->error;
                exit();
            }
            while($category = $categories->fetch_array()) {
                $quote["categories"][] = $category[0];
            }
            return $quote;
        }
    }
?>