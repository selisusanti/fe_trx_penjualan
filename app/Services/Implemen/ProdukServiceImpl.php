<?php

namespace App\Services\Implemen;


interface ProdukServiceImpl{
    
    public function index($perpage,$page,$search);
    public function save($request);
    public function update($request, $id);
    public function delete($id);
    
}
