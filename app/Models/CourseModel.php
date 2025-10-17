<?php

namespace App\Models;
use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = "courses";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'name',
        'description',
        'teacher_owner_id',
    ];
    protected $deleteField = 'deleted_at';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}