<?php

namespace App\Services;

use App\Models\UsuariosModel;

class UsuariosServices {
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }

    // 

}