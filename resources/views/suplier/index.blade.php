@extends('layouts.simple')
@section('title', 'Panduan dan informasi ')
@section('content')

<section class="profile">
    
    <div class="content">
        <!-- Simple -->
        <h4 style="color: #707070; !important;">Suplier</h4>
        <div class="block block-rounded block-bordered">
            <div class="block-content">
                <h6 style="color: #184a7c; !important;" class="text-left">List Data Suplier </h6>
                <div class="form-group row">
                    <div class="col-md-6 right-margin">
                        <input type="text" class="form-control anti-xss" id="srcField4"  placeholder="Search">
                    </div>

                    <div class="col-md-6 left-margin">
                        <a href="/suplier/tambah">
                            <button class="btn btn-primary float-right link-button">
                                <i class="fa fa-plus"></i> Buat Daftar Baru
                            </button>
                        </a>
                    </div> 
                </div>
                <div class="table-responsive">
                    <table id="table_form" class="table table-bordered table-striped table-vcenter" style="width:100%">
                        <thead class="text-center" style="color: #184a7c; !important;">
                            <tr>
                                <th>No</th>
                                <th>Supplier Code</th>
                                <th>Nama</th>
                                <th>Address</th>
                                <th>PIC</th>
                                <th>Phone number</th>
                                <th>NPWP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>

    <form action="" method="get" id="form-delete" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>

</section>

<script src="{{ asset('/js/custom/gco/cukx-validate.js') }}" type="text/javascript"></script> 
<script type="text/javascript">
    $( document ).ready(function() {
        listdata();

        $("#srcField4").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var filter_data = $('#srcField4').val();
                if(filter_data != '')
                {
                    $('#table_form').DataTable().destroy();
                    listdata(filter_data);
                }
                else
                {
                    $('#table_form').DataTable().destroy();
                    listdata();
                }
            }
        });

        function listdata(filter_data = '',){
            // create table form using datatable
            var table = $('#table_form').DataTable( {
                processing: true,
                serverSide: true,
                ordering  : false,
                ajax:{
                        "url": "/suplier/data",
                        "dataType": "json",
                        "type": "POST",
                        "data":{ 
                                _token: "{{csrf_token()}}",
                                search: filter_data,
                                },
                        error: function(e){
                            // alert(e);
                            if(e.status === 200){
                                alert("Sesi anda telah berakhir. Silahkan login kembali.");
                                window.location = "/";
                            }else{
                                alert("Koneksi ke Aplikasi Eror! Hubungi Bagian Admin!");
                            }
                        }
                    },
                columns: [
                    { "data": "No", "orderable": false},
                    { "data": "supplier_code", "orderable": false},
                    { "data": "name", "orderable": false},
                    { "data": "address", "orderable": false},
                    { "data": "pic", "orderable": false},
                    { "data": "phone_number", "orderable": false},
                    { "data": "npwp", "orderable": false},
                    { "data": "Actions", "orderable": false},
                ],
                language: {
                    search: '',
                    searchPlaceholder: "Search...",
                    paginate: {
                            first: '<i class="fa fa-angle-double-left"></i>',
                            previous: '<i class="fa fa-angle-left"></i>',
                            next: '<i class="fa fa-angle-right"></i>',
                            last: '<i class="fa fa-angle-double-right"></i>'
                        }
                },
	 
            });

            $('.dataTables_filter').addClass('d-none');
        }
        // hide Search Datatable
        $('.dataTables_filter').addClass('d-none');
        $('.dt-user').addClass("hide");

    });


    $(document).on("click", "#delete_data", function(e) {
        e.preventDefault();
        const el       = $(this);
        var id         = el.data('id');
        var link        = "/suplier/delete/"+id;
        $("#form-delete").attr('action', link);

        Swal.fire({
            title: 'Peringatan !',
            text: "Daftar tidak dapat dikembalikan jika Anda menghapus daftar ini, Lanjutkan penghapusan daftar ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.value == true) {
                document.getElementById('form-delete').submit();
            } 
        });
    });
</script>
@endsection