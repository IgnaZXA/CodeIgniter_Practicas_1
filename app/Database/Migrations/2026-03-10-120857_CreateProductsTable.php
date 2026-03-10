<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        // 1º Crear los campos
        $this->forge->addField([
            'id'        =>
            [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],

            'category_id'  =>
            [
                'type'              => 'INT',
                'unsigned'          => true,
                'null'              => false,
            ],

            'name'      =>
            [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => false,
            ],

            'price'     =>
            [
                'type'              => 'DECIMAL',
                'constraint'        => '10,2',
                'unsigned'          => true,
                'null'              => false,
            ],

            'stock'     =>
            [
                'type'              => 'INT',
                'unsigned'          => true,
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
        ]);

        // 2º Crear claves primarias
        $this->forge->addKey('id', true);


        // 3º Crear FKs
        $this->forge->addKey('category_id', false);
        $this->forge->addForeignKey( // Setup
            'category_id',
            'product_categories',
            'id',
            'CASCADE',
            'RESTRICT' // En lugar de NO ACTION que evita que borres siempre, mejor para un campo como categorias, pon RESTRICT y as´´i, solo borras puedes borrar un rol si no hay ning´´un usuario con ese rol.
        );

        // 4º Confirmar la creacion de la tabla
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
