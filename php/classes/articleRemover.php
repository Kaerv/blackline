<?php 
    require_once 'quoteManager.php';

    class ArticleRemover extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function removeArticle($id) {
            $this->id = $id;

            $author = $this->checkAuthorIsNecessary();

            $this->removeRecord("`articles`");  

            $this->removeAuthor($author);

            $this->endWork("");
        }

        private function checkAuthorIsNecessary() {
            $id = $this->id;
            $response = $this->mysqli->query("SELECT author_id FROM articles WHERE article_id = $id");
            $this->reportErrorIfOccured();

            $author_id = NULL;
            if($response->num_rows > 0){
                while($row = $response->fetch_row()) {
                    $author_id = $row[0];
                }

                $response = $this->mysqli->query("SELECT article_id FROM articles WHERE author_id = $author_id");
                return $response->num_rows == 1 ? $author_id : NULL;
            }

            else {
                $this->reportError("Can't find author for article id $id");
            }
        }

        private function removeRecord($whence) {
            $id = $this->id;
            $response = $this->mysqli->query("DELETE FROM $whence WHERE article_id = $id");
            
            $this->reportErrorIfOccured();
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Record with id $id to which the query applies doesn't exists");
            }
        }

        private function removeAuthor($id) {
            if(!is_null($id)) {
                $response = $this->mysqli->query("DELETE FROM articles_authors WHERE `author_id` = $id");
                $this->reportErrorIfOccured();
                
                if($this->mysqli->affected_rows == 0) {
                    $this->reportError("Record to which the query applies doesn't exists");
                }
            }
        }
    }
?>