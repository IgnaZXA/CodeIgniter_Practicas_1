<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
{
    public function up() // Se ejecuta al correr el comando `php spark migrate`
    {
        // 1º Crear los campos
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 10,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],

            'nombre' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => false,
            ],

            'status' => [
                'type'             => 'BOOL',
                'null'              => false,
            ],

            'cuenta_usuario' => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => false,
            ],

            'contrasenia' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255, // Valor importante para hashes
                'null'              => false,

            ],

            'created_at' => [ 
                'type'              => 'DATETIME',
                'null'              => true,
            ],

            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],

            'role_id' => [
                'type'              => 'INT',
                'constraint'        => 10,
                'unsigned'          => true,
            ],

        ]);

        // 2º Definir la clave Primaria
        $this->forge->addKey('id', true);

        // 3º Definir campos Unique
        $this->forge->addUniqueKey('cuenta_usuario');

        // 4º Crear y configurar la clave secundaria
        $this->forge->addKey('role_id'); // Creation
        $this->forge->addForeignKey( // Setup
            'role_id',
            'roles',
            'id',
            'CASCADE',
            'RESTRICT' // En lugar de NO ACTION que evita que borres siempre, mejor para un campo como roles, pon RESTRICT y as´´i, solo borras puedes borrar un rol si no hay ning´´un usuario con ese rol.
        );


        // 5º Terminar de crear la tabla usuarios
        $isUsuariosSuccessfullyCreated = $this->forge->createTable('usuarios');
        if ($isUsuariosSuccessfullyCreated)  {
            echo 'Se ha creado la tabla usuarios correctamente.\n' ;
        }
    }

    public function down()
    {
        $this->forge->dropTable('usuarios', true);
    }
}