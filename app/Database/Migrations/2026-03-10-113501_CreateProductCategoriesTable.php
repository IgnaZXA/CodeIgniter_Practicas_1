<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoriesTable extends Migration
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

            'category_name'      =>
            [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
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

        // 3º Crear uniques
        $this->forge->addUniqueKey('category_name');

        // 4º Confirmar la creacion de la tabla
        $this->forge->createTable('product_categories');
    }

    public function down()
    {
        $this->forge->dropTable('product_categories', true);
    }
}
