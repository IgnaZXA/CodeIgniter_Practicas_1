<?php

namespace App\Services;

use App\Models\UsuariosModel;
use App\Services\UsuariosServices;

class AuthServices
{
    protected $usuariosModel;
    protected $usuariosServices;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
        $this->usuariosServices = new UsuariosServices();
    }

    public function authenticate(string $account, string $pass)
    {
        $usuario = $this->usuariosServices->getUsuarioByAccount($account);

        if (!$usuario) {
            return null;
        }

        if (!password_verify($pass, $usuario['contrasenia'])) {
            return null;
        }

        return $usuario;
    }

    public function logout()
    {
        session()->destroy();
    }
}
