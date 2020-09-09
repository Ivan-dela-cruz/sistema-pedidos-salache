<div class="row">


    <div class="col-lg-6">
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

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('username', 'Nombre de usuario') !!}
            {!! Form::text('username',null, ['class'=>'form-control']) !!}
            @error('username')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('id_rol', 'Rol para usuario') !!}
            {!! Form::select('id_rol', $roles,null, ['class'=>'form-control']) !!}
            @error('id_rol')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('email', 'Correo electrónico') !!}
            {!! Form::text('email',null, ['class'=>'form-control']) !!}
            @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
   
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('url_image', 'Fotografía (jpeg, png, jpg)') !!}
            {!! Form::file('url_image', ['class'=>'form-control']) !!}
            @error('url_image')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('status', 'Estado') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status', 'activo') }} Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('status', 'inactivo') }} Inactivo
                    </label>
                </div>
            </div>

            @error('status')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}.
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
        </div>
    </div>
</div>


