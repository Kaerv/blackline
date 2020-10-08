<?php
    class Model {

        public $hasError;
        public $error;

        public function __construct() {
            $this->hasError = false;
            $this->createDatabaseConnection();
            $this->dbName = NULL;
            $this->type = NULL;
        }

        public function createDatabaseConnection() {
            $this->mysqli = new mysqli('localhost', 'blackline', 'K)c#@mc!3', 'blackline');

            if($this->mysqli->connect_errno) {
                $this->reportError("Wystąpił błąd podczas łączenia z bazą danych.");
            }

            $this->mysqli->query("SET NAMES utf8");
            $this->mysqli->set_charset("utf8");
            $this->mysqli->autocommit(FALSE);   
        }

        public function getAllCount() {
            $query = "SELECT COUNT(*) AS c FROM $this->dbName";
            if(!$result = $this->mysqli->query($query)) {
                $this->reportError($this->mysqli->error);
                return false;
            }

            $c = $result->fetch_assoc();
            return $c["c"];
        }

        public function getAuthorIdByName($author) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM ".$this->dbName."_authors WHERE author_name = ?");
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

        public function AddAuthor($author) {
            $stmt = $this->mysqli->prepare("INSERT INTO ".$this->dbName."_authors (author_name) VALUES (?)");
            $stmt->bind_param('s', $author);

            if(!$stmt->execute()) {
                $this->reportError("Dodawanie autora nie powiodło się: $stmt->error.");
                return false;
            }

            return $stmt->insert_id;
        }

        public function checkAuthorIsNecessary($id) {
            $stmt = $this->mysqli->prepare("SELECT author_id FROM $this->dbName WHERE ".$this->type."_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Błąd wyszukiwania autora.");
                return false;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $author_id = NULL;
                while($row = $result->fetch_row()) {
                    $author_id = $row[0];
                }

                $result = $this->mysqli->query("SELECT ".$this->type."_id FROM $this->dbName WHERE author_id = $author_id");
                return $result->num_rows == 1 ? $author_id : false;
            }

            else {
                $this->reportError("Nie można znaleźć autora według id: $id");
                return false;
            }
        }

        public function removeAuthor($id) {
            if(!is_null($id)) {
                $stmt = $this->mysqli->prepare("DELETE FROM ".$this->dbName."_authors WHERE author_id = ?");
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

        public function remove($id) {
            $stmt = $this->mysqli->prepare("DELETE FROM $this->dbName WHERE ".$this->type."_id = ?");
            $stmt->bind_param("i", $id);
            if(!$stmt->execute()) {
                $this->reportError("Wystąpił błąd podczas usuwania materiału: $stmt->error");
                return false;
            }
            
            if($this->mysqli->affected_rows == 0) {
                $this->reportError("Wystąpił błąd podczas usuwania materiału: Materiał którego dotyczy żądanie nie istnieje.");
                return false;
            }
        }

        public function reportError($error) {
            $this->hasError = true;
            $this->error = $error;
            $this->mysqli->rollback();
            $this->mysqli->close();
        }

        public function endWork() {
            $this->mysqli->commit();
            $this->mysqli->close();
        }
    }
?>