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
        <h4 style="color: #707070; !important;">Transaksi</h4>
        <div class="block block-rounded block-bordered text-left">
            <div class="block-content">
                <h6 style="color: #184a7c; !important;" class="text-left">Tambah</h6>
                <form action="{{ route('transaksi.store') }}" method="post" id="update-form">
                @csrf
                   <!-- Basic Elements -->
                    <input type="hidden" class="currentId" name="idCurrent" value="1">
                                        
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Product ID</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma anti-xss" 
                                        id="product_id" 
                                        name="product_id" 
                                        placeholder="Product ID" 
                                        value="{{ old('product_id') }}"
                                        min="3"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="quantity" 
                                        name="quantity" 
                                        placeholder="Quantity" 
                                        value="{{ old('quantity') }}"
                                        required>
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