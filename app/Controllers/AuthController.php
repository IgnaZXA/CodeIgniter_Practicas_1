<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Controlador reponsable de la gestion de la sesi´´on de un usuario
 */
class AuthController extends BaseController
{

    protected $usuariosModel;

    public function __construct(){
        $this->usuariosModel = new UsuariosModel();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authenticate() : ResponseInterface {
        // Necesito saber la cuesta que se intenta logear y la contraseña que me ha pasado por el formulario de login
        // Una vez lo sepa debo encontrar la tupla en la BD en la que conincidan el la cuenta_usuario del formulario con la de la BD
        // Debo Hashear el contenido de la contraseña para que se pueda comparar, y as´´i poder hacer la compararci´´on con lo que
        // se hay almacenado la BD

        // TODO: Cambiar estas variables por el c´´odigo del servicio.
        $account = $this->request->getPost('cuenta_usuario');   // Coincide con el name del input donde metes la cuenta de usuario.
        $pass    = $this->request->getPost('contrasenia');      // Coincide con el name del input donde metes la cuenta de usuario.
    
        $usuario = $this->usuariosModel
                        ->where('cuenta_usuario', $account)     // Comparaci´´on con el campo en la BD, si no existe --> se devuelve null
                        ->first();                              // Funci´´on para que en lugar de devolver un array solo devuelva el primer objeto de este.    
    
        if (
            !$usuario ||                                        // Si el usuario NO existe
            !password_verify($pass, $usuario['contrasenia']))   // Si se verifica 
        { 
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }

        // Guardar sesión
        session()->set([
            'user_id'    => $usuario['id'],
            'nombre'     => $usuario['nombre'],
            'role_id'    => $usuario['role_id'],
            'logged_in'  => true
        ]);

        return redirect()->to('/users');

    }

        public function logout()
    {
        session()->destroy();
        return redirect()->to('/users');
    }


}
