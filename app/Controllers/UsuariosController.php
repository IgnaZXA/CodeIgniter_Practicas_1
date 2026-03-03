<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class UsuariosController extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }

    public function index(){
        // Obtener lista de usuarios
        $data['usuarios'] = $this->usuariosModel->findAll();    // Obtiene la lista de todos los usuarios almacenados en la BD.
        return view('usuarios/index', $data);                      // De la vista creada: en app/Views/index
    }

    public function create()
    {
        return view('usuarios/create');
    }

    public function save()
    {
        $this->usuariosModel->insert([
            'nombre'         => $this->request->getPost('nombre'),
            'cuenta_usuario' => $this->request->getPost('cuenta_usuario'),
            'contrasenia'    => $this->request->getPost('contrasenia'),
            'role_id'        => $this->request->getPost('role_id'),
            'status'         => $this->request->getPost('status') ?? 0,
        ]);

        return redirect()->to('/users');
    }

    public function edit($id){
        $usuario = $this->usuariosModel->find($id);

        if (!$usuario){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('usuarios/edit', [
            'usuario' => $usuario
        ]);
    }


    public function update($id)
    {
        $data = [
            'nombre'         => $this->request->getPost('nombre'),
            'cuenta_usuario' => $this->request->getPost('cuenta_usuario'),
            'role_id'        => $this->request->getPost('role_id'),
            'status'         => $this->request->getPost('status') ?? 0,
        ];

        // Solo actualizar contraseña si se escribió algo
        if ($this->request->getPost('contrasenia')) {
            $data['contrasenia'] = $this->request->getPost('contrasenia');
        }

        $this->usuariosModel->update($id, $data);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $usuario = $this->usuariosModel->find($id);

        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->usuariosModel->delete($id);

        return redirect()->to('/users');
    }

}