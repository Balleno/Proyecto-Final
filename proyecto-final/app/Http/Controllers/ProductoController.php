<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        $datos['tiendas']=array();
        return view('navegacion.productos', $datos);
    }
    public function show(Request $request, $texto_buscar){
        //print_r($request->input('busqueda'));
        $datos['tiendas']['amazon'] = self::amazon($texto_buscar);
        $datos['tiendas']['amazon']['nombreTienda'] = "AMAZON";
        return view('navegacion.productos', $datos);
    }

    public function seguir(Request $request){
        $datos['tiendas']=array();
        $texto_buscar = $request->input('urlproducto');
        print_r($texto_buscar);

        return view('navegacion.productos', $datos);
    }

    public function store(Request $request){
        $datos['tiendas']=array();
        //print_r($request->input('busqueda'));
        $texto_buscar = $request->input('busqueda');

        $datos['tiendas']['amazon'] = self::amazon(str_replace(' ', '+', $texto_buscar));
        $datos['tiendas']['amazon']['nombreTienda'] = "AMAZON";

        $datos['tiendas']['ebay'] = self::ebay(str_replace(' ', '+', $texto_buscar));
        $datos['tiendas']['ebay']['nombreTienda'] = "EBAY";

        return view('navegacion.productos', $datos);
    }

    public function amazon($param) {
        require_once 'simple_html_dom.php';

        $results = array();

        if($param != "") {
            /* metemos en la variable la url del producto que vamos a realizar scrapping */
            $html = file_get_html('https://www.amazon.es/s?k=' . $param, false);

            foreach ($html->find(".AdHolder") as $elemento){
                $elemento->outertext = '';
            }

            $html->load($html->save());

            if (!empty($html)) /* comprombamos que el documento html no está vacío */{
                /* (".s-image") */
                /* Aquí buscamos el precio en el documento html */
                if ($html->find(".a-price-whole", 0) != null) {
                    $results['price'] = $html->find(".a-price-whole", 0)->plaintext;
                    $results['imagen'] = $html->find('img[data-image-index]',0)->src;
                    $results['urlproducto'] = "https://www.amazon.es" . $html->find('.a-link-normal',0)->href;
                    //$results['urlproducto'] = $html->find('img[data-image-index]',0)->src;  
                }            
            }

            /* limpiamos la memoria para que no nos agote los recursos */
            $html->clear(); 
            unset($html);

            /* imprimimos los resultados aquí */
            //print_r($results);

        }
        return $results;
    }

    public function ebay($param) {
        require_once 'simple_html_dom.php';

        $results = array();

        if($param != "") {

            /* metemos en la variable la url del producto que vamos a realizar scrapping */
            $html = file_get_html('https://www.ebay.es/sch/i.html?_nkw=' . $param, false);
        
            $results = array();
        
            if (!empty($html)) /* comprombamos que el documento html no está vacío */{
                /* (".s-image") */
                /* Aquí buscamos el precio en el documento html */
                if($html->find(".srp-results", 0)->find(".s-item__price", 0) != null) {
                    $results['price'] = $html->find(".srp-results", 0)->find(".s-item__price", 0)->plaintext;
                    $results['imagen'] = $html->find(".srp-results", 0)->find('.s-item__image-img', 0)->src;
                    $results['urlproducto'] = $html->find(".srp-results", 0)->find('.s-item__link', 0)->href;
                                    
                }
            }

            /* limpiamos la memoria para que no nos agote los recursos */
            $html->clear(); 
            unset($html);
            
            /* imprimimos los resultados aquí */
            //print_r($results);
            }
            return $results;
        }
        
    }

    
