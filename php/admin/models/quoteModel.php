<?php
    require_once "model.php";

    class QuoteModel extends Model {
        public function __construct() {
            parent::__construct();
        }

        public function getRecords($start, $step) {
            $query = "SELECT 
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded, 
                quotes.visit_daily AS visitDaily, 
                quotes.visit_monthly AS visitMonthly, 
                quotes.visit_yearly AS visitYearly 
            FROM quotes, quotes_authors 

            WHERE 
                quotes.author_id = quotes_authors.author_id
            ORDER BY quotes.date_added
            LIMIT $start, $step";

            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $results = array();
            while($row = $result->fetch_object()) {
                $row->categories = $this->getCategoriesByQuoteId($row->id);
                $results[] = $row;
            }
            
            return $results;
        }

        public function getAllCount() {
            $query = "SELECT COUNT(*) AS c FROM quotes";
            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $c = $result->fetch_assoc();
            return $c["c"];
        }

        public function existsQuoteWithContent($content) {
            $stmt = $this->mysqli->prepare("SELECT quote_id FROM quotes WHERE content = ?");
            $stmt->bind_param('s', $content);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił problem podczas wyszukiwania cytatu.");
                return false;
            }
            $result = $stmt->store_result();
        
            return $stmt->num_rows != 0;
        }

        public function getQuoteWithId($id) {
            $query = "SELECT 
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_id AS authorId,
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded, 
                quotes.visit_daily AS visitDaily, 
                quotes.visit_monthly AS visitMonthly, 
                quotes.visit_yearly AS visitYearly 
            FROM quotes, quotes_authors 

            WHERE 
                quotes.author_id = quotes_authors.author_id AND
                quote_id = ?";
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError($stmt->error);
                return false;
            }

            $result = $stmt->get_result();
            if($result->num_rows == 0) 
                return false;
            
            $row = $result->fetch_object();
            $row->categories = $this->getCategoriesByQuoteId($row->id);
           
            return $row;
        }

        public function getAuthorIdByName($author) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM quotes_authors WHERE author_name = ?");
            $stmt->bind_param("s", $author);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$stmt)
                $this->reportError("Błąd sprawdzania autora.");

            if($result->num_rows > 0) {
                $row = $result->fetch_row();
                return $row[0];
            }
            else return false;
        }

        public function getCategoriesByQuoteId($id) {
            $categories = array();
            $query = "SELECT
                quotes_categories.category_name AS category
            FROM 
                quotes_categories, quotes_categories_sets, quotes 
            WHERE
                quotes_categories_sets.category_id = quotes_categories.category_id AND
                quotes.quote_id = quotes_categories_sets.quote_id AND
                quotes.quote_id = $id";

            if(!$categories_result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            while($category = $categories_result->fetch_array()) {
                $categories[] = $category[0];
            }
            return $categories;
        }

        public function getCategoryIdByName($category) {
            $stmt = $this->mysqli->prepare("SELECT category_id FROM quotes_categories WHERE category_name = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result) {
                $this->reportError("Błąd sprawdzania kategorii.");
            }

            if($result->num_rows > 0){
                $row = $result->fetch_row();
                return $row[0];
            }

            else return false;
        }

        public function AddAuthor($author) {
            $stmt = $this->mysqli->prepare("INSERT INTO quotes_authors (author_name) VALUES (?)");
            $stmt->bind_param('s', $author);

            if(!$stmt->execute()) {
                $this->reportError("Dodawanie autora nie powiodło się: $stmt->error.");
                return false;
            }

            return $stmt->insert_id;
        }

        public function addCategory($category) {
            $stmt = $this->mysqli->prepare("INSERT INTO quotes_categories (category_name) VALUES (?)");
                $stmt->bind_param('s', $category);

                if(!$stmt->execute()) {
                    $this->reportError("Nie udało się dodać kategorii: $stmt->error;");
                    return false;
                }
                return $stmt->insert_id;
        }

        public function addQuote($content, $translation, $authorId, $categoriesIds) {
            $stmt = $this->mysqli->prepare("INSERT INTO quotes (author_id, content, translation) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $authorId, $content, $translation);
            if(!$stmt->execute()) {
                $this->reportError("Dodawanie cytatu nie powiodło się: $stmt->error");
                return false;
            }
            $newQuoteId = (int)$stmt->insert_id;

            $this->addCategoriesSets($newQuoteId, $categoriesIds);
        }

        private function addCategoriesSets($quoteId, $categoriesIds) {
            foreach($categoriesIds as $id) {
                $stmt = $this->mysqli->prepare("INSERT INTO quotes_categories_sets(category_id, quote_id) VALUES (?, ?)");
                $stmt->bind_param('ii', $id, $quoteId);
                if(!$stmt->execute()) {
                    $this->reportError("Tworzenie powiązania między kategoriami a cytatmie nie powiodło się: $stmt->error");
                    return false;
                }
            }
            return true;
        }

        public function checkAuthorIsNecessary($id) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM quotes WHERE quote_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Błąd wyszukiwania autora cytatu.");
                return false;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $author_id = NULL;
                while($row = $result->fetch_row()) {
                    $author_id = $row[0];
                }

                $result = $this->mysqli->query("SELECT quote_id FROM quotes WHERE author_id = $author_id");
                return $result->num_rows == 1 ? $author_id : false;
            }

            else {
                $this->reportError("Nie można znaleźć autora cytatu o id: $id");
                return false;
            }
        }

        public function checkCategoriesAreNecessary($id) {
            $stmt = $this->mysqli->prepare("SELECT category_id FROM quotes_categories_sets WHERE quote_id = ?");
            $stmt->bind_param('i', $id);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił problem z wczytaniem kategorii należących do cytatu.");
                return false;
            }
            $result = $stmt->get_result();
            $categories_ids = array();
            while($row = $result->fetch_row()) {
                $categories_ids[] = $row[0];
            }
            $categories_to_delete = array();
            foreach($categories_ids as $id) {
                $result = $this->mysqli->query("SELECT quote_id FROM quotes_categories_sets WHERE category_id = $id");
                if($result->num_rows == 1){
                    $categories_to_delete[] = $id;
                 }
            }
            return $categories_to_delete;
        }

        public function removeCategoriesSets($id) {
            $stmt = $this->mysqli->prepare("DELETE FROM quotes_categories_sets WHERE quote_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił błąd podczas usuwania kategorii.");
                return false;
            }
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Wystąpił błąd podczas usuwania kategorii: Powiązanie kategorii z cytatem, którego dotyczy żądanie nie istnieje.");
            }
        }

        public function removeQuote($id) {
            $stmt = $this->mysqli->prepare("DELETE FROM quotes WHERE quote_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił błąd podczas usuwania cytaty.");
                return false;
            }
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Wystąpił błąd podczas usuwania cytatu: Cytat którego dotyczy żądanie nie istnieje.");
                return false;
            }
        }

        public function removeCategories($categories) {
            foreach($categories as $id) {
                $stmt = $this->mysqli->prepare("DELETE FROM quotes_categories WHERE `category_id` = ?");
                $stmt->bind_param("i", $id);
                if(!$stmt->execute()) {
                    $this->reportError("Wystąpił błąd podczas usuwania kategorii: Taka kategoria nie istnieje.");
                    return false;
                }
                
                if($this->mysqli->affected_rows == 0) {
                    $this->reportError("Wystąpił błąd podczas usuwania kategorii: Powiązanie kategoria której dotyczy żądanie nie istnieje.");
                    return false;
                }
            }
        }

        public function removeAuthor($id) {
            if(!is_null($id)) {
                $stmt = $this->mysqli->prepare("DELETE FROM quotes_authors WHERE author_id = ?");
                $stmt->bind_param("i", $id);
                if(!$stmt->execute()) {
                    $this->reportError("Błąd podczas usuwania autora: ".$this->mysqli->error);
                    return false;
                }

                if($stmt->affected_rows == 0) {
                    $this->reportError("Wystąpił błąd podczas usuwania autora: Taki autor nie istnieje");
                }
            }
        }

        public function findQuotesByPhrase($phrase) {
            $phrase = "%$phrase%";
            $query = "SELECT 
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded, 
                quotes.visit_daily AS visitDaily, 
                quotes.visit_monthly AS visitMonthly, 
                quotes.visit_yearly AS visitYearly 
            FROM quotes, quotes_categories_sets, quotes_categories, quotes_authors 

            WHERE 
                quotes.author_id = quotes_authors.author_id AND 
                quotes_categories_sets.category_id = quotes_categories.category_id AND 
                quotes_categories_sets.quote_id = quotes.quote_id AND (
                    quotes.content LIKE ? OR 
                    quotes_authors.author_name LIKE ? OR
                    quotes_categories.category_name LIKE ?) LIMIT 50";

            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param("sss", $phrase, $phrase, $phrase);
            if(!$stmt->execute()) {
                $this->reportError($stmt->error);
                return false;
            }

            $result = $stmt->get_result();
            $results = array();
            while($row = $result->fetch_object()) {
                $row->categories = $this->getCategoriesByQuoteId($row->id);
                $results[] = $row;
            }
            return $results;
        }
    }
?>