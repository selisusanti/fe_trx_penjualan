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

    public function update($request)
    {
        return ApiHandler::request("PUT","/api/products/".$request['id'],[
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
        return ApiHandler::request("delete","/api/products/$id");
    }

    public function getByID($id)
    {
        return ApiHandler::request("get","/api/products/$id");
    }

    public function store($request){
        return ApiHandler::requestMultipart("POST","/api/products",[
            "code" => $request['code'],
            "product_name" => $request['product_name'],
            "description" => $request['description'],
            "price" => $request['price'],
            "stock" => $request['stock'],
            "picture" => $request['picture'],
            "suplier_id" => $request['suplier_id'],
        ]);
    }
    

}
