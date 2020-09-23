<?php
    require_once "model.php";

    class DefinitionModel extends Model {
        public function __construct() {
            parent::__construct();
            $this->dbName = "definitions";
            $this->type = "definition";
        }

        public function getRecords($start, $step) {
            $query = "SELECT 
                definitions.definition_id AS id,
                definitions_authors.author_name AS author,
                definitions.title AS title,
                definitions.date_added AS dateAdded,
                definitions.visit_daily AS visitDaily,
                definitions.visit_monthly AS visitMonthly,
                definitions.visit_yearly AS visitYearly
            FROM 
                definitions, definitions_authors
            WHERE
                definitions.author_id = definitions_authors.author_id
            ORDER BY 
                definitions.date_added
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
            $stmt = $this->mysqli->prepare("SELECT content FROM definitions WHERE definition_id = ?");
            $stmt->bind_param("i", $id);
            
            if(!$stmt->execute())
                $this->reportError("Błąd wczytywania treści definicji.");

            $result = $stmt->get_result();
            if($result->num_rows > 0) {
                $row = $result->fetch_row();
                return $row[0];
            }
            else $this->reportError("Nie znaleziono treści definicji.");
        }

        public function addDefinition($authorId, $content, $title) {
            $stmt = $this->mysqli->prepare("INSERT INTO definitions (author_id, content, title) VALUES (?, ?, ?)");            
            $stmt->bind_param("iss", $authorId, $content, $title);
            if(!$stmt->execute()) {
                $this->reportError("Dodawanie definicji nie powiodło się: $stmt->error");
                return false;
            }
        }

        public function findByPhrase($phrase) {
            $phrase = "%$phrase%";
            $query = "SELECT 
                definitions.definition_id AS id,
                definitions_authors.author_name AS author,
                definitions.title AS title,
                definitions.date_added AS dateAdded,
                definitions.visit_daily AS visitDaily,
                definitions.visit_monthly AS visitMonthly,
                definitions.visit_yearly AS visitYearly
            FROM 
                definitions, definitions_authors
    
            WHERE 
                definitions.author_id = definitions_authors.author_id AND (
                    definitions.content LIKE ? OR 
                    definitions_authors.author_name LIKE ? OR
                    definitions.title LIKE ?) LIMIT 50";

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