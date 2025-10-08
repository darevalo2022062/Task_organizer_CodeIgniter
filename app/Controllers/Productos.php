<?php

namespace App\Controllers;

class Productos extends BaseController{

    public function index(){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM producto");
        $results = $query->getResult();
        $data = ['titulo' => 'Listado de Productos', 'copyright' => '2024', 'productos' => $results];
        return view('productos/index', $data);
    }

    public function show($num){
        return "<h2>Detalles del producto $num</h2>";
    }

}