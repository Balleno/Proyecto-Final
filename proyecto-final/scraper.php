<?php
    function amazon($param) {
        require_once 'simple_html_dom.php';
        /* metemos en la variable la url del producto que vamos a realizar scrapping */
        $html = file_get_html('https://www.amazon.es/' . $param, false);
    
        $results = array();
    
        if (!empty($html)) /* comprombamos que el documento html no está vacío */{
            /* (".s-image") */
            /* Aquí buscamos el precio en el documento html */
            $results['price'] = $html->find(".a-price-whole", 0)->plaintext;
        }

        /* limpiamos la memoria para que no nos agote los recursos */
        $html->clear(); 
        unset($html);
        
        /* imprimimos los resultados aquí */
        print_r($results);
    }
    amazon("s?k=spiderman+no+way+home+bluray");
?>