<?php 
    require_once 'quoteManager.php';
    class ResourcesGetter extends QuoteManager {
        public function __construct($token) {
            parent::__construct($token);
        }

        public function getResources($query) {
            return $this->mysqli->query($query);
        }

        public function getResourcesCount($type) {
            $query = "SELECT COUNT(*) AS c FROM ".$type."s";
            $response = $this->mysqli->query($query);

            $count = NULL;
            while($c = $response->fetch_assoc()) {
                $count = $c["c"];
            }

            $this->endWork($count);
        }
    }
?>

