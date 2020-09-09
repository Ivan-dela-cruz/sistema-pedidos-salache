<table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>CI</th>
            <th>Dirección</th>
            <th>Télefono</th>
            <th>Email</th>
            <th>Género</th>
            <th>Edad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{$customer->name}} {{$customer->last_name}}</td>
            <td>{{$customer->ci}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->gender}}</td>
            <td>{{\Carbon\Carbon::parse($customer->birth_date)->age}}</td>


        </tr>
        @endforeach
    </tbody>
</table>

