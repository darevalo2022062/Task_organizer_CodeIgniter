<?php

namespace App\Controllers;
use App\Models\ProductosModel;

class Productos extends BaseController
{

    private $productosModel;
    public function __construct(ProductosModel $productosModel)
    {
        $this->productosModel = $productosModel;
    }

    public function index()
    {
        $db = \Config\Database::connect();
        /*
        $query = $db->query("SELECT * FROM producto");
        $results = $query->getResult();*/

        $results = $this->productosModel->findAll();

        $queryBuilder = $db->table('producto')
        ->select('id_producto, nombre_producto, precio_producto')
        ->where('status', 1)
        ->get();


        $data = ['titulo' => 'Listado de Productos', 'copyright' => '2024', 'productos' => $results];
        return view('productos/index', $data);
    }

    public function show($num)
    {
        return "<h2>Detalles del producto $num</h2>";
    }

}