<table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
    <thead>
        <tr>

            <th>CI</th>
            <th>RUC</th>
            <th>Nombres y Apellidos</th>
            <th>Email</th>
            <th>Télefono</th>
            <th>Empresa</th>
            <th>Aprobado</th>
            <th>Estado</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($merchants as $merchant)
        <tr>
            <td>{{$merchant->ci}}</td>
            <td>{{$merchant->ruc}}</td>
            <td>{{$merchant->last_name}} {{$merchant->name}}</td>
            <td>{{$merchant->email}}</td>
            <td>{{$merchant->phone}}</td>
            <td>
                 @foreach ($merchant->companies as $company)
                   {{$company->company_name}}
                 @endforeach
            </td>
            <td>{{\Carbon\Carbon::parse($merchant->updated_at)->diffForhumans()}}</td>

            <td>
                @if ($merchant->status =='aprobado')
                    <i class="fa fa-check text-success"></i>
                @else
                    <i class="fa fa-close text-warning"></i>
                @endif
            <td>

                @can('modificar solicitud')
                    <a href="{{route('create-merchant-profile',$merchant->id)}}" class="btn btn-default btn-xs"
                            title="Modificar empresas"
                            data-toggle="tooltip">
                                <i class="fa fa-edit font-14 text-primary"></i>
                    </a>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

