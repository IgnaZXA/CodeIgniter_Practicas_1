<?php

use App\Controllers\AuthController;     // <--- Importar el controlador para la autenticacion
use CodeIgniter\Router\RouteCollection;
use App\Controllers\UsuariosController; // <--- Importar el controlador de usuarios

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// --- Rutas de Usuarios --- //
$routes->get ('/users',                 [UsuariosController::class, 'index'], ['filter' => 'auth'] );         // Muestra listado
$routes->get ('/users/login',           [AuthController::class, 'login'] );         // Muestra listado

$routes->get ('/users/create',          [UsuariosController::class, 'create']);         // Muestra formulario
$routes->post('/users/save',            [UsuariosController::class, 'save']  );         // Procesa el formulario (crear o actualizar)

$routes->get ('/users/edit/(:num)',     [UsuariosController::class, 'edit']  );         // Recibe automaticamente el ID en el m´´etodo edit:  edit($id)
$routes->post('/users/update/(:num)',   [UsuariosController::class, 'update']);         // Actualiza un usuario.

$routes->get ('/users/delete/(:num)',   [UsuariosController::class, 'delete']);         // Elimina el usuario con ese ID. // TODO: Cambiar el GET por POST o DELETE 


$routes->get ('/auth/loginScreen',      [AuthController::class, 'login']);              // Muestra el formulario para logear al usuario
$routes->post('/auth/login',            [AuthController::class, 'authenticate']);       // Logica para autenticar el usuario logeado
$routes->get ('/auth/logout',           [AuthController::class, 'logout']);            // Logica para autenticar el usuario logeado


// --- API REST ENDPOINTS --- //
$routes->get('/api/users',              [UsuariosController::class, 'getAllUsersJSON']);



// $routes->get('/users/edit/(:num)', 'UsuariosController::edit/$1');       // En sintaxis antigua se tiene que poner $1 para indicar que se le pasa el argumento
// $routes->get('/users/edit/(:num)', [UsuariosController::class, 'edit']); // En sintaxis moderna no hace falta el uso de $1, $2, ...