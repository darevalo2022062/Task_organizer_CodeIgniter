<?php

namespace App\Controllers;

class Productos extends BaseController{

    public function index(){
        $data = ['titulo' => 'Listado de Productos', 'copyright' => '2024'];
        return view('productos/index', $data);
        /*return view('plantilla/header', $data).
               view('productos/index', $data).
               view('plantilla/footer', ['copyright' => '2024']);
               */
        //return view('productos/index', $data);
    }

    public function show($num){
        return "<h2>Detalles del producto $num</h2>";
    }

}