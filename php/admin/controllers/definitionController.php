<?php 
    require_once "controller.php";
    require_once "models/definitionModel.php";

    class DefinitionController extends Controller 
    {
        public function __construct() {
            parent::__construct();

            $this->model = new DefinitionModel();
            $this->reportErrorIfOccured();
        }

        public function getContentById($args) {
            $id = $args["id"];
            $content = $this->model->getContentById($id);
            $this->reportErrorIfOccured();

            $this->endWork($content);
        }

        public function send($args) {
            $this->validateContent($args["content"]);
            $this->validateTitle($args["title"]);
            
            $existingAuthor = $this->validateAuthor($args["author"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $this->addDefinition($authorId, $args["content"], $args["title"]);

            $this->endWork("Dodano definicję!");
        }

        private function validateContent($content) {
            if($content == "")
                $this->reportError("Treść definicji nie może być pusta.");
        }

        private function validateTitle($title) {
            if($title == "") 
                $this->reportError("Tytuł definicji nie może być pusty.");

            $this->reportErrorIfOccured();
        }

        private function addDefinition($authorId, $content, $title) {
            $id = $this->model->addDefinition($authorId, $content, $title);
            $this->reportErrorIfOccured();
        }

        public function remove($args) {
            $id = $args["id"];

            $author = $this->model->checkAuthorIsNecessary($id);
            $this->reportErrorIfOccured();

            $this->model->remove($id);
            if($author) $this->model->removeAuthor($author);
            $this->reportErrorIfOccured();

            $this->endWork("Usunięto artykuł!");
        }

        public function edit($args) {
            $id = $args["id"];

            $author = $this->model->checkAuthorIsNecessary($id);
            $this->reportErrorIfOccured();

            $this->model->remove($id);
            if($author) $this->model->removeAuthor($author);
            $this->reportErrorIfOccured();
            
            $this->validateContent($args["content"]);
            $this->validateTitle($args["title"]);
            $existingAuthor = $this->validateAuthor($args["author"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $this->addDefinition($authorId, $args["content"], $args["title"]);


            $this->endWork("Edytowano artykuł!");
        }
    }
?>