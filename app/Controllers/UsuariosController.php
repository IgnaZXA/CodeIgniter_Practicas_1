<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\UsuariosModel;
use App\Services\UsuariosServices;
use CodeIgniter\HTTP\RedirectResponse;

class UsuariosController extends BaseController
{
    protected $usuariosModel;
    protected $rolesModel;
    protected $usuariosServices;

    public function __construct()
    {
        $this->usuariosModel    = new UsuariosModel();
        $this->rolesModel       = new RolesModel();
        $this->usuariosServices = new UsuariosServices();
    }

    public function index(): string | RedirectResponse
    {
        $usuario = $this->session->get('logged_in');
        if (!$usuario) return redirect()->to('/users/login');

        // Obtener lista de usuarios
        $data['usuarios'] = $this->usuariosModel->findAll();        // Obtiene la lista de todos los usuarios almacenados en la BD.
        return view('/index', $data);                       // De la vista creada: en app/Views/index
    }

    public function create(): string
    {
        $data['roles']   = $this->rolesModel->findAll();
        return view('usuarios/create', $data);
    }

    public function save(): RedirectResponse
    {
        $data = [
            'nombre'         => $this->request->getPost('nombre'),
            'cuenta_usuario' => $this->request->getPost('cuenta_usuario'),
            'contrasenia'    => $this->request->getPost('contrasenia'),
            'role_id'        => $this->request->getPost('role_id'),
            'status'         => $this->request->getPost('status') ?? 0,
        ];

        if (!$this->usuariosModel->insert($data)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->usuariosModel->errors());
        }

        return redirect()->to('/users');
    }

    public function edit($id): string
    {
        $data['usuario'] = $this->usuariosModel->find($id);
        $data['roles']   = $this->rolesModel->findAll();

        if (!$data['usuario']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('usuarios/edit', $data);
    }


    public function update($id): RedirectResponse
    {

        $data = [
            'nombre'         => $this->request->getPost('nombre'),
            'cuenta_usuario' => $this->request->getPost('cuenta_usuario'),
            'role_id'        => $this->request->getPost('role_id'),
            'contrasenia'    => $this->request->getPost('contrasenia'),
            'status'         => $this->request->getPost('status') ?? 0,
        ];

        if (!$this->usuariosModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->usuariosModel->errors());
        }


        // --- REDIRECT / RESPONSE --- //
        return redirect()->to('/users');
    }

    public function delete($id): RedirectResponse
    {
        $usuario = $this->usuariosModel->find($id);

        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->usuariosModel->delete($id);
        return redirect()->to('/users');
    }
}
