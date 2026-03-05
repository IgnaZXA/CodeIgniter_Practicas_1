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

    public function index() : string | RedirectResponse
    {   
        $usuario = $this->session->get('logged_in');
        if(!$usuario) return redirect()->to('/users/login');

        // Obtener lista de usuarios
        $data['usuarios'] = $this->usuariosModel->findAll();        // Obtiene la lista de todos los usuarios almacenados en la BD.
        return view('usuarios/index', $data);                       // De la vista creada: en app/Views/index
    }

    public function create() : string
    {
        $data['roles']   = $this->rolesModel->findAll();
        return view('usuarios/create', $data);
    }

    public function save() : RedirectResponse
    {
        // TODO: Las validaciones se encarga el modelo de efectuarlas.

        // --- VALIDATIONS --- //
        $rules = [
            'nombre'            => 'required|min_length[3]',
            'cuenta_usuario'    => 'required|min_length[3]',
            'role_id'           => 'required|integer|is_not_unique[roles.id]' // Con is_not_unique[roles.id] te aseguras de que role_id no tenga un valor que no exista en el campo id de la tabla roles de la BD
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->to('/users/create')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->usuariosModel->insert([
            'nombre'         => $this->request->getPost('nombre'),
            'cuenta_usuario' => $this->request->getPost('cuenta_usuario'),
            'contrasenia'    => $this->request->getPost('contrasenia'),
            'role_id'        => $this->request->getPost('role_id'),
            'status'         => $this->request->getPost('status') ?? 0,
        ]);

        return redirect()->to('/users');
    }

    public function edit($id) : string
    {
        $data['usuario'] = $this->usuariosModel->find($id);
        $data['roles']   = $this->rolesModel->findAll();

        if (!$data['usuario']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('usuarios/edit', $data);
    }


    public function update($id) : RedirectResponse
    {

        // --- VALIDATIONS --- //
        $rules = [
            'nombre'            => 'required|min_length[3]',
            'cuenta_usuario'    => 'required|min_length[3]',
            'contrasenia'       => 'required|min_length[3]',
            'role_id'           => 'permit_empty|integer|is_not_unique[roles.id]'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // --- SERVICE CALLS --- //
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


        // --- REDIRECT / RESPONSE --- //
        return redirect()->to('/users');
    }

    public function delete($id) : RedirectResponse
    {
        $usuario = $this->usuariosModel->find($id);

        if (!$usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->usuariosModel->delete($id);
        return redirect()->to('/users');
    }
}
