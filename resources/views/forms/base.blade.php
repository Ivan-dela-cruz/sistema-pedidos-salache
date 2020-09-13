<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link href="{{asset('form/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('form/assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('form/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('form/assets/css/argon.css?v=1.0.1')}}" rel="stylesheet">
    <!-- Docs CSS -->
    <link type="text/css" href="{{asset('form/assets/css/docs.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('sweetalert2/dist/sweetalert2.min.css')}}"/>
</head>

<body>
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="{{route('index')}}">
                <img style="height: 75px;width: 100px;" src="{{asset('img/utcblanco.png')}}">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                    aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{route('index')}}">
                                <img src="{{asset('img/utccolor.png')}}">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <h4 class="text-white">Tienda Virtual UTC</h4>

                </ul>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#" target="_blank"
                           data-toggle="tooltip" title="Visita nuestro Facebook">
                            <i class="fa fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Facebook</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <section class="section section-shaped section-lg">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-md">
        	@yield('content')
            
        </div>
    </section>
</main>
<footer class="footer">
    <div class="container">
        <div class="row row-grid align-items-center mb-5">
            <div class="col-lg-7">
                <h3 class="text-primary font-weight-light mb-2">¡Unete y forma parte de esta iniciativa!</h3>
                <h4 class="mb-0 font-weight-light">Encuentra mas información del servicio de ventas y entregas online
                    UTC en nuestras redes sociales.</h4>
            </div>
            <div class="col-lg-5 text-lg-center btn-wrapper">
                <a target="_blank" href="#"
                   class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip"
                   data-original-title="Visita nuestro Facebook">
                    <i class="fa fa-facebook-square"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
                <div class="copyright">
                    &copy; 2020
                    <a href="https://www.creative-tim.com" target="_blank">UTC</a>.
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- Core -->
<script src="{{asset('form/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('form/assets/vendor/popper/popper.min.js')}}"></script>
<script src="{{asset('form/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('form/assets/vendor/headroom/headroom.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('form/assets/js/argon.js?v=1.0.1')}}"></script>
<script src="{{asset('sweetalert2/dist/sweetalert2.all.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.mask.js')}}"></script>
@yield('scripts')

</body>

</html>
