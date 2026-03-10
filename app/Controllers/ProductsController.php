<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategoriesModel;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

// TODO: Tipar
class ProductsController extends BaseController
{

    // ---- ATTRIBUTES ---- //
    protected $productsModel;
    protected $productCategoriesModel; 

    // ---- BUILDER ---- //
    public function __construct()
    {
        $this->productsModel            = new ProductsModel();
        $this->productCategoriesModel   = new ProductCategoriesModel();
    }

    // ---- METHODS ---- //
    public function index() 
    {
        $data['categories'] = $this->productCategoriesModel->findAll(); 
        return view('/products/productsTable', $data);
    }

    public function create(){

    }

    public function save(){

    }

    public function edit(){

    }

    public function update($id){

    }

    public function delete($id){

    }

    public function getAllProductsJSON(){

    }




}
