<?php
    require_once "model.php";

    class ArticleModel extends Model {
        public function __construct() {
            parent::__construct();
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

        public function getAllCount() {
            $query = "SELECT COUNT(*) AS c FROM articles";
            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $c = $result->fetch_assoc();
            return $c["c"];
        }

        public function getAuthorIdByName($author) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM articles_authors WHERE author_name = ?");
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

        public function AddAuthor($author) {
            $stmt = $this->mysqli->prepare("INSERT INTO articles_authors (author_name) VALUES (?)");
            $stmt->bind_param('s', $author);

            if(!$stmt->execute()) {
                $this->reportError("Dodawanie autora nie powiodło się: $stmt->error.");
                return false;
            }

            return $stmt->insert_id;
        }

        public function addArticle($authorId, $content, $title, $publication) {
            $publication = ($publication == "")? date("Y-m-d H:i:s") : $publication;
            $stmt = $this->mysqli->prepare("INSERT INTO articles (author_id, content, title, date_publication) VALUES (?, ?, ?, ?)");            $stmt->bind_param('iss', $authorId, $content, $translation);
            $stmt->bind_param("isss", $authorId, $content, $title, $publication);
            if(!$stmt->execute()) {
                $this->reportError("Dodawanie artykułu nie powiodło się: $stmt->error");
                return false;
            }
        }

        public function checkAuthorIsNecessary($id) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM articles WHERE article_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Błąd wyszukiwania autora artykułu.");
                return false;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $author_id = NULL;
                while($row = $result->fetch_row()) {
                    $author_id = $row[0];
                }

                $result = $this->mysqli->query("SELECT article_id FROM articles WHERE author_id = $author_id");
                return $result->num_rows == 1 ? $author_id : false;
            }

            else {
                $this->reportError("Nie można znaleźć autora artykułu o id: $id");
                return false;
            }
        }

        public function removeArticle($id) {
            $stmt = $this->mysqli->prepare("DELETE FROM articles WHERE article_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił błąd podczas usuwania artykułu: $stmt->error");
                return false;
            }
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Wystąpił błąd podczas usuwania artykułu: Artykuł którego dotyczy żądanie nie istnieje.");
                return false;
            }
        }

        public function removeAuthor($id) {
            if(!is_null($id)) {
                $stmt = $this->mysqli->prepare("DELETE FROM articles_authors WHERE author_id = ?");
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

        public function findArticlesByPhrase($phrase) {
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