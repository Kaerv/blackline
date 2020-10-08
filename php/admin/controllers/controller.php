<?php 
class Control {
    public function __construct($fromFrontController = 0) {
        $this->validateConnection($fromFrontController);
        $this->model = NULL;
    }

    private function validateConnection($fromFrontController) {
        session_start();
        if(!$fromFrontController) {
            if(empty($_SESSION['token']) || $_SESSION['token'] != $_REQUEST["token"] || !isset($_REQUEST["token"])) {
                $this->reportError($fromFrontController);
            }
        }
    }

    public function getRows($args) {
        $start = $args["start"];
        $step = $args["step"];
        $order = isset($args["order"]) ? $args["order"] : "date_added";
        $order = str_replace("-", " ", $order);
        $filters = $args["filters"];
        $result = $this->model->getRecords($start, $step, $order, $filters);
        $this->reportErrorIfOccured();
        //$this->endWork($result);
        return $result;
    }

    public function getAllCount() {
        $count = $this->model->getAllCount();

        $this->reportErrorIfOccured();
        $this->endWork($count);
        return $count;
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

        $this->endWork();
        return $results;
        
    }

    protected function endWork() {
        $this->model->endWork();
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