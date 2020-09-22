<?php 
    require_once "controller.php";
    require_once "models/articleModel.php";

    class ArticleController extends Controller 
    {
        public function __construct() {
            parent::__construct();

            $this->articles = new ArticleModel();
            $this->reportErrorIfOccured();
        }

        public function getRows($args) {
            $start = $args["start"];
            $step = $args["step"];

            $result = $this->articles->getRecords($start, $step);
            $this->reportErrorIfOccured();

            $this->articles->endWork();
            $this->endWork($result);
        }

        public function getAllCount() {
            $count = $this->articles->getAllCount();

            $this->reportErrorIfOccured();
            $this->endWork($count);
        }

        public function getContentById($args) {
            $id = $args["id"];
            $content = $this->articles->getContentById($id);
            $this->reportErrorIfOccured();

            $this->articles->endWork();
            $this->endWork($content);
        }

        public function send($args) {
            $this->validateContent($args["content"]);
            $this->validateTitle($args["title"]);
            
            $existingAuthor = $this->validateAuthor($args["author"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $this->addArticle($authorId, $args["content"], $args["title"], $args["publication"]);

            $this->articles->endWork();
            $this->endWork("Dodano artykuł!");
        }

        private function validateContent($content) {
            if($content == "")
                $this->reportError("Treść artykułu nie może być pusta.");
        }

        private function validateTitle($title) {
            if($title == "") 
                $this->reportError("Treść artykułu nie może być pusta.");

            $this->reportErrorIfOccured();
        }

        private function validateAuthor($author) {
            $existingAuthor = $this->articles->getAuthorIdByName($author);
            $this->reportErrorIfOccured();
            return $existingAuthor;
        }


        private function addAuthor($author, $existingAuthor) {
            if(!$existingAuthor or empty($existingAuthor)) {
                $authorId = $this->articles->addAuthor($author);
                $this->reportErrorIfOccured();
                return $authorId;
            }
            
            else 
                return $existingAuthor;
        }

        private function addArticle($authorId, $content, $title, $publication) {
            $id = $this->articles->addArticle($authorId, $content, $title, $publication);
            $this->reportErrorIfOccured();
        }

        public function remove($args) {
            $id = $args["id"];

            $author = $this->articles->checkAuthorIsNecessary($id);
            $this->reportErrorIfOccured();

            $this->articles->removeArticle($id);
            if($author) $this->articles->removeAuthor($author);
            $this->reportErrorIfOccured();
            $this->articles->endWork();
            $this->endWork("Usunięto artykuł!");
        }

        public function edit($args) {
            $id = $args["id"];

            $author = $this->articles->checkAuthorIsNecessary($id);
            $this->reportErrorIfOccured();

            $this->articles->removeArticle($id);
            if($author) $this->articles->removeAuthor($author);
            $this->reportErrorIfOccured();
            
            $this->validateContent($args["content"]);
            $this->validateTitle($args["title"]);
            $existingAuthor = $this->validateAuthor($args["author"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $this->addArticle($authorId, $args["content"], $args["title"], $args["publication"]);

            $this->articles->endWork();
            $this->endWork("Edytowano artykuł!");
        }

        public function search($args) {
            $phrase = $args["phrase"];
            if($phrase == "" or empty($phrase)) 
                $this->reportError("Wyszukiwana fraza nie może być pustym słowem");
            
            $results = $this->articles->findArticlesByPhrase($phrase);
            $this->reportErrorIfOccured();

            $this->articles->endWork();
            $this->endWork($results);
            
        }

        private function reportErrorIfOccured() {
            if($this->articles->hasError) {
                $this->reportError($this->articles->error);
            }
        }
    }
?>