<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nombre_producto', 'precio_producto', 'id_tienda', 'status'];
    protected $dateFormat = 'datetime';
    protected $deletedField = 'deleted_at';


}