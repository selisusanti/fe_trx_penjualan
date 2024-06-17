<?php

namespace App\Services;


use App\Services\ApiHandler;
use App\Services\Implemen\TransaksiServiceImpl;
use App\Services\UtilitiesServices;
use Session;


class TransaksiService implements TransaksiServiceImpl{

    public function index($perpage,$page,$search){
        return ApiHandler::request("GET","/api/transaksi?page={$page}&per_page={$perpage}&search={$search}");
    }

    //insert kanim 
    public function store($request){
        return ApiHandler::request("POST","/api/transaksi",[
            "product_id" => $request['product_id'],
            "quantity" => $request['quantity'],
        ]);
    }


    public function save($request){
        return "ok";
    }

    public function formatSuplier(){
        return true;
    }

    public function formatProduk(){
        return true;
    }

}
