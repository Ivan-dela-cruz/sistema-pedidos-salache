
@extends('admin.base.index')

@section('content')

         
            <div class="page-heading">
                <h1 class="page-title">Perfil del usuario</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Mi perfil</li>
                </ol>
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
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="ibox">
                            <div class="ibox-body text-center">
                                <div class="m-t-20">
                                    <img class="img-circle" src="{{ asset($user->url_image) }}" />
                                </div>
                                <h5 class="font-strong m-b-10 m-t-10">{{$user->name}}</h5>
                                <div class="m-b-20 text-muted">{{$roles_name = Auth::user()->getRoleNames()->first()}}</div>
                                
                               
                            </div>
                        </div>
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row text-left m-b-20">
                                    <div class="col-12">
                                        <div class="font-24 profile-stat-count">Email</div>
                                        <div class="text-muted">{{$user->email}}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="font-24 profile-stat-count">Télefono</div>
                                        <div class="text-muted">{{$user->phone}}</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="font-24 profile-stat-count">Usario</div>
                                        <div class="text-muted">{{$user->username}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="ibox">
                            <div class="ibox-body">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-settings"></i> Permisos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-book"></i> Mis datos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-lock"></i> Contraseña</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-1">
                                       
                                        <h4 class="text-info m-b-20 m-t-20"><i class="ti-desktop"></i> Acciones</h4>
                                        <table class="table table-striped table-hover" id="example-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Permiso</th>
                                                    <th>Descripción</th>
                                                    <th>Módulo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td>{{$permission->name}}</td>
                                                        <td>{{$permission->description}}</td>
                                                    
                                                        <td>
                                                            <span class="badge badge-success">{{$permission->modulo}}</span>
                                                        </td>
                                                       
                                                    </tr>
                                                 @endforeach
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab-2">
                                        {!! Form::model($user, ['url' => ['update-profile', $user->id], 'method' => 'PUT','files' => true]) !!}
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <div class="form-group">
                                                        {!! Form::label('name', 'Nombres y Apellido') !!}
                                                        {!! Form::text('name',null, ['class'=>'form-control']) !!}
                                                        @error('name')
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            {{ $message }}.
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    {!! Form::label('username', 'Nombre de usuario') !!}
                                                    {!! Form::text('username',null, ['class'=>'form-control']) !!}
                                                    @error('username')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}.
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class=" col-sm-6 form-group">
                                                {!! Form::label('email', 'Correo electrónico') !!}
                                                {!! Form::text('email',null, ['class'=>'form-control']) !!}
                                                @error('email')
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $message }}.
                                                </div>
                                                @enderror
                                                </div>
                                                <div class=" col-sm-6 form-group">
                                                    {!! Form::label('phone', 'Télefono') !!}
                                                    {!! Form::text('phone',null, ['class'=>'form-control']) !!}
                                                    @error('phone')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}.
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 form-group">
                                                    {!! Form::label('url_image', 'Fotografía (jpeg, png, jpg)') !!}
                                                    {!! Form::file('url_image', ['class'=>'form-control']) !!}
                                                    @error('url_image')
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ $message }}.
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="tab-pane fade" id="tab-3">
                                       {!! Form::model($user, ['url' => ['update-password', $user->id], 'method' => 'PUT','id'=>'formenvio_1']) !!}
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <div class="form-group">
                                                        {!! Form::label('password', 'Contraseña') !!}
                                                        {!! Form::password('password', ['class'=>'form-control pr-password','id'=>'id_password','data-indicator'=>'pwindicator']) !!}
                                                        @error('password')
                                                        <div id="pwindicator">
                                                            <div class="bar"></div>
                                                            <div class="label"></div>
                                                        </div>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            {{ $message }}.
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    {!! Form::label('confirm_password', 'Confirmar contraseña') !!}
                                                    {!! Form::password('confirm_password', ['class'=>'form-control','id'=>'id_password2']) !!}
                                                   
                                                    <div id="div_pass" hidden class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        La contraseñas no coinciden
                                                    </div>
                                                  
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                {!! Form::button('Cambiar', ['class'=>'btn btn-success  btn_save']) !!}
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               
            </div>
            
       
@endsection

    
    @include('admin.users.script')


   