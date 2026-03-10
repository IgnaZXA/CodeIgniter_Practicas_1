<?php

namespace App\Services;

use App\Models\ProductsModel;


class ProductServices {
    protected $productsModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
    }

} 