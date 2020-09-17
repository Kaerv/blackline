<?php
    class Model {

        public $hasError;
        public $error;

        public function __construct() {
            $this->hasError = false;
            $this->createDatabaseConnection();
        }

        public function createDatabaseConnection() {
            $this->mysqli = new mysqli('localhost', 'blackline', 'K)c#@mc!3', 'blackline');

            if($this->mysqli->connect_errno) {
                $this->reportError("Wystąpił błąd podczas łączenia z bazą danych.");
            }

            $this->mysqli->query("SET NAMES utf8");
            $this->mysqli->autocommit(FALSE);   
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