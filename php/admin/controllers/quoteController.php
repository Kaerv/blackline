<?php 
    require_once "controller.php";
    require_once "models/quoteModel.php";

    class QuoteController extends Controller 
    {
        public function __construct() {
            parent::__construct();

            $this->model = new QuoteModel();
            $this->reportErrorIfOccured();
        }



        public function send($args) {
            $this->validateContent($args["content"]);
            $existingAuthor = $this->validateAuthor($args["author"]);
            $categories = $this->validateCategories($args["categories"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $categoriesIds = $this->addCategories($categories);
            $this->addQuote($args["content"], $args["translation"], $authorId, $categoriesIds);

            $this->endWork("Dodano cytat!");
        }

        private function validateContent($content) {
            if($content == "")
                $this->reportError("Treść cytatu nie może być pusta.");
            
            if($this->model->existsQuoteWithContent($content)) 
                $this->reportError("Taki cytat już istnieje!");

            $this->reportErrorIfOccured();
        }



        private function validateCategories($categories) {
            $existingCategories = array();
            $newCategories = array();

            if(count($categories) == 0)
                $this->reportError("Cytat musi mieć min. 1 kategorię!");

            if(count($categories) > 3)
                $this->reportError("Cytat nie może mieć więcej niż 3 kategorie!");

            foreach($categories as $key => $category) {
                $existingCategoryId = $this->model->getCategoryIdByName($category);
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



        private function addCategories($categories) {
            $newCategories = $categories["new"];
            $existingCategories = $categories["existing"];

            foreach($newCategories as $category) {
                $categoryId = $this->model->addCategory($category);
                $this->reportErrorIfOccured();

                $existingCategories[] = $categoryId;
            }

            return $existingCategories;
        }

        private function addQuote($content, $translation, $authorId, $categoriesIds) {
            $this->model->addQuote($content, $translation, $authorId, $categoriesIds);
            $this->reportErrorIfOccured();
        }

        public function remove($args) {
            $id = $args["id"];

            $author = $this->model->checkAuthorIsNecessary($id);
            $categories = $this->model->checkcategoriesAreNecessary($id);
            $this->reportErrorIfOccured();

            $this->model->removeCategoriesSets($id);
            $this->model->removeCategories($categories);
            $this->model->remove($id);
            if($author) $this->model->removeAuthor($author);
            $this->reportErrorIfOccured();

            $this->endWork("Usunięto cytat!");
        }

        public function edit($args) {
            $id = $args["id"];

            $author = $this->model->checkAuthorIsNecessary($id);
            $categories = $this->model->checkcategoriesAreNecessary($id);
            $this->reportErrorIfOccured();

            $this->model->removeCategoriesSets($id);
            $this->model->removeCategories($categories);
            $this->model->remove($id);
            if($author) $this->model->removeAuthor($author);
            $this->reportErrorIfOccured();
            
            $this->validateContent($args["content"]);
            $existingAuthor = $this->validateAuthor($args["author"]);
            $categories = $this->validateCategories($args["categories"]);

            $authorId = $this->addAuthor($args["author"], $existingAuthor);
            $categoriesIds = $this->addCategories($categories);
            $this->addQuote($args["content"], $args["translation"], $authorId, $categoriesIds);


            $this->endWork("Edytowano cytat!");
        }
    }
?>