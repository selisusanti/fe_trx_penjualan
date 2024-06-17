@extends('layouts.simple')
@section('title', 'Profile')
@section('content')

<section class="profile">
    @if(\Session::has('alert-success'))
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <p class="mb-0">{{Session::get('alert-success')}}</p>
        </div>
    @endif

    @if(\Session::has('alert-danger'))
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <p class="mb-0">{{Session::get('alert-danger')}}</p>
        </div>
    @endif
    <div class="content">
        <!-- Simple -->
        <h4 style="color: #707070; !important;">APLIKASI PENJUALAN</h4>
        <div class="block block-rounded block-bordered text-center">
            <div class="block-content">
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <!-- <img class="img-avatar img-avatar96" src="{{ asset('/media/errors/404/notset.png') }}" alt=""> -->
                    <div class="col-12 text-left border-right">
                        <p class="font-w600 mb-0"><b> Hai <b>{{ Session::get('user_detail')->fullname }}</p>
                        <p class="font-size-xl font-italic text-muted mb-0">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        <br> when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, <br>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </p>
                    </div>

                </div>
            </div>
        </div>   
    </div>

</section>
@endsection