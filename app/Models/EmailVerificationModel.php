<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailVerificationModel extends Model
{
    protected $table = 'email_verifications';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['user_id', 'token_hash', 'expires_at', 'used_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}