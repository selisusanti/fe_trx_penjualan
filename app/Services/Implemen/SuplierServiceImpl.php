<?php

namespace App\Services\Implemen;


interface SuplierServiceImpl{
    
    public function index($perpage,$page,$search);
    public function store($request);
    public function update($request);
    public function delete($id);
    public function getById($id);
    
}
