<?php 
    class QuoteManager {
        public $mysqli;

        public function __construct() {
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
            if(isset($_GET['token']))
                $token = $_GET['token'];
            
            else
                $token = $_POST['token'];
            
            if(empty($_SESSION['token']) || $_SESSION['token'] != $token) {
                $this->reportError("Error with validate connection");
                die();
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