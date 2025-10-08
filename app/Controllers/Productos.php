<?php

namespace App\Controllers;

class Productos extends BaseController{

    public function index(){
        echo "<h1>ControllerProductos</h1>";
        print_r($this->session);
    }

    public function show($num){
        return "<h2>Detalles del producto $num</h2>";
    }

}