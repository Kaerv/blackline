<?php 
    require_once 'quoteManager.php';

    class ArticleSender extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function sendArticle($data) {
            $this->title = $data["title"];
            $this->content = $data["content"];
            $this->author = $data["author"];
            $this->publication = $data["publication"];

            $this->validateData();
            $this->addToDatabase();
        }
        private function validateData() {
            $this->validateTitle();
            $this->validateContent();
            $this->validateAuthor();
        }

        private function validateTitle() {
            $title = $this->title;

            if($title == "") {
                $this->reportError("Title is empty");
            }
            $stmt = $this->mysqli->prepare("SELECT article_id FROM articles WHERE content = ?");
            $stmt->bind_param('s', $title);
            $stmt->execute();
            $stmt->store_result();
            $this->reportErrorIfOccured();
            
            if($stmt->num_rows != 0) 
                $this->reportError("Article already exists");
        }

        private function validateContent() {
            $content = $this->content;

            if($content == "") {
                $this->reportError("Content is empty");
            }
        }
        
        private function validateAuthor() {
            $author = $this->author;
            $stmt = $this->mysqli->prepare("SELECT author_id FROM articles_authors WHERE author_name = ?");
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

        private function addToDatabase() {
            $this->addAuthor();
            $this->addArticle();
            $this->endWork("");
        }

        private function addAuthor() {
            if(!isset($this->existingSameAuthorId)) {
                $stmt = $this->mysqli->prepare("INSERT INTO articles_authors (author_name) VALUES (?)");
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

        private function addArticle() {
            $stmt = $this->mysqli->prepare("INSERT INTO articles (author_id, content, title, date_publication) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('isss', $this->newAuthorId, $this->content, $this->title, $this->publication);
            if(!$stmt->execute()) {
                $error = $this->mysqli->error;
                $this->reportError("Adding article failed, $error");
            }
            $this->newArticleId = $stmt->insert_id;
        }
    }
?>