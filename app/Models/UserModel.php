<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'name',
        'email',
        'password_hash',
        'role',
        'status',
        'confirm_email_at',
        'image_path',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

