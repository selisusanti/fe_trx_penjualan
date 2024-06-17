<?php

namespace App\Services;


use App\Services\ApiHandler;
use App\Services\Implemen\ProdukServiceImpl;
use App\Services\UtilitiesServices;
use Session;


class ProdukService implements ProdukServiceImpl{

    private $utilitiesServices;

    public function __construct() {
        $this->utilitiesServices = new UtilitiesServices;
    }

    public function index($perpage,$page,$search)
    {
        return ApiHandler::request("GET","/api/products?page={$page}&per_page={$perpage}&search={$search}");
    }

    public function save($input)
    {
        return ApiHandler::request("POST","/products",[
            'code'=> $input['code'],
            'product_name'=> $input['product_name'],
            'description'=> $input['description'],
            'price'=> $input['price'],
            'stock'=> $input['stock'],
            'picture'=> $input['picture'] ?? '',
            'insert_by'=> auth()->user()->id,
            'suplier_id'=> $input['suplier_id'],
        ]);
    }

    public function update($request, $id)
    {
        return ApiHandler::request("PUT","/products/{id}",[
            'code'=> $request['code'],
            'product_name'=> $request['product_name'],
            'description'=> $request['description'],
            'price'=> $request['price'],
            'stock'=> $request['stock'],
            'picture'=> $request['picture'] ?? '',
            'suplier_id'=> $request['suplier_id'],
        ]);
    }

    public function delete($id)
    {
        return ApiHandler::request("delete","/products/{id}");
    }

}
