<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategoriesModel;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

use CodeIgniter\Exceptions\PageNotFoundException;
use Error;
use Throwable;

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
    public function index(): string
    {
        $data['categories'] = $this->productCategoriesModel->findAll();
        return view('/products/productsTable', $data);
    }

    public function create(): string
    {
        $data['categories'] = $this->productCategoriesModel->findAll();
        return view('/products/create', $data);
    }

    public function save(): RedirectResponse
    {
        try {
            $data = [
                'name'              => $this->request->getPost('name'),
                'category_id'       => $this->request->getPost('category_id'),
                'price'             => $this->request->getPost('price'),
                'stock'             => $this->request->getPost('stock'),
            ];

            if (!$this->productsModel->insert($data)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->productsModel->errors());
            }

            return redirect()->to('/products');
        } catch (Throwable $err) {
            log_message('error', '[ProductsController::save]' . $err->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->productsModel->errors());
        }
    }

    public function edit($id): string
    {
        $data['product'] = $this->productsModel->getProductByID($id);
        $data['categories'] = $this->productCategoriesModel->findAll();
        return view('/products/edit', $data);
    }

    public function update($id) : RedirectResponse
    {

        $data = [
            'name'              => $this->request->getPost('name'),
            'category_id'       => $this->request->getPost('category_id'),
            'price'             => $this->request->getPost('price'),
            'stock'             => $this->request->getPost('stock'),
        ];

        if (!$this->productsModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->productsModel->errors());
        }


        // --- REDIRECT / RESPONSE --- //
        return redirect()->to('/products');
    }

    public function delete($id): RedirectResponse
    {
        try {
            $product = $this->productsModel->find($id);

            if (!$product) {
                throw PageNotFoundException::forPageNotFound(); // Genera automaticamente un error 404 gesitonado.
            }

            $this->productsModel->delete($id);
            return redirect()->to('/products');
        } catch (Throwable $err) {
            log_message("error", '[ProductsController::delete]' . $err->getMessage());
            return redirect()->to('/products');
        }
    }

    public function getAllProductsJSON(): ResponseInterface
    {
        try {
            $requestPayload     = $this->productsModel->getProductsWithCategories();
            $response           = $this->response
                ->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON([
                    'status'    =>  'OK',
                    'data'      =>  $requestPayload,
                ]);
            return $response;
        } catch (Throwable $err) {
            log_message('error', '[ProductsController::getAllProductsJSON]' . $err);
            $errResponse        = $this->response
                ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON([
                    'status'    =>  'FAILED',
                    'message'   =>  'Internal Server Error',
                ]);
            return $errResponse;
        }
    }
}
