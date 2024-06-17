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
        <h4 style="color: #707070; !important;">Suplier</h4>
        <div class="block block-rounded block-bordered text-left">
            <div class="block-content">
                <h6 style="color: #184a7c; !important;" class="text-left">Ubah</h6>
                <form action="{{ route('suplier.update') }}" method="post" id="update-form" enctype="multipart/form-data">
                @csrf
                 <input type="hidden" class="id" name="id" value="{{ $value->id }}">

                   <!-- Basic Elements -->
                   <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Code Suplier</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma anti-xss" 
                                        id="supplier_code" 
                                        name="supplier_code" 
                                        placeholder="supplier_code" 
                                        value="{{ $value->supplier_code }}"
                                        min="3"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma" 
                                        id="name" 
                                        name="name" 
                                        placeholder="name" 
                                        value="{{ $value->name }}"
                                        required>
                            </div>
                        </div>
                    </div>       

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma anti-xss" 
                                        id="address" 
                                        name="address" 
                                        placeholder="address" 
                                        value="{{ $value->address }}"
                                        min="3"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">PIC</label>
                            <div class="col-sm-12">
                                <input type="text" 
                                        class="form-control fullname-uma" 
                                        id="pic" 
                                        name="pic" 
                                        placeholder="pic" 
                                        value="{{ old('pic') ?? $value->pic }}"
                                        required>
                            </div>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="phone_number" 
                                        name="phone_number" 
                                        placeholder="phone_number" 
                                        value="{{ old('phone_number') ?? $value->phone_number }}"
                                        required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-sm-3 col-form-label">NPWP</label>
                            <div class="col-sm-12">
                                <input type="number" 
                                        class="form-control fullname-uma" 
                                        id="npwp" 
                                        name="npwp" 
                                        placeholder="npwp" 
                                        maxlength="16"
                                        value="{{ old('npwp') ?? $value->npwp }}"
                                        required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-primary btn-sm submit-loader btnSave" id="btn-password" value="Buat Daftar Baru">
                        <a href="/suplier">
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