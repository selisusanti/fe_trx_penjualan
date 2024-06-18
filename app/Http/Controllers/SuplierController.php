<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\SuplierService;

class SuplierController extends Controller
{

    private $suplierService;
    public function __construct(){
        $this->suplierService = new SuplierService();
    }

    public function index(Request $request){
        $limit = '';
        $page  = '';
        $search = '';
        $dataOutput     = $this->suplierService->index($limit,$page,$search);
        // dd($dataOutput->data->links);
        return view('suplier.index')
            ->with('suplier',$dataOutput);
    }

    public function data(Request $request){
        $nama_url       = "/produk"; 
        $limit          = $request->input('per_page');
        $start          = $request->input('start');
        $limit          = $request->input('limit') ?? 0;
    
        if($limit == 0){
            $page = 1;
        }else{
            $page           = Ceil($start/$limit)+1;
        }
        $search         = $request->input('search');
        $coba           = "";
        $disini         = "10";

        $dataOutput     = $this->suplierService->index($limit,$page,$search);
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
                $nestedData['supplier_code']                 = !empty($value->supplier_code) ? $value->supplier_code : '-';
                $nestedData['name']                 = !empty($value->name) ? $value->name : '-';
                $nestedData['address']              = !empty($value->address) ? $value->address : '-';
                $nestedData['pic']                 = !empty($value->pic) ? $value->pic : '-';
                $nestedData['phone_number']                 = !empty($value->phone_number) ? $value->phone_number : '-';
                $nestedData['npwp']                 = !empty($value->npwp) ? $value->npwp : '-';
                $action_text                = $action_text.'<a href="/suplier/ubah/'.$value->id.'">
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
        return view('suplier.tambah');
    }

    
    public function store(Request $request){
        $resp       = $this->suplierService->store($request);
        if ($resp->status == true) { 
            Session::flash('success', $resp->message);
            return redirect('/suplier');
        }else{
           Session::flash('error', $resp->message);
           return redirect('/suplier/tambah')->withInput();
       }
    }



    public function delete($id){
        $resp       = $this->suplierService->delete($id);

        if ($resp->status) {
            Session::flash('success', $resp->message);
            return redirect('suplier');
        }else{
           Session::flash('error', $resp->message);
           return redirect('suplier');
       }
    }

    public function ubah($id){
        $dataOutput     = $this->suplierService->getById($id);
        return view('suplier.ubah')
        ->with('value', $dataOutput->data);
    }


    public function update(Request $request){
        $resp       = $this->suplierService->update($request);
        if ($resp->status == true) { 
            Session::flash('success', $resp->message);
            return redirect('/suplier');
        }else{
           Session::flash('error', $resp->message);
           return redirect('/suplier/ubah/'.$request->id)->withInput();
       }
    }
}
