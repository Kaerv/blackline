<?php 
    $quoteManager = new QuoteManager;
    $quoteManager->sendData($_POST["content"], $_POST['author'], $_POST['categories']);

    class QuoteManager {
        private $mysqli;
        private $content;
        private $author;
        private $categories = array();

        private $validCategories = array();
        private $existingSameAuthorId = 0;

        private $categoriesIds = array();
        private $newAuthorId;
        private $newQuoteId;

        public function __construct() {
            $this->createDBConnection();
        }

        private function createDBConnection() {
            $this->mysqli = new mysqli('localhost', 'blackline', 'K)c#@mc!3', 'blackline');
            if ($this->mysqli->connect_errno) {
                $this->reportError($this->mysqli->connect_error);
            }
            $this->mysqli->query("SET NAMES utf8");
            $this->mysqli->autocommit(FALSE);
        }

        public function sendData($content, $author, $categories) {
            $this->content = $content;
            $this->author = $author;
            $this->categories = $categories;

            $this->validateData();
            $this->addToDatabase();
            $this->endQuoteAdding();
        }

        private function validateData() {
            $this->validateContent();
            $this->validateAuthor();
            $this->validateCategories();
        }

        private function validateContent() {
            $content = $this->content;

            if($content == "") {
                $this->reportError("Content is empty");
            }

            $response = $this->mysqli->query("SELECT quote_id FROM quotes WHERE content = '$content'");
            if($this->mysqli->error)
                $this->reportError("Checking quote failed");
            
            if($response->num_rows != 0) 
                $this->reportError("Quote already exists");
            
        }
        
        private function validateAuthor() {
            $author = $this->author;
            if($author == "") {
                $author = "Autor nieznany";
            }

            $response = $this->mysqli->query("SELECT author_id FROM quotes_authors WHERE author_name = '$author'");
            
            if($this->mysqli->error) {
                $error = $this->mysqli->error;
                $this->reportError("Checking author failed: $error");
            }
            
            if($response->num_rows > 0) {
                while($row = $response->fetch_row()) {
                    $this->existingSameAuthorId = $row[0];
                }
            }
        }
        
        private function validateCategories() {
            if(count($this->categories) == 0) {
                $this->reportError("There is no categories");
            }
            foreach($this->categories as $key => $category) {
                $query = "SELECT category_id FROM quotes_categories WHERE category_name = '$category'";
                $result = $this->mysqli->query($query);
                if(!$result) {
                    $this->reportError("Checking categories failed");
                }

                if($result->num_rows > 0){
                    while($row = $result->fetch_row()) {
                        $this->categoriesIds[] = $row[0];
                    }
                }

                else {
                    $this->validCategories[] = $category;
                }
            }
        }

        private function addToDatabase() {
            $this->addAuthor();
            $this->addCategories();
            $this->addQuote();
            $this->addCategoriesSets();
        }

        private function addAuthor() {
            $query = "INSERT INTO quotes_authors (author_name) VALUES ('$this->author')";
            if(!$this->mysqli->query($query)) {
                $error = $this->mysqli->error;
                $this->reportError("Adding author $author failed: $error;");
            }
            $this->newAuthorId = $this->mysqli->insert_id;
        }

        private function addCategories() {
            foreach($this->validCategories as $category) {
                $query = "INSERT INTO quotes_categories (category_name) VALUES ('$category')";
                if(!$this->mysqli->query($query)) {
                    $this->reportError("Adding category $category failed: $error;");
                }
                $this->categoriesIds[] = $this->mysqli->insert_id;
            }
        }

        private function addQuote() {
            $query = "INSERT INTO quotes (author_id, content) VALUES ($this->newAuthorId, '$this->content')";
            if(!$this->mysqli->query($query)) {
                $error = $this->mysqli->error;
                $this->reportError("Adding quote failed, $error");
            }
            $this->newQuoteId = $this->mysqli->insert_id;
        }

        private function addCategoriesSets() {
            $newQuoteId = $this->newQuoteId;
            foreach($this->categoriesIds as $id) {
                $query = "INSERT INTO quotes_categories_sets(category_id, quote_id) VALUES ($id, $newQuoteId)";
                if(!$this->mysqli->query($query)) {
                    $error = $this->mysqli->error;
                    $this->reportError("Adding categories sets failed, $error");
                }
            }
        }

        private function endQuoteAdding() {
            $this->mysqli->commit();
            $this->mysqli->close();
            echo "0;";
            echo "Quote added;";
        }

        private function reportError($message) {
            echo "-1;";
            echo "$message;";
            $this->mysqli->close();
            die();
        }
    }
?>