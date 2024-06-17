@extends('layouts.simple')
@section('title', 'Tambah User')
@section('js_before')
    <script src="{{ asset('/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>    
    <script>jQuery(function(){ Dashmix.helpers(['maxlength']); });</script>
@endsection

@section('content')
<section class="profile">
    
    <div class="content">
        <!-- Simple -->
        <h4 style="color: #707070; !important;">Produk</h4>
        <div class="block block-rounded block-bordered text-left">
            <div class="block-content">
                <h6 style="color: #184a7c; !important;" class="text-left">Tambah</h6>
                <form action="{{ route('produk.store') }}" method="post" id="update-form" enctype="multipart/form-data">
                @csrf
                   <!-- Basic Elements -->
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Code</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma anti-xss" 
                                        id="code" 
                                        name="code" 
                                        placeholder="code" 
                                        value="{{ old('code') }}"
                                        min="3"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Product Name</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma" 
                                        id="product_name" 
                                        name="product_name" 
                                        placeholder="product_name" 
                                        value="{{ old('product_name') }}"
                                        required>
                            </div>
                        </div>
                    </div>       

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma anti-xss" 
                                        id="description" 
                                        name="description" 
                                        placeholder="description" 
                                        value="{{ old('description') }}"
                                        min="3"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="price" 
                                        name="price" 
                                        placeholder="price" 
                                        value="{{ old('price') }}"
                                        required>
                            </div>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Stock</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="stock" 
                                        name="stock" 
                                        placeholder="Stock" 
                                        value="{{ old('stock') }}"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Suplier ID</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="suplier_id" 
                                        name="suplier_id" 
                                        placeholder="suplier_id" 
                                        value="{{ old('suplier_id') }}"
                                        required>
                            </div>
                        </div>
                    </div>
                       
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Picture</label>
                            <div class="col-sm-12">
                                <input
                                    accept="image/*"
                                    type="file" 
                                    class="custom-file-input" 
                                    data-toggle="custom-file-input" 
                                    id="create-picture" 
                                    name="picture"
                                    required
                                >
                            <label class="custom-file-label" for="create-picture">Choose Picture</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-primary btn-sm submit-loader btnSave" id="btn-password" value="Buat Daftar Baru">
                        <a href="/transaksi">
                            <input type="button" class="btn btn-primary btn-sm submit-loader" id="btn-password" value="Batalkan">
                        </a>
                    </div>

                    <!-- END Input Grid Sizes -->
                </form>
            </div>
            </form>
        </div> 
    </div>
    <script src="{{ asset('/js/custom/gco/cukx-validate.js') }}" type="text/javascript"></script> 
</section>

<script type="text/javascript">
    $('.btnSave').click(function (e) {
        Swal.fire({
            title: 'Apakah Kamu Yakin ?',
            text: "Untuk Melanjutkan proses ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut'
        }).then((result) => {
            if (result.value == true) {
                $('#update-form').submit();
            } 
        });
    }); 

</script>
@endsection