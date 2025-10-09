<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductosSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre_producto' => 'Lenovo IdeaPad 3',
                'precio_producto' => 3999.99,
                'id_tienda' => 1,
                'status' => 1
            ],
            [
                'nombre_producto' => 'Apple MacBook Air',
                'precio_producto' => 9999.99,
                'id_tienda' => 1,
                'status' => 1
            ],
            [
                'nombre_producto' => 'HP Pavilion 15',
                'precio_producto' => 5499.99,
                'id_tienda' => 2,
                'status' => 1
            ],
            [
                'nombre_producto' => 'Dell XPS 13',
                'precio_producto' => 11999.99,
                'id_tienda' => 2,
                'status' => 1
            ],
            [
                'nombre_producto' => 'Asus ZenBook 14',
                'precio_producto' => 7999.99,
                'id_tienda' => 3,
                'status' => 1
            ],
            [
                'nombre_producto' => 'Acer Swift 3',
                'precio_producto' => 6999.99,
                'id_tienda' => 3,
                'status' => 1
            ]
        ];

        $this->db->table('producto')->insertBatch($data);
    }
}
