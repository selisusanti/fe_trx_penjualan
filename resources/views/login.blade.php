<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login Paspor</title>

    <link rel="stylesheet" href="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/slider/slidercaptcha.css') }}">

    @include('layouts.js')

    <script src="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['notify']); });</script>

    <script src="{{ asset('/js/plugins/custom/utilities.js') }}" type="text/javascript"></script> 
    
    <style>
        .slidercaptcha {
            margin: 0 auto;
            width: 354px;
            height: 326px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.125);
            margin-top: 40px;
        }

            .slidercaptcha .card-body {
                padding: 1rem;
            }

            .slidercaptcha canvas:first-child {
                border-radius: 4px;
                border: 1px solid #e6e8eb;
            }

            .slidercaptcha.card .card-header {
                background-image: none;
                background-color: rgba(0, 0, 0, 0.03);
            }

        .refreshIcon {
            top: -54px;
        }
    </style>
</head>
<body class="bg-img">
    <section id="loader" class="hide">
        <div class="overlay top"></div>
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </section>
    <div class="overlay"></div>

    <section class="login">
        <div class="container">
            <div class="row box-bg-login">
                <div class="col-md-5">

                    <div class="box-logosamping">
                        <img src="#" alt="">
                    </div>

                    <h2>
                        Aplikasi<br>Penjualan
                    </h2>
                    
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-3 bg-white">

                    <div class="box-form user fadeIn">
                        <form method="POST" id="formLogin" class="js-validation-signin" action="/auth/login/">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <div class="form-group">
                                <label for="input-user">Email</label>
                                <input type="email" class="form-control form-control-alt" id="credential" name="credential" placeholder="Alamat Email" required />
                            </div>

                            <div class="form-group">
                                <label for="input-user">Password</label>
                                <input type="password" class="form-control form-control-alt" name="password" id="password" placeholder="Kata Sandi" required />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary wd100 d-none" value="Login" id="submit-button" />
                                <input type="button" onclick="modalCaptcha();" class="btn btn-primary wd100" value="Login" />
                            </div>

                            <div class="form-group text-center wd100">
                                <a href="forgot-password" class="updateId" data-id="" >
                                    Lupa Password ?
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="landing-login blue wd100" >
            <div class="col-md-12 text-center">
                <span class="font-w600 text-primary-light" target="_blank"></span>
                <p style="color: white; "> <br>&copy; 2024 | Seli Susanti </p>
            </div>
        </footer>

    </section>

    <!-- Modal Delete User -->
    <div class="modal fade " id="popup-icon" tabindex="-1" role="dialog" aria-labelledby="myPopUpCaptcha" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-content block-themed block-transparent mb-">
                        <div class="slidercaptcha card"> 
                            <div class="card-header">
                                <span>Geser untuk verifikasi</span>
                            </div>
                            <div class="card-body">
                                <div id="captcha"></div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</body>

<!-- onsubmit="$('#loader').removeClass('hide');"> -->
@if(Session::has('error'))
<script type="text/javascript">
    var errorLogin = {!! json_encode(Session::get('error')) !!};

    $(document).ready(function(){
        Dashmix.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: errorLogin
        });
    });
</script>
@endif

    <script src="{{ asset('/js/custom/gco/cukx-validate.js') }}" type="text/javascript"></script>  
    <script src="{{ asset('js/slider/longbow.slidercaptcha.js') }}"></script>
    <script type="text/javascript">
        function modalCaptcha(){
            var credential  = $("#credential").val();
            var password    = $("#password").val();
            if(credential == '' || password == ''){
                $(document).ready(function(){
                    Dashmix.helpers('notify', {
                        type: 'danger',
                        icon: 'fa fa-times mr-1',
                        message: 'Email dan password tidak boleh kosong! '
                    });
                });
            }else{
                $('#popup-icon').modal("show");
            }
        }

        var captcha = sliderCaptcha({
            id:'captcha',
            width: 240,
            height: 195,
            PI: Math.PI,
            sliderL: 42,
            sliderR: 9,
            offset: 5,
            loadingText:'Loading...',
            failedText: 'Coba Lagi',
            barText: 'Geser Puzzle',
            repeatIcon:'fa fa-repeat',
            maxLoadCount: 3,
            onSuccess:function () {
                $('#popup-icon').modal("hide");
                captcha.reset();
                $('#submit-button').click();
            },
            onFail:function () {
            },
            localImages:function () {
                return '{{ asset("media/images/Pic") }}' + Math.round(Math.random() * 4) + '.jpg';
            }
        });
    </script>

</html>
