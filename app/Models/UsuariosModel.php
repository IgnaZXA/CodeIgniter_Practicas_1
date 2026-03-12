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
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // -> No hay un campo deleted_at

    // Validation
    protected $validationRules      = [
        'nombre'            => 'required|min_length[3]',
        'cuenta_usuario'    => 'required|min_length[3]',
        'contrasenia'       => 'required|min_length[3]',
        'role_id'           => 'required|integer|is_not_unique[roles.id]' // Con is_not_unique[roles.id] te aseguras de que role_id no tenga un valor que no exista en el campo id de la tabla roles de la BD
    ];

    protected $validationMessages   = [
        'nombre'    => [
            'required'      => 'El nombre es obligatorio',
            'min_length'    => 'El nombre debe tener al menos 3 caracters'
        ],
        'cuenta_usuario' => [
            'required'      => 'Es necesario añadir una cuenta de usuario',
            'min_length'    => 'La cuenta de usuario debe tener al menos 3 caracteres',
        ],
        'contrasenia' => [
            'required'      => 'Es necesario añadir la contraseña de usuario',
            'min_length'    => 'La cuenta de usuario debe tener al menos 3 caracteres'
        ],
    ];
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
    /** 
     * @return array<int, array<string, mixed>>
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['contrasenia'])) { // Se comprueba que el array contiene el campo contrasenia
            $data['data']['contrasenia'] = password_hash(
                $data['data']['contrasenia'],
                PASSWORD_DEFAULT // Algoritmo de hashing por defecto de php
            );
        }
        return $data;
    }

    /**
     * @return array<int, array{
     *     id:int,
     *     nombre:string,
     *     cuenta_usuario:string,
     *     rol:string,
     *     contrasenia:string
     * }>>
     */
    public function getUsersWithRoles(): array
    {
        return $this->select('usuarios.*, roles.rol')
            ->join('roles', 'roles.id = usuarios.role_id')
            ->findAll();
    }


    // TODO: Tipar bien el resutlado de las funciones
    
    // --- READ --- //
    public function getUsuarioById($id) : array
    {
        return $this->where('id', $id)->first();
    }

    public function getUsuarioByAccount($account) : array
    {
        return $this->where("cuenta_usuario", $account)->first();
    }

    // --- WRITE --- //
}
