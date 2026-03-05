<?php

namespace App\Services;

use App\Models\UsuariosModel;

class UsuariosServices {
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }


    // --- READ --- //
    public function getUsuarioById($id)
    {
        return $this->usuariosModel->where('id', $id);
    }

    public function getUsuarioByAccount($account)
    {
        return $this->usuariosModel->where("cuenta_usuario", $account)->first();
    }

    // --- WRITE --- //

}