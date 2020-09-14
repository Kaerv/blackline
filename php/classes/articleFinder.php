<?php 
     require_once 'quoteManager.php';

     class ArticleFinder extends QuoteManager {
         public function __construct($token) {
             parent::__construct($token);
         }
 
         public function findArticles($data) {
            $this->phrase = $data["phrase"];

             $query = 
             "SELECT 
                articles.article_id AS id,
                articles_authors.author_name AS author,
                articles.title AS title,
                articles.date_added AS date_added,
                articles.date_publication AS date_publication,
                articles.visit_daily AS visit_daily,
                articles.visit_monthly AS visit_monthly,
                articles.visit_yearly AS visit_yearly
            FROM 
                articles, articles_authors
     
             WHERE 
                 articles.author_id = articles_authors.author_id AND (
                    articles.content LIKE '%$this->phrase%' OR 
                    articles_authors.author_name LIKE '%$this->phrase%') LIMIT 25";
             
             $articles = $this->mysqli->query($query);
             while($article = $articles->fetch_assoc()) {
                 $id = $article["id"];
                 $title = $article["title"];
                 $author = $article["author"];
                 $dateAdded = $article["date_added"];
                 $datePublication = $article["date_publication"];
                 $visitDaily = $article["visit_daily"];
                 $visitMonthly = $article["visit_monthly"];
                 $visitYearly = $article["visit_yearly"];
                 echo "$id|$title|$author|$dateAdded|$datePublication|$visitDaily|$visitMonthly|$visitYearly*";
             }
         }
     }
?>