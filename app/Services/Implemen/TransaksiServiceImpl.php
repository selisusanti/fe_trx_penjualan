<?php

namespace App\Services\Implemen;


interface TransaksiServiceImpl{
    
    public function index($perpage,$page,$search);
    public function save($request);
    public function formatSuplier();
    public function formatProduk();
    public function store($request);
    
}
