<?php
    require_once "model.php";

    class QuoteModel extends Model {
        public function __construct() {
            parent::__construct();
            $this->dbName = "quotes";
            $this->type = "quote";
        }

        public function getRecords($start, $step, $order = "quotes.date_added", $filters = array(), $customer_id) {
            $filter = "";
            if(count($filters)) {
                $filter .= "AND (";
                if(isset($filters["autorzy"]) && count($filters["autorzy"])) {
                    $filter .= "quotes_authors.author_name IN (";
                    foreach($filters["autorzy"] as $i=>$author) {
                        if($author == "Autor nieznany")
                            $author = "";
                        if($i != 0) {
                            $filter .= ", ";
                        }
                        $filter .= "'$author'";
                    }
                    $filter .= ")";
                }

                if(isset($filters["kategorie"]) && count($filters["kategorie"])) {
                    if(isset($filters["autorzy"]) && count($filters["autorzy"]))
                        $filter .= " AND ";
                    $filter .= "quotes_categories.category_name IN (";

                    foreach($filters["kategorie"] as $i=>$category) {
                        if($i != 0) {
                            $filter .= ", ";
                        }
                        $filter .= "'$category'";
                    }
                    $filter .= ")";
                }
                $filter .= ")";
            }

            $query = "SELECT DISTINCT
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded,
                (SELECT COUNT(like_id) FROM likes WHERE likes.quote_id = id) AS likes
            FROM quotes, quotes_authors, quotes_categories, quotes_categories_sets

            WHERE 
                quotes.author_id = quotes_authors.author_id AND
                quotes_categories_sets.quote_id = quotes.quote_id AND
                quotes_categories_sets.category_id = quotes_categories.category_id
                $filter
            ORDER BY $order 
            LIMIT $start, $step";

            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }
            
            $results = array();
            while($row = $result->fetch_assoc()) {
                $row['categories'] = $this->getCategoriesByQuoteId($row['id']);
                $results[] = $row;
            }


            if($customer_id) {
                foreach($results as $key=>$value) {
                    $quote_id = $value["id"];
                    $query = "SELECT COUNT(*) as liked from likes WHERE likes.customer_id = $customer_id AND likes.quote_id = $quote_id";
                    if(!$res = $this->mysqli->query($query)) {
                        $this->reportError($this->mysqli->error);
                        return false;
                    }
                    $liked = $res->fetch_assoc();
                    $results[$key]["liked"] = $liked["liked"];
                }
            }
            
            return $results;
        }

        public function getAllAuthors() {
            $query = "SELECT 
                quotes_authors.author_name AS name
            FROM quotes_authors WHERE 1
            ORDER BY author_name";

            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $results = array();
            while($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
            
            return $results;
        }

        public function getBestAuthors() {
            $query = "SELECT 
                quotes_authors.author_id AS id,
                (SELECT COUNT(like_id) as l FROM likes, quotes WHERE likes.quote_id = quotes.quote_id AND quotes.author_id = id) AS likes
                
            FROM quotes_authors, quotes 

            WHERE quotes.author_id = quotes_authors.author_id
            GROUP BY id ORDER BY likes DESC";

        if(!$result = $this->mysqli->query($query)) {
            $this->reportError($this->mysqli->error);
            return false;
        }

        $results = array();
        while($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $query = "SELECT author_name AS name FROM quotes_authors WHERE author_id = $id";
            if(!$r = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }
            $author = $r->fetch_assoc();
            $results[] = $author;
        }
        
        return array_slice($results, 0, 8);
        }

        public function getQuoteById($id) {
            $query = "SELECT 
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded, 
                COUNT(like_id) AS likes
            FROM quotes, quotes_authors, quotes_categories, quotes_categories_sets, likes

            WHERE 
                quotes.author_id = quotes_authors.author_id AND
                quotes_categories_sets.quote_id = quotes.quote_id AND
                quotes_categories_sets.category_id = quotes_categories.category_id AND
                quotes.quote_id = $id
                ";

            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }
            
            $row = $result->fetch_assoc();
            $row['categories'] = $this->getCategoriesByQuoteId($row['id']);
            $result = $row;
            
            return $result;
        }

        public function findCategories($phrase) {
            $query = "SELECT DISTINCT
                quotes_categories.category_name AS name
            FROM quotes_categories
            WHERE  category_name LIKE '%$phrase%'
            ORDER BY category_name";
            
        if(!$result = $this->mysqli->query($query)) {
            $this->reportError($this->mysqli->error);
            return false;
        }

        $results = array();
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        
        return $results;
        }

        public function findFilters($args) {
            $phrase = $args["phrase"];
            $singular = $args["singular"];
            $plural = $args["plural"];
            $query = "SELECT DISTINCT ".$singular."_name AS name
            FROM quotes_".$plural."
            WHERE  ".$singular."_name LIKE '%$phrase%'
            ORDER BY ".$singular."_name";
            
        if(!$result = $this->mysqli->query($query)) {
            $this->reportError($this->mysqli->error);
            return false;
        }

        $results = array();
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        
        return $results;
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

        public function findByPhrase($phrase) {
            $phrase = "%$phrase%";
            $query = "SELECT 
                quotes.quote_id AS id, 
                quotes.content AS content, 
                quotes.translation AS translation, 
                quotes_authors.author_name AS author, 
                quotes.date_added AS dateAdded, 
                COUNT(like_id) AS likes
            FROM quotes, quotes_categories_sets, quotes_categories, quotes_authors, likes

            WHERE 
                quotes.author_id = quotes_authors.author_id AND 
                quotes_categories_sets.category_id = quotes_categories.category_id AND 
                quotes_categories_sets.quote_id = quotes.quote_id AND (
                    quotes.content LIKE ? OR 
                    quotes.translation LIKE ? OR
                    quotes_authors.author_name LIKE ? OR
                    quotes_categories.category_name LIKE ?) LIMIT 500";

            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param("ssss", $phrase, $phrase, $phrase, $phrase);
            if(!$stmt->execute()) {
                $this->reportError("Błąd podczas wyszukiwania: $stmt->error");
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

        public function like($args) {
            $response = array();
            $customer_id = $args["customer_id"];
            $quote_id = $args["quote_id"];

            $query = "SELECT COUNT(*) as is_liked FROM likes WHERE customer_id = $customer_id AND quote_id = $quote_id";
            if(!$result = $this->mysqli->query($query)){
                $this->reportError($this->mysqli->error);
                return false;
            }
            $liked = $result->fetch_array()["is_liked"];

            if($liked) {
                $query = "DELETE FROM likes WHERE customer_id = $customer_id AND quote_id = $quote_id";
                if(!$result = $this->mysqli->query($query)){
                    $this->reportError($this->mysqli->error);
                    return false;
                }
                $response["liked"] = false;
            }

            else {
                $query = "INSERT INTO likes (customer_id, quote_id) VALUES ($customer_id, $quote_id)";
                if(!$result = $this->mysqli->query($query)){
                    $this->reportError($this->mysqli->error);
                    return false;
                }
                $response["liked"] = true;
            }

            $query = "SELECT COUNT(*) as likes FROM likes WHERE quote_id = $quote_id";
                if(!$result = $this->mysqli->query($query)){
                    $this->reportError($this->mysqli->error);
                    return false;
                }
                $likes = $result->fetch_array()["likes"];
                $response["likes"] = $likes;
                return $response;
        }
    }
?>