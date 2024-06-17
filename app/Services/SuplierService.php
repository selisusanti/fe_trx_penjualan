<?php

namespace App\Services;


use App\Services\ApiHandler;
use App\Services\Implemen\SuplierServiceImpl;
use App\Services\UtilitiesServices;
use Session;


class SuplierService implements SuplierServiceImpl{

    private $utilitiesServices;

    public function __construct() {
        $this->utilitiesServices = new UtilitiesServices;
    }

    public function index($perpage,$page,$search)
    {
        return ApiHandler::request("GET","/api/supliers?page={$page}&per_page={$perpage}&search={$search}");
    }

    public function update($request)
    {
        return ApiHandler::request("PUT","/api/supliers/".$request['id'],[
            'supplier_code'=> $request['supplier_code'],
            'name'=> $request['name'],
            'address'=> $request['address'],
            'pic'=> $request['pic'],
            'phone_number'=> $request['phone_number'],
            'npwp'=> $request['npwp'],
        ]);
    }

    public function delete($id)
    {
        return ApiHandler::request("delete","/api/supliers/$id");
    }

    public function getByID($id)
    {
        return ApiHandler::request("get","/api/supliers/$id");
    }

    public function store($request){
        return ApiHandler::requestMultipart("POST","/api/supliers",[
            'supplier_code'=> $request['supplier_code'],
            'name'=> $request['name'],
            'address'=> $request['address'],
            'pic'=> $request['pic'],
            'phone_number'=> $request['phone_number'],
            'npwp'=> $request['npwp'],
        ]);
    }
    

}
