<?php
    require_once "./controllers/quoteController.php";
    $controller = new QuoteController();
    $quotes = $controller->getRows(
        array(
            "start" => 0,
            "step" => 1000000000000
    ));

    $f = fopen("cytaty.txt", "w");
    if($f) {
        /*fputcsv($fp, array("Nr cytatu", "Treść", "Tłumaczenie", "Autor", "Data dodania", "Polubienia", "Kategoria 1", "Kategoria 2", "Kategoria 3"), ";");
        foreach ($quotes as $fields) {
            $categories = $fields["categories"];
            unset($fields["categories"]);
            $fields["category1"] = ($categories[0])? $categories[0]: "";
            $fields["category2"] = ($categories[1])? $categories[1]: "";
            $fields["category3"] = ($categories[2])? $categories[2]: "";
            fputcsv($fp, $fields, ";");
        }*/

        foreach ($quotes as $quote) {
            fwrite($f, $quote["content"]."\n");
            fwrite($f, ($quote["translation"])? $quote["translation"]."\n": "");
            fwrite($f, " - ".$quote["author"]." - \n");
            fwrite($f, (($quote["categories"][0])? $quote["categories"][0] : ""));
            fwrite($f, (($quote["categories"][1])? ", ".$quote["categories"][1] : ""));
            fwrite($f, (($quote["categories"][2])? ", ".$quote["categories"][2] : ""));
            fwrite($f, "\n");
            fwrite($f, "\n");
        }
    
        fclose($f);
    
        //$filepath = "./file.csv";
        $filepath = "./cytaty.txt";
    
        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        print("Wystąpił problem z pobieraniem");
    }
?>