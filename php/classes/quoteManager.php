<?php 
    class QuoteManager {
        public $mysqli;

        public function __construct($token) {
            $this->token = $token;

            $this->createDBConnection();
            $this->checkValidateToken();
        }

        public function createDBConnection() {
            $this->mysqli = new mysqli('localhost', 'blackline', 'K)c#@mc!3', 'blackline');
            if ($this->mysqli->connect_errno) {
                $this->reportError($this->mysqli->connect_error);
            }
            $this->mysqli->query("SET NAMES utf8");
            $this->mysqli->autocommit(FALSE);
        }

        public function checkValidateToken() {
            session_start();

            if(empty($_SESSION['token']) || $_SESSION['token'] != $this->token) {
                $this->reportError("Error with validate connection");
                die();
            }
        }

        public function reportErrorIfOccured() {
            if($this->mysqli->error) {
                $error = $this->mysqli->error;
                $this->reportError("Houston, we have a problem: $error");
            }
        }

        public function reportError($message) {
            echo "-1;";
            echo "$message;";
            $this->mysqli->close();
            die();
        }

        public function endWork($message) {
            echo "0";
            echo "$message";
            $this->mysqli->commit();
            $this->mysqli->close();
            die();
        }
        
    }
?>