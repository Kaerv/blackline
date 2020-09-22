<?php 
    class Controller {
        public function __construct() {
            $this->validateConnection();
        }

        private function validateConnection() {
            session_start();

            if(empty($_SESSION['token']) || $_SESSION['token'] != $_REQUEST["token"] || !isset($_REQUEST["token"])) {
                $this->reportError("Wystąpił problem z uwierzytelnieniem połączenia. Odśwież stronę i spróbuj ponownie");
            }
        }

        protected function endWork($msg) {
            print(json_encode(array(0,$msg)));
            exit();
        }

        public function reportError($error) {
            print(json_encode(array(-1, $error)));
            die();
        }
    }
?>