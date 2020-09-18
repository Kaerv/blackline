<?php 
    require_once "controller.php";
    require_once "models/quoteModel.php";

    class QuoteController extends Controller 
    {
        public function __construct() {
            parent::__construct();

            $this->quotes = new QuoteModel();
            $this->reportErrorIfOccured();
        }

        public function getRows($args) {
            $start = $args["start"];
            $step = $args["step"];

            $result = $this->quotes->getRecords($start, $step);
            $this->reportErrorIfOccured();

            $this->quotes->endWork();
            $this->endWork($result);
        }

        public function getAllCount() {
            $count = $this->quotes->getAllCount();

            $this->reportErrorIfOccured();
            $this->endWork($count);
        }

        public function send($args) {
            $this->validateContent($args["content"]);
            $existingAuthor = $this->validateAuthor($args["author"]);
            $categories = $this->validateCategories($args["categories"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $categoriesIds = $this->addCategories($categories);
            $this->addQuote($args["content"], $args["translation"], $authorId, $categoriesIds);
            $this->quotes->endWork();
            $this->endWork("Dodano cytat!");
        }

        private function validateContent($content) {
            if($content == "")
                $this->reportError("Treść cytatu nie może być pusta.");
            
            if($this->quotes->existsQuoteWithContent($content)) 
                $this->reportError("Taki cytat już istnieje!");

            $this->reportErrorIfOccured();
        }

        private function validateAuthor($author) {
            $existingAuthor = $this->quotes->getAuthorIdByName($author);
            $this->reportErrorIfOccured();
            return $existingAuthor;
        }

        private function validateCategories($categories) {
            $existingCategories = array();
            $newCategories = array();

            if(count($categories) == 0)
                $this->reportError("Cytat musi mieć min. 1 kategorię!");

            if(count($categories) > 3)
                $this->reportError("Cytat nie może mieć więcej niż 3 kategorie!");

            foreach($categories as $key => $category) {
                $existingCategoryId = $this->quotes->getCategoryIdByName($category);
                $this->reportErrorIfOccured();

                if($existingCategoryId) 
                    $existingCategories[] = $existingCategoryId;
                else 
                    $newCategories[] = $category;
            }

            return array(
                "existing" => $existingCategories,
                "new" => $newCategories
            );
        }

        private function addAuthor($author, $existingAuthor) {
            if(!$existingAuthor) {
                $authorId = $this->quotes->addAuthor($author);
                $this->reportErrorIfOccured();
                return $authorId;
            }
            
            else 
                return $existingAuthor;
        }

        private function addCategories($categories) {
            $newCategories = $categories["new"];
            $existingCategories = $categories["existing"];

            foreach($newCategories as $category) {
                $categoryId = $this->quotes->addCategory($category);
                $this->reportErrorIfOccured();

                $existingCategories[] = $categoryId;
            }

            return $existingCategories;
        }

        private function addQuote($content, $translation, $authorId, $categoriesIds) {
            $this->quotes->addQuote($content, $translation, $authorId, $categoriesIds);
            $this->reportErrorIfOccured();
        }

        public function remove($args) {
            $id = $args["id"];

            $author = $this->quotes->checkAuthorIsNecessary($id);
            $categories = $this->quotes->checkcategoriesAreNecessary($id);
            $this->reportErrorIfOccured();

            $this->quotes->removeCategoriesSets($id);
            $this->quotes->removeCategories($categories);
            $this->quotes->removeQuote($id);
            if($author) $this->quotes->removeAuthor($author);
            $this->reportErrorIfOccured();
            $this->quotes->endWork();
            $this->endWork("Usunięto cytat!");
        }

        public function edit($args) {
            $id = $args["id"];

            $author = $this->quotes->checkAuthorIsNecessary($id);
            $categories = $this->quotes->checkcategoriesAreNecessary($id);
            $this->reportErrorIfOccured();

            $this->quotes->removeCategoriesSets($id);
            $this->quotes->removeCategories($categories);
            $this->quotes->removeQuote($id);
            if($author) $this->quotes->removeAuthor($author);
            $this->reportErrorIfOccured();
            
            $this->validateContent($args["content"]);
            $existingAuthor = $this->validateAuthor($args["author"]);
            $categories = $this->validateCategories($args["categories"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $categoriesIds = $this->addCategories($categories);
            $this->addQuote($args["content"], $args["translation"], $authorId, $categoriesIds);

            $this->quotes->endWork();
            $this->endWork("Edytowano cytat!");
        }

        public function search($args) {
            $phrase = $args["phrase"];
            if($phrase == "" or empty($phrase)) 
                $this->reportError("Wyszukiwana fraza nie może być pustym słowem");
            
            $results = $this->quotes->findQuotesByPhrase($phrase);
            $this->reportErrorIfOccured();

            $this->quotes->endWork();
            $this->endWork($results);
            
        }

        private function reportErrorIfOccured() {
            if($this->quotes->hasError) {
                $this->reportError($this->quotes->error);
            }
        }
    }
?>