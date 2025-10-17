<?php

namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'name',
        'description',
        'course_id',
        'status',
    ];

    protected $deleteField = 'deleted_at';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

