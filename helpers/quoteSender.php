<?php 
    require_once 'quoteManager.php';

    class QuoteSender extends QuoteManager {
        public function __construct($data) {
            parent::__construct();
            
            $this->content = $data["content"];
            $this->author = $data["author"];
            $this->categories = $data["categories"];

            $this->sendQuote();
        }

        private function sendQuote() {
            $this->validateData();
            $this->addToDatabase();
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
                
            }
            echo $author;
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
            $this->endWork("");
        }

        private function addAuthor() {
            if(!isset($this->existingSameAuthorId)) {
                $query = "INSERT INTO quotes_authors (author_name) VALUES ('$this->author')";
                if(!$this->mysqli->query($query)) {
                    $error = $this->mysqli->error;
                    $this->reportError("Adding author $author failed: $error;");
                }
                $this->newAuthorId = $this->mysqli->insert_id;
            }

            else {
                $this->newAuthorId = $this->existingSameAuthorId;
            }

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

        
    }

    $sender = new QuoteSender($_POST["data"]);
?>