<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'mobile', 'salary', 'designation', 'city'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|alpha_numeric_space|min_length[3]',
        'email' => 'required|valid_email|is_unique[employees.email]',
        'mobile' => 'required|exact_length[10]|numeric',
        'salary' => 'required',
        'designation' => 'required',
        'city' => 'required',
    ];
    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'Sorry, that email already has taken. Please choose another.',
            'require' => 'Email is required',
            'valid_email' => 'Valid email required',
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
