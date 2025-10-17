<?php

namespace App\Models;
use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table = 'assignments';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'id_user',
        'id_course',
        'status',
    ];
    
    protected $deleteField = 'deleted_at';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

