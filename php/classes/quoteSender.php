<?php 
    require_once 'quoteManager.php';

    class QuoteSender extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function sendQuote($data) {
            $this->content = $data["content"];
            $this->author = $data["author"];
            $this->translation = $data["translation"];
            $this->categories = $data["categories"];

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
            $stmt = $this->mysqli->prepare("SELECT quote_id FROM quotes WHERE content = ?");
            $stmt->bind_param('s', $content);
            $stmt->execute();
            $stmt->store_result();
            $this->reportErrorIfOccured();
            
            if($stmt->num_rows != 0) 
                $this->reportError("Quote already exists");
            
        }
        
        private function validateAuthor() {
            $author = $this->author;
            $stmt = $this->mysqli->prepare("SELECT author_id FROM quotes_authors WHERE author_name = ?");
            $stmt->bind_param("s", $author);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $this->reportErrorIfOccured();
            
            if($result->num_rows > 0) {
               while($row = $result->fetch_row()) {
                    $this->existingSameAuthorId = $row[0];
                }
            }
        }
        
        private function validateCategories() {
            if(count($this->categories) == 0) {
                $this->reportError("There is no categories");
            }
            foreach($this->categories as $key => $category) {
                $stmt = $this->mysqli->prepare("SELECT category_id FROM quotes_categories WHERE category_name = ?");
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $result = $stmt->get_result();
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
                $stmt = $this->mysqli->prepare("INSERT INTO quotes_authors (author_name) VALUES (?)");
                $stmt->bind_param('s', $this->author);

                if(!$stmt->execute()) {
                    $error = $this->mysqli->error;
                    $this->reportError("Adding author $author failed: $error;");
                }
                $this->newAuthorId = $stmt->insert_id;
            }

            else {
                $this->newAuthorId = $this->existingSameAuthorId;
            }

        }

        private function addCategories() {
            foreach($this->validCategories as $category) {
                $stmt = $this->mysqli->prepare("INSERT INTO quotes_categories (category_name) VALUES (?)");
                $stmt->bind_param('s', $category);

                if(!$stmt->execute()) {
                    $this->reportError("Adding category $category failed: $error;");
                }
                $this->categoriesIds[] = $stmt->insert_id;
            }
        }

        private function addQuote() {
            $stmt = $this->mysqli->prepare("INSERT INTO quotes (author_id, content, translation) VALUES (?, ?, ?)");
            $stmt->bind_param('iss', $this->newAuthorId, $this->content, $this->translation);
            if(!$stmt->execute()) {
                $error = $this->mysqli->error;
                $this->reportError("Adding quote failed, $error");
            }
            $this->newQuoteId = $stmt->insert_id;
        }

        private function addCategoriesSets() {
            $newQuoteId = $this->newQuoteId;
            foreach($this->categoriesIds as $id) {
                $stmt = $this->mysqli->prepare("INSERT INTO quotes_categories_sets(category_id, quote_id) VALUES (?, ?)");
                $stmt->bind_param('ii', $id, $newQuoteId);
                if(!$stmt->execute()) {
                    $error = $this->mysqli->error;
                    $this->reportError("Adding categories sets failed, $error");
                }
            }
        } 
    }
?>