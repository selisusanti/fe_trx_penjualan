<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\TransaksiService;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{

    private $transaksiService;
    public function __construct(){
        $this->transaksiService = new TransaksiService();
    }

    public function index(Request $request){
        return view('transaksi.index');
    }

    public function data(Request $request){
        $limit          = $request->input('perPage') ;
        $start          = $request->input('start') ;
        
        if($limit != 0 && $start != 0){
            $page           = Ceil($start/$limit)+1;
        }else{
            $page = 1;
        }
        $search         = $request->input('search');
        $coba           = "";
        $disini         = "15";

        $dataOutput     = $this->transaksiService->index($limit,$page,$search);
        $totalData      = $dataOutput->data->total;
        $totalFiltered  = $totalData;

        $data           = array();
        if($totalData > 0)
        {
            $nomor = $start+1;
            foreach ($dataOutput->data->data as $key => $value)
            {
                $action_text                        = "";
                $nestedData['No']                   = $nomor;
                $nestedData['product']              = !empty($value->product->product_name) ? $value->product->product_name : '-';
                $nestedData['suplier']              = !empty($value->product->suplier->name) ? $value->product->suplier->name : '-';
                $nestedData['quantity']             = !empty($value->quantity) ? $value->quantity : '-';
                $nestedData['users']             = !empty($value->users->fullname) ? $value->users->fullname : '-';
                $nestedData['transaction_date']             = !empty($value->transaction_date) ? $value->transaction_date : '-';
                $nestedData['Actions']              = $action_text;                               
                $data[] = $nestedData;
                $nomor++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        echo json_encode($json_data);
    }

    public function tambah(){
        return view('transaksi.tambah');
    }

    
    public function store(Request $request){
        $resp       = $this->transaksiService->store($request);
        if ($resp->status == true) { 
            Session::flash('success', $resp->message);
            return redirect('/transaksi');
        }else{
           Session::flash('error', $resp->message);
           return redirect('/transaksi/tambah')->withInput();
       }
    }

}
