<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productos extends BaseController
{
    protected ProductosModel $productosModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        // $this->productosModel = new ProductosModel();
        // helper model()
        $this->productosModel = model(ProductosModel::class);
    }

    public function index()
    {
        $results = $this->productosModel->findAll();

        $data = [
            'titulo' => 'Listado de Productos',
            'copyright' => '2024',
            'productos' => $results,
        ];

        return view('productos/index', $data);
    }

    public function show($num)
    {
        return "<h2>Detalles del producto $num</h2>";
    }

    public function nuevo()
    {
        return view('productos/nuevo');
    }

    public function guarda()
    {
        print_r($_POST);

        $rules = [
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El campo {field} no debe exceder de {param} caracteres.'
                ]
            ],
            'precio' => [
                'label' => 'Precio',
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'decimal' => 'El campo {field} debe ser un número decimal válido.'
                ]
            ],
            'tienda' => [
                'label' => 'Tienda',
                'rules' => 'required|integer|is_not_unique[tiendas.id_tienda]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'integer' => 'El campo {field} debe ser un número entero válido.',
                    'is_not_unique' => 'El campo {field} no existe en la base de datos.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

    }


}
