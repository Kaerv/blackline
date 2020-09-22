<?php 
    class Controller {
        public function __construct() {
            $this->validateConnection();
            $this->model;
        }

        private function validateConnection() {
            session_start();

            if(empty($_SESSION['token']) || $_SESSION['token'] != $_REQUEST["token"] || !isset($_REQUEST["token"])) {
                $this->reportError("Wystąpił problem z uwierzytelnieniem połączenia. Odśwież stronę i spróbuj ponownie");
            }
        }

        public function getRows($args) {
            $start = $args["start"];
            $step = $args["step"];

            $result = $this->model->getRecords($start, $step);
            $this->reportErrorIfOccured();

            
            $this->endWork($result);
        }

        public function getAllCount() {
            $count = $this->model->getAllCount();

            $this->reportErrorIfOccured();
            $this->endWork($count);
        }

        protected function validateAuthor($author) {
            $existingAuthor = $this->model->getAuthorIdByName($author);
            $this->reportErrorIfOccured();
            return $existingAuthor;
        }

        protected function addAuthor($author, $existingAuthor) {
            if(!$existingAuthor or empty($existingAuthor)) {
                $authorId = $this->model->addAuthor($author);
                $this->reportErrorIfOccured();
                return $authorId;
            }
            
            else 
                return $existingAuthor;
        }

        public function search($args) {
            $phrase = $args["phrase"];
            if($phrase == "" or empty($phrase)) 
                $this->reportError("Wyszukiwana fraza nie może być pustym słowem");
            
            $results = $this->model->findByPhrase($phrase);
            $this->reportErrorIfOccured();

            $this->endWork($results);
            
        }

        protected function endWork($msg) {
            $this->model->endWork();
            print(json_encode(array(0,$msg)));
            exit();
        }

        protected function reportErrorIfOccured() {
            if($this->model->hasError) {
                $this->reportError($this->model->error);
            }
        }

        public function reportError($error) {
            print(json_encode(array(-1, $error)));
            die();
        }
    }
?>