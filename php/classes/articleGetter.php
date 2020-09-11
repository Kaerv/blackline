<?php 
    require_once 'quoteManager.php';
    class ArticleGetter extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function getArticles($start) {
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
                articles.author_id = articles_authors.author_id
            ORDER BY 
                articles.date_added
            LIMIT $start, 25";
        
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

        public function getArticlesCount() {
            $query = "SELECT COUNT(*) AS c FROM articles";
            $response = $this->mysqli->query($query);

            $count = NULL;
            while($c = $response->fetch_assoc()) {
                $count = $c["c"];
            }

            $this->endWork($count);
        }
    }
?>

