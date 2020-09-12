<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Repatirdor UTC</title>
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
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-white pb-2">
                            <div class="text-muted text-center mb-2">
                                <h5>Formulario Solicitud  Repartidor</h5>
                            </div>
                            @if (session('status'))
                                @if (session('status')!="error")
                                    <div class="alert alert-success mr-3 ml-3">
                                        <a href="#" class="close" data-dismiss="alert"
                                           aria-label="close">&times;</a> {{ session('status') }}
                                    </div>
                                @else
                                    <div class="alert alert-danger mr-3 ml-3">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Se
                                        presentó un inconveniente con esta petición. Por favor contacta con el
                                        administrador
                                    </div>

                                @endif
                            @endif
                        </div>
                        <div class="card-body ">
                            {!! Form::open(['url' => 'store-deliveryman','files' => true,'id'=>'form_en']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Datos del solicitante</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>
                                            {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nombres']) !!}


                                        </div>
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>

                                            {!! Form::text('last_name', null, ['class'=>'form-control','placeholder'=>'Apellidos']) !!}
                                        </div>
                                    </div>
                                    @error('last_name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                            </div>
                                            {!! Form::text('ci', null, ['class'=>'form-control','placeholder'=>'Documento de identificación']) !!}
                                        </div>
                                    </div>
                                    @error('ci')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                            </div>
                                            {!! Form::text('address', null, ['class'=>'form-control','placeholder'=>'Dirección']) !!}
                                        </div>
                                    </div>
                                    @error('address')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-mobile-button"></i></span>
                                            </div>
                                            {!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'Télefono']) !!}
                                        </div>
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Correo electrónico']) !!}
                                        </div>
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <h6>Datos del vehículo</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-bus-front-12"></i></span>
                                            </div>

                                            {!! Form::text('vehicle_make', null, ['class'=>'form-control','placeholder'=>'Marca']) !!}
                                        </div>
                                    </div>
                                    @error('vehicle_make')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-bus-front-12"></i></span>
                                            </div>
                                            {!! Form::select('vehicle_type', $vehicles,null, ['class'=>'form-control']) !!}

                                        </div>
                                    </div>
                                    @error('vehicle_type')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-bus-front-12"></i></span>
                                            </div>
                                            {!! Form::text('vehicle_plate', null, ['class'=>'form-control','placeholder'=>'Placa']) !!}
                                        </div>
                                    </div>
                                    @error('vehicle_plate')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-bus-front-12"></i></span>
                                            </div>

                                            {!! Form::text('vehicle_year', null, ['class'=>'form-control','placeholder'=>'Año']) !!}
                                        </div>
                                    </div>
                                    @error('vehicle_year')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="text-muted">Seleccione su convenio
                                        <small> (<span class="text-info font-weight-700">Importante! </span>  Si no tiene un convenio acepte nuestros términos y condiciones)</small>
                                    </label>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">

                                                <button id="btn_download_convenio" type="button"  class="btn btn-sm btn-success"><i
                                                        class="ni ni-cloud-download-95"></i> Descargar convenio</button>
                                            </div>
                                            <select class="form-control" name="id_convenio" id="id_convenio">
                                                <option value="not">No tengo un convenio</option>
                                                @foreach ($convenios as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    @error('id_convenio')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-file pb-3">

                                        {!! Form::file('url_file', ['class'=>'custom-file-input pb-3','id'=>'customFile']) !!}
                                        <label class="custom-file-label" for="customFile">Documento PDF: copia cédula o
                                            pasaporte y certificado de votación</label>
                                        @error('url_file')
                                        <div class="alert alert-danger alert-dismissible fade show pb-3" role="alert">
                                            {{ $message }}.
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="" class="text-muted">

                                        <small> <span class="text-info font-weight-700">Importante! </span>  Subir la copia de sus documentos personales y ruc de la empresa si lo tiene , datos llenos  y convenio firmado . Importante subir  un solo  documento generado en pdf.</small>

                                    </label>

                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label class="text-muted" for="">Describe brevemente tu vehículo</label>
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-ruler-pencil"></i></span>
                                            </div>
                                            {!! Form::textarea('vehicle_description',null, ['class'=>'form-control']) !!}

                                        </div>
                                    </div>
                                    @error('vehicle_description')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-check form-check-inline">
                                <label id="rd_not">
                                    <input name="convenio" value="not" id="check_terminos" type="checkbox">
                                    Acepto términos y condiciones
                                   </label>
                                <br>
                            </div>
                            <div class="text-muted font-italic">
                                 <small>
                                    <span class="text-success font-weight-700">¡Importante!</span>
                                    Para continuar con el proceso de registro nuestros operadores se comunicarán contigo
                                    en una periodo de 72 horas para verificar la información proporcionada.

                                </small>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary mt-4 btn-save">Crear cuenta</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
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
<script type="text/javascript">

    $(document).ready(function(){
     //  alert('entro');

    });
    $(document).on("click", "#btn_download_convenio", function (e) {
        let value_select = $('#id_convenio').val();
        let id = 0;
        if(value_select !="not" ){
            id = value_select;
        }
        if(id !=0){
            let url = "../download-word-convenio/"+id;
            window.location.href=url;
        }
    });
    $(document).on("click", "#rd_not", function(e) {
      //  $('.permisos').attr("hidden",true);
       // alert('not');
    });

    $(document).on("click", ".btn-save", function(e) {

      var valor = $('#id_convenio').val();
      if(valor=="not"){
        if( $('#check_terminos').prop('checked') ) {


        $('#form_en').submit();

        }else
        {
            alert("Si no tiene un convenio acepte nuestros terminos y condiciones");
        }


      }else{
        $('#form_en').submit();
      }


    });
    </script>
</body>

</html>
