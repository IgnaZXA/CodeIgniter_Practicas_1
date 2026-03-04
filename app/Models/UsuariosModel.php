<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre',
        'status',
        'cuenta_usuario',
        'contrasenia',
        'role_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword']; // Se actualiza sobre el valor del formulario que se le ha dado a la contraseña
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Al usar esta funci´´on en un callback como $beforeInsert 
    // Te da array con un primer valor como 'data', que contiene los 
    // campos declarados en $allowedFields
    protected function hashPassword(array $data) 
    {
        if (isset($data['data']['contrasenia'])) { // Se comprueba que el array contiene el campo contrasenia
            $data['data']['contrasenia'] = password_hash(
                $data['data']['contrasenia'],
                PASSWORD_DEFAULT // Algoritmo de hashing por defecto de php
            );
        }
        return $data;
    }
}
