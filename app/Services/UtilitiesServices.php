<?php

namespace App\Services;

use App\Constants\Constant;
use App\Services\ApiHandler;

class UtilitiesServices{

    # function :
        # to filtering data array with
    # params :
        # array = array that will filtering
        # object = name of object
        # value = value of object

    public static function getFilteringData($array, $object, $value) {
        $filter_data = array();
        foreach ($array as $data) {
            if ($data->$object == $value) {
                array_push($filter_data,$data);
            }
        }
        return $filter_data;
    }
    

}

