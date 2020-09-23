<?php
    require_once "model.php";

    class ArticleModel extends Model {
        public function __construct() {
            parent::__construct();
            $this->dbName = "articles";
            $this->type = "article";
        }

        public function getRecords($start, $step) {
            $query = "SELECT 
                articles.article_id AS id,
                articles_authors.author_name AS author,
                articles.title AS title,
                articles.date_added AS dateAdded,
                articles.date_publication AS datePublication,
                articles.visit_daily AS visitDaily,
                articles.visit_monthly AS visitMonthly,
                articles.visit_yearly AS visitYearly
            FROM 
                articles, articles_authors
            WHERE
                articles.author_id = articles_authors.author_id
            ORDER BY 
                articles.date_added
            LIMIT $start, $step";

            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $results = array();
            while($row = $result->fetch_object()) {
                $results[] = $row;
            }
            
            return $results;
        }

        public function getContentById($id) {
            $stmt = $this->mysqli->prepare("SELECT content FROM articles WHERE article_id = ?");
            $stmt->bind_param("i", $id);
            
            if(!$stmt->execute())
                $this->reportError("Błąd wczytywania treści artykułu.");

            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $row = $result->fetch_row();
                return $row[0];
            }
            else $this->reportError("Nie znaleziono treści artykułu.");
        }

        public function addArticle($authorId, $content, $title, $publication) {
            $publication = ($publication == "")? date("Y-m-d") : $publication;
            $stmt = $this->mysqli->prepare("INSERT INTO articles (author_id, content, title, date_publication) VALUES (?, ?, ?, ?)");            
            $stmt->bind_param("isss", $authorId, $content, $title, $publication);
            if(!$stmt->execute()) {
                $this->reportError("Dodawanie artykułu nie powiodło się: $stmt->error");
                return false;
            }
        }

        public function findByPhrase($phrase) {
            $phrase = "%$phrase%";
            $query = "SELECT 
                articles.article_id AS id,
                articles_authors.author_name AS author,
                articles.title AS title,
                articles.date_added AS dateAdded,
                articles.date_publication AS datePublication,
                articles.visit_daily AS visitDaily,
                articles.visit_monthly AS visitMonthly,
                articles.visit_yearly AS visitYearly
            FROM 
                articles, articles_authors
    
            WHERE 
                articles.author_id = articles_authors.author_id AND (
                    articles.content LIKE ? OR 
                    articles_authors.author_name LIKE ? OR
                    articles.title LIKE ?) LIMIT 25";

            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param("sss", $phrase, $phrase, $phrase);
            if(!$stmt->execute()) {
                $this->reportError($stmt->error);
                return false;
            }

            $result = $stmt->get_result();
            $results = array();
            while($row = $result->fetch_object()) {
                $results[] = $row;
            }
            return $results;
        }
    }
?>