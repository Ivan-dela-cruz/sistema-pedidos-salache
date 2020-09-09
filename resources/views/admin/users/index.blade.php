@extends('admin.base.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head bg-info">
                    <div class="ibox-title text-white">Lista Pedido</div>
                    <div class="ibox-tools">
                        @can('crear usuario')
                            <a class="text-white hover" href="{{route('create-user')}}">
                                <i class="fa fa-plus-square"></i>
                                Añadir</a>
                        @endcan

                    </div>
                </div>
                <div class="ibox-body">
                    <div class="d-flex justify-content-between py-3">

                        <h5 class="d-none d-lg-block inbox-title">
                            <a href="{{route('get-pdf-users')}}" class="btn btn-primary">
                                <i class="fa fa-print"></i>
                                Imprimir</a>
                            <i class="fa fa-user m-r-5"></i>
                            Usuarios({{count($users)}}) </h5>
                           
                        {!! Form::open(['route' => 'get-user', 'method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'mail-search']) !!}
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                            </div>
                            <input id="filter" name="filter" class="form-control" type="text" placeholder="Buscar...">
                            {{Form::select('parameter',array(
                                   'username' => 'Usuario',
                                   'email' => 'Email',
                                   ),$parameter,['id'=>'parameter','class'=>'form-control'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @if (count($users)>0)
                        <div class="table-users table-responsive">
                            @include('admin.users.tableUsers')

                        </div>
                        {{$users->render()}}
                    @else
                        <h4 class="text-center"><i class="fa fa-search font-20 text-info"></i> No hay datos para mostrar
                        </h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.users.script')
