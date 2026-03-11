<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category_id',
        'name',
        'price',
        'stock',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = 
    [
        'category_id'   => 'required',
        'name'          => 'required',
        'price'         => 'required',
        'stock'         => 'required',
    ];

    protected $validationMessages   = 
    [
        'category_id'   => [    'required'  => 'El category_id es obligatorio'              ],
        'name'          => [    'required'  => 'El nombre del producto es obligatorio'      ],
        'price'         => [    'required'  => 'El precio del producto es obligatorio'      ],
        'stock'         => [    'required'  => 'El stock del producto es obligatorio'       ],
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getProductByID($id) {
        return $this->find($id);
    }

    /**
     * @return array
     */
    public function getProductsWithCategories(): array  { // TODO: Tipar resultado
        return $this
        ->select('products.*, product_categories.category_name')
        ->join('product_categories', 'product_categories.id = products.category_id')
        ->findAll();
    }
}
