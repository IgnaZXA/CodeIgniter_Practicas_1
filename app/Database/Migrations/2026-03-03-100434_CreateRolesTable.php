<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        // 1º Crear los campos
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 10,
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => false,
            ],

            'rol' => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => false,
            ],
        ]);

        // 2º Declarar la clave primaria
        $this->forge->addKey('id', true);

        // 3º Declarar los campos unique
        $this->forge->addUniqueKey('rol');

        // 4º Finalizar la creaci´´on de la tabla
        $isRolesSuccessfullyCreated = $this->forge->createTable('roles');

        if ($isRolesSuccessfullyCreated) { 
            echo 'Se ha creado exitosamente la tabla roles\n';
        }
    }

    public function down()
    {
        $this->forge->dropTable('roles', true);
    }
}

/* 
| roles | CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci |
*/