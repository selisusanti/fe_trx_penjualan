<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\ProdukService;

class ProdukController extends Controller
{

    private $produkService;
    public function __construct(){
        $this->produkService = new ProdukService();
    }

    public function index(Request $request){
        return view('produk.index');
    }

    public function data(Request $request){
        $nama_url       = "/produk"; 
        $limit          = $request->input('per_page');
        $start          = $request->input('start');
    
        // $page           = Ceil($start/$limit)+1;
        // $search         = $_POST['search'];
        $page           = 1; 
        $search         = $request->input('search');
        $coba           = "";
        $disini         = "15";

        $dataOutput     = $this->produkService->index($limit,$page,$search);
        $totalData      = $dataOutput->data->total;
        $totalFiltered  = $totalData;

        $data           = array();
        if($totalData > 0)
        {
            $nomor = $start+1;
            foreach ($dataOutput->data->data as $key => $value)
            {
                $action_text                        = "";
                $url    = env('API_BASE_URL').$value->picture;
                $nestedData['No']                   = $nomor;
                $nestedData['code']                 = !empty($value->code) ? $value->code : '-';
                $nestedData['product_name']                 = !empty($value->product_name) ? $value->product_name : '-';
                $nestedData['description']                 = !empty($value->description) ? $value->description : '-';
                $nestedData['price']                 = !empty($value->price) ? $value->price : '-';
                $nestedData['stock']                 = !empty($value->stock) ? $value->stock : '-';
                $nestedData['picture']                 = !empty($url) ? env('API_BASE_URL').$url : '-';
                $nestedData['suplier']                 = !empty($value->suplier->name) ? $value->suplier->name : '-';
                $action_text                = $action_text.'<a href="/produk/ubah/'.$value->id.'">
                                                <button type="button" class="btn btn-sm link-button" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil-alt" style="color:#1b3759;"></i>
                                                </button>
                                            </a>'; 
                $action_text                = $action_text.'<button type="button" class="btn btn-sm" id="delete_data" data-toggle="tooltip" data-placement="top" data-id="'.$value->id.'" title="Delete">
                                                <i class="fa fa-trash-alt" style="color:red;"></i>
                                             </button>'; 
                $nestedData['Actions']      = $action_text;                               
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
        return view('produk.tambah');
    }

    
    public function store(Request $request){
        $resp       = $this->produkService->store($request);
        if ($resp->status == true) { 
            Session::flash('success', $resp->message);
            return redirect('/produk');
        }else{
           Session::flash('error', $resp->message);
           return redirect('/produk/tambah')->withInput();
       }
    }



    public function delete($id){
        $resp       = $this->produkService->delete($id);

        if ($resp->status) {
            Session::flash('success', $resp->message);
            return redirect('produk');
        }else{
           Session::flash('error', $resp->message);
           return redirect('produk');
       }
    }

    public function ubah($id){
        $dataOutput     = $this->produkService->getById($id);
        return view('produk.ubah')
        ->with('value', $dataOutput->data);
    }


    public function update(Request $request){
        $resp       = $this->produkService->update($request);
        if ($resp->status == true) { 
            Session::flash('success', $resp->message);
            return redirect('/produk');
        }else{
           Session::flash('error', $resp->message);
           return redirect('/produk/ubah/'.$request->id)->withInput();
       }
    }
}
