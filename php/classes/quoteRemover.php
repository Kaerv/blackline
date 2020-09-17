<?php 
    require_once 'quoteManager.php';

    class QuoteRemover extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function removeQuote($id) {
            $this->id = $id;

            $author = $this->checkAuthorIsNecessary();
            $categories = $this->checkcategoriesAreNecessary();

            $this->removeRecord("quotes_categories_sets");
            $this->removeRecord("`quotes`");  

            $this->removeAuthor($author);
            $this->removeCategories($categories);

            $this->endWork("");
        }

        private function checkAuthorIsNecessary() {
            $id = $this->id;
            $response = $this->mysqli->query("SELECT author_id FROM quotes WHERE quote_id = $id");
            $this->reportErrorIfOccured();

            $author_id = NULL;
            if($response->num_rows > 0){
                while($row = $response->fetch_row()) {
                    $author_id = $row[0];
                }

                $response = $this->mysqli->query("SELECT quote_id FROM quotes WHERE author_id = $author_id");
                return $response->num_rows == 1 ? $author_id : NULL;
            }

            else {
                $this->reportError("Can't find author for quote id $id");
            }
        }

        private function checkCategoriesAreNecessary() {
            $id = $this->id;
            $response = $this->mysqli->query("SELECT category_id FROM quotes_categories_sets WHERE quote_id = $id");

            $this->reportErrorIfOccured();

            $categories_ids = array();
            while($row = $response->fetch_row()) {
                $categories_ids[] = $row[0];
            }
            $categories_to_delete = array();
            foreach($categories_ids as $id) {
                $response = $this->mysqli->query("SELECT quote_id FROM quotes_categories_sets WHERE category_id = $id");
                if($response->num_rows == 1){
                    $categories_to_delete[] = $id;
                 }
            }
            return $categories_to_delete;
        }

        private function removeRecord($whence) {
            $id = $this->id;
            $response = $this->mysqli->query("DELETE FROM $whence WHERE quote_id = $id");
            
            $this->reportErrorIfOccured();
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Record with id $id to which the query applies doesn't exists");
            }
        }

        private function removeAuthor($id) {
            if(!is_null($id)) {
                if(!$response = $this->mysqli->query("DELETE FROM quotes_authors WHERE `author_id` = $id")) {
                    $this->reportError("Błąd podczas usuwania autora: $this->mysqli->error");
                }

                if($this->mysqli->affected_rows == 0) {
                    $this->reportError("Wystąpił błąd podczas usuwania kategorii: Taki autor nie istnieje");
                }
            }
        }

        private function removeCategories($categories) {
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
    }
?>