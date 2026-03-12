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
        'category_id'   => ['required'  => 'El category_id es obligatorio'],
        'name'          => ['required'  => 'El nombre del producto es obligatorio'],
        'price'         => ['required'  => 'El precio del producto es obligatorio'],
        'stock'         => ['required'  => 'El stock del producto es obligatorio'],
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


    public function getProductByID($id)
    {
        return $this->find($id);
    }

public function getProductsWithCategories(
    int $limit,
    int $offset,
    bool $isAllSelected,
    array $filters,
    $order
): array {

    $builder = $this
        ->select('products.*, product_categories.category_name')
        ->join('product_categories', 'product_categories.id = products.category_id');

    // ---- FILTROS ---- //

    if (!empty($filters['id'])) {
        $builder->like('products.id', $filters['id']);
    }

    if (!empty($filters['name'])) {
        $builder->like('products.name', $filters['name']);
    }

    if (!empty($filters['price'])) {
        $builder->like('products.price', $filters['price']);
    }

    if (!empty($filters['stock'])) {
        $builder->like('products.stock', $filters['stock']);
    }

    if (!empty($filters['category_name'])) {
        $builder->like('product_categories.category_name', $filters['category_name']);  // 'category_name' => $columns[4]['search']['value']
    }

    // ---- ORDENACIÓN ---- //

    $columnMap = [
        0 => 'products.id',
        1 => 'products.name',
        2 => 'products.price',
        3 => 'products.stock',
        4 => 'product_categories.category_name'
    ];

    if (!empty($order)) {

        $columnIndex = $order[0]['column'];
        $direction   = $order[0]['dir'];

        if (isset($columnMap[$columnIndex])) {
            $builder->orderBy($columnMap[$columnIndex], $direction);
        }
    }

    // ---- PAGINACIÓN ---- //

    if ($isAllSelected) {
        return $builder->findAll();
    }

    return $builder->findAll($limit, $offset);
}
}
