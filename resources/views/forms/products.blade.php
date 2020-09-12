@extends('forms.base')
@section('title')
Solicitud de producto
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<form class="form-inline md-form mr-auto mb-4">
			<input class="form-control mr-sm-2" type="text" placeholder="Ingrese Cédula" aria-label="Search">
			<button class="btn btn-elegant btn-rounded btn-md my-0" type="submit">Buscar</button>
		</form>
		
	</div>

	<div class="col-lg-12">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-white pb-2">
                            <div class="text-muted text-center mb-2">
                                <h5 class="card-header text-center font-weight-bold py-4">Formulario Solicitud  Productos</h5>
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
                                    <h6>Datos del producto</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-watch-time"></i></span>
                                            </div>
                                            {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Nombre','id'=>'name']) !!}


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
                                                <span class="input-group-text"><i class="ni ni-app"></i></span>
                                            </div>

                                            {!! Form::text('description', null, ['class'=>'form-control','placeholder'=>'Descripción','id'=>'description']) !!}
                                        </div>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                            </div>
                                            {!! Form::text('price', null, ['class'=>'form-control','placeholder'=>'Precio','id'=>'price']) !!}
                                        </div>
                                    </div>
                                    @error('price')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-ungroup"></i></span>
                                            </div>
                                            {!! Form::text('category', null, ['class'=>'form-control','placeholder'=>'Categoría','id'=>'category']) !!}
                                        </div>
                                    </div>
                                    @error('category')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div> 

                                <div class="col-md-12">
                                    <div class="custom-file pb-3">

                                        {!! Form::file('url_file', ['class'=>'custom-file-input pb-3','id'=>'customFile']) !!}
                                        <label class="custom-file-label" for="customFile">Imagen: formatos permitidos, png,jpeg, jpeg</label>
                                        @error('url_file')
                                        <div class="alert alert-danger alert-dismissible fade show pb-3" role="alert">
                                            {{ $message }}.
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="" class="text-muted col-lg-12">

                                        <small> <span class="text-info font-weight-700">Importante! </span> La imagen debe tener una alta resolución.</small>

                                    </label>
                                    <div class="text-center">
                                    	<img hidden id="image_product" height="150" src="">
                                    </div>

                                </div>
                               

                            </div>
                            

                            <div class="text-center">
                                <button type="button" class="btn btn-primary mt-4 btn-save">Añadir a la lista</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                	<div class="card">
					  <h5 class="card-header text-center font-weight-bold py-4">Lista de productos</h5>
					  <div class="card-body">
					    <div id="table" class="table-editable">
					      <table class="table table-bordered table-responsive-md table-striped text-center" id="table_request">
					        <thead>
					          <tr>
					            <th class="text-center">Producto</th>
					            <th class="text-center">Descripción</th>
					            <th class="text-center">Precio</th>
					            <th class="text-center">Categoría</th>
					            <th class="text-center">Imagen</th>
					            <th class="text-center">Acción</th>
					            
					          </tr>
					        </thead>
					        <tbody>
					          
					        </tbody>
					      </table>
					      <label for="" class="text-muted">

                                        <small> <span class="text-info font-weight-700">Importante! </span> Los productos serán revisados por el administrador para su aprobación.</small>

                                    </label>
					    </div>
					     <div class="text-center">
                                <button type="button" class="btn btn-success mt-4 btn-save">Enviar solicitud</button>
                            </div>
					  </div>
					</div>
                	
                </div>
</div>


@endsection
@include('forms.script')
