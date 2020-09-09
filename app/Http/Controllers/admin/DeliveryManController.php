<?php

namespace App\Http\Controllers\admin;

use App\CompanyType;
use App\Convenio;
use App\DeliveryMan;
use App\Order;
use App\OrderDeliveryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryManValidatePost;
use App\Http\Requests\UpdateDeliveryManPut;
use App\RequestFormDeliveryMan;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\User;
use App\VehicleType;
use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Barryvdh\DomPDF\Facade as PDF;

class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverymen = DeliveryMan::orderBy('created_at', 'ASC')->get();

        $vehicles = VehicleType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('admin.deliveryman.index', compact('deliverymen', 'vehicles'));
    }

    public function getDeliveryman()
    {
        $deliveryman = DeliveryMan::join('vehicle_types', 'vehicle_types.id', '=', 'delivery_men.vehicle_type')
            ->select(
                'delivery_men.id',
                'delivery_men.name', 'delivery_men.last_name', 'delivery_men.phone', 'delivery_men.vehicle_plate',
                'delivery_men.vehicle_description', 'delivery_men.vehicle_make', 'delivery_men.url_vehicle',
                'delivery_men.status', 'delivery_men.status_order', 'delivery_men.longitude', 'delivery_men.latitude',
                'vehicle_types.name as type_vehicle'
            )
            ->where('delivery_men.status_order', 'disponible')
            ->where('delivery_men.status', 'aprobado')
            ->get();
        return response()->json([
            'success' => true,
            'deliveryman' => $deliveryman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryManValidatePost $request, $id)
    {

        $request_deliveryman = RequestFormDeliveryMan::find($id);
        if ($request->status == "revision") {

            $request_deliveryman->status = $request->status;
            $request_deliveryman->save();
            return redirect()->route('get-request-deliverymen');

        } else if ($request->status == "aprobado") {
            $validate = $request->validated();
            try {

                DB::beginTransaction();
                //CREAMOS UN NUEVO USUARIO
                $user = new User();

                $user->name = $request->name;
                $user->username = $request->name . time();
                $user->email = $request->email;
                $user->url_image = $this->UploadImage($request);
                $user->password = $this->generatePassword($request->ci);
                $user->save();
                $role = Role::findById(4);
                $user->assignRole($role);

                ///GURADAMOS LA TABLA DELIVERMAN
                $deliveryman = new DeliveryMan();
                $deliveryman->ci = $request->ci;
                $deliveryman->ruc = $request->company_ruc;
                $deliveryman->name = $request->name;
                $deliveryman->last_name = $request->last_name;
                $deliveryman->email = $request->email;
                $deliveryman->phone = $request->phone;
                $deliveryman->gender = $request->gender;
                $deliveryman->birth_date = $request->birth_date;


                $deliveryman->vehicle_type = $request->vehicle_type;
                $deliveryman->vehicle_plate = $request->vehicle_plate;
                $deliveryman->vehicle_year = $request->vehicle_year;
                $deliveryman->vehicle_make = $request->vehicle_make;
                $deliveryman->vehicle_description = $request->vehicle_description;
                $deliveryman->url_vehicle = $this->UploadImageDeliveryMan($request);;
                $deliveryman->id_user = $user->id;
                $deliveryman->id_convenio = $request->id_convenio;
                $deliveryman->url_file = $request_deliveryman->url_file;
                $deliveryman->save();

                //cambiamos el estado de la peticion
                $request_deliveryman = RequestFormDeliveryMan::find($id);
                $request_deliveryman->status = $request->status;
                $request_deliveryman->save();


                DB::commit();

                return redirect()->route('get-deliverymen');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('get-request-deliverymen');
            }
        } else {
            $this->deleteRequestDelivery($id);
            return redirect()->route('get-request-deliverymen');
        }
    }

    public function deleteRequestDelivery($id)
    {
        $request_deliveryman = RequestFormDeliveryMan::find($id);
        $this->destroyFile($request_deliveryman->url_file);
        $request_deliveryman->delete();

    }

    public function destroyFile($path_file)
    {
        if (File::exists(public_path($path_file))) {

            File::delete(public_path($path_file));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $deliveryman = DeliveryMan::find($id);
        $request = RequestFormDeliveryMan::find($id);
        $vehicles = VehicleType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $convenios = Convenio::orderBy('name', 'ASC')
            ->pluck('name', 'id');
        return view('admin.deliveryman.edit', compact('request', 'vehicles', 'convenios', 'deliveryman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryManPut $request, $id)
    {

        $validate = $request->validated();
        $deliveryman = DeliveryMan::find($id);

        try {

            DB::beginTransaction();
            //CREAMOS UN NUEVO USUARIO
            $user = User::find($deliveryman->user->id);

            $user->name = $request->name;
            $user->username = $request->name . time();
            $user->email = $request->email;
            if ($request->file('url_image')) {
                $this->destroyFile($user->url_file);
                $user->url_image = $this->UploadImage($request);
            }
            $user->password = $this->generatePassword($request->ci);
            $user->save();
            $role = Role::findById(3);
            $user->assignRole($role);

            ///GURADAMOS LA TABLA DELIVERMAN

            $deliveryman->ci = $request->ci;
            $deliveryman->ruc = $request->company_ruc;
            $deliveryman->name = $request->name;
            $deliveryman->last_name = $request->last_name;
            $deliveryman->email = $request->email;
            $deliveryman->phone = $request->phone;
            $deliveryman->gender = $request->gender;
            $deliveryman->birth_date = $request->birth_date;


            $deliveryman->vehicle_type = $request->vehicle_type;
            $deliveryman->vehicle_plate = $request->vehicle_plate;
            $deliveryman->vehicle_year = $request->vehicle_year;
            $deliveryman->vehicle_make = $request->vehicle_make;
            $deliveryman->vehicle_description = $request->vehicle_description;
            if ($request->file('url_vehicle')) {
                $this->destroyFile($deliveryman->url_vehicle);
                $deliveryman->url_vehicle = $this->UploadImageDeliveryMan($request);
            }
            $deliveryman->id_user = $user->id;
            $deliveryman->id_convenio = $request->id_convenio;
            $deliveryman->status = $request->status;
            $deliveryman->save();

            DB::commit();

            return redirect()->route('get-deliverymen');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('get-deliverymen');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRequestDeliveryMen()
    {
        $request_deliverymen = RequestFormDeliveryMan::orderBy('created_at', 'ASC')->get();


        return view('admin.deliveryman.list_request', compact('request_deliverymen'));
    }

    public function showRequest($id)
    {
        $request = RequestFormDeliveryMan::find($id);
        $vehicles = VehicleType::where('status', 'activo')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        $convenios = Convenio::orderBy('name', 'ASC')
            ->pluck('name', 'id');
        return view('admin.deliveryman.showRequest', compact('request', 'vehicles', 'convenios'));
    }

    public function generatePassword($password)
    {
        $user_password = Hash::make($password);
        return $user_password;
    }

    public function UploadImage(Request $request)
    {
        $url_file = "img/users/";
        if ($request->file('url_image')) {
            $image = $request->file('url_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }
    }

    public function UploadImageDeliveryMan(Request $request)
    {
        $url_file = "img/deliverymen/";
        if ($request->file('url_vehicle')) {
            $image = $request->file('url_vehicle');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path($url_file) . $name);
            return $url_file . $name;
        } else {
            return "#";
        }
    }


    public function sendRequestDeliveryCompany(Request $request)
    {
        $date = Carbon::now();
        $request_delivery = new OrderDeliveryRequest();
        $request_delivery->id_order = $request->id_order;
        $request_delivery->id_company = $request->id_company;
        $request_delivery->id_delivery = $request->id_delivery;
        $request_delivery->datetime = $date;
        $request_delivery->status = $request->status;
        $request_delivery->url_request = "#";
        $request_delivery->total = 0;
        $request_delivery->save();
        $order = Order::find($request->id_order);
        $order->status = "no entregado";
        $order->save();
        return response()->json([
            'success' => true,
            'request' => $request_delivery
        ]);

    }

    public function getRequestCompanyDelivery(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $delivery = DeliveryMan::where('id_user', $user->id)->first();
        $orders = DB::table('order_delivery_requests')
            ->join('delivery_men', 'order_delivery_requests.id_delivery', '=', 'delivery_men.id')
            ->join('companies', 'order_delivery_requests.id_company', '=', 'companies.id')
            ->join('orders', 'order_delivery_requests.id_order', '=', 'orders.id')
            ->select(
                'order_delivery_requests.id_order',
                'order_delivery_requests.id_company',
                'order_delivery_requests.id_delivery',

                'order_delivery_requests.id',
                'order_delivery_requests.datetime',
                'order_delivery_requests.status as status_request',

                'orders.id_customer',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',

                'orders.total',
                'orders.status',
                'orders.longitude as longitude_order',
                'orders.latitude as latitude_order',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',

                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com'
            )
            ->where('order_delivery_requests.id_delivery', $delivery->id)
            ->where('order_delivery_requests.status', 'enviado')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function getRequestCompanyDeliveryCustomer(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $delivery = DeliveryMan::where('id_user', $user->id)->first();
        $orders = DB::table('order_delivery_requests')
            ->join('delivery_men', 'order_delivery_requests.id_delivery', '=', 'delivery_men.id')
            ->join('companies', 'order_delivery_requests.id_company', '=', 'companies.id')
            ->join('orders', 'order_delivery_requests.id_order', '=', 'orders.id')
            ->select(
                'order_delivery_requests.id_order',
                'order_delivery_requests.id_company',
                'order_delivery_requests.id_delivery',

                'order_delivery_requests.id',
                'order_delivery_requests.datetime',
                'order_delivery_requests.status as status_request',

                'orders.id_customer',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',

                'orders.total',
                'orders.status',
                'orders.longitude as longitude_order',
                'orders.latitude as latitude_order',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',

                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com'
            )
            ->where('order_delivery_requests.id_delivery', $delivery->id)
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }


    public function confirmOrder($id)
    {
        $order_re = OrderDeliveryRequest::find($id);
        $order_re->status = "aceptado";
        $order_re->save();

        $order = Order::find($order_re->id_order);
        $order->status = "confirmado";
        $order->save();

        return response()->json([
            'success' => true,
            'order' => $order
        ]);

    }

    public function declineOrder($id)
    {
        $order_re = OrderDeliveryRequest::find($id);
        $order_re->status = "rechazado";
        $order_re->save();

        $order = Order::find($order_re->id_order);
        $order->status = "pendiente";
        $order->save();
        return response()->json([
            'success' => true,
            'order' => $order
        ]);

    }

    public function completeOrder($id)
    {
        $order_re = OrderDeliveryRequest::find($id);
        $order_re->status = "entregado";
        $order_re->save();

        $order = Order::find($order_re->id_order);
        $order->status = "entregado";
        $order->save();
        return response()->json([
            'success' => true,
            'order' => $order
        ]);

    }

    public function updatePosition(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $delivery = DeliveryMan::where('id_user', $user->id)->first();
        $delivery->latitude = $request->latitude;
        $delivery->longitude = $request->longitude;
        $delivery->save();
        return response()->json([
            'success' => true,
            'delivery' => $delivery
        ]);

    }

     public function getPdfDeliveryMan(){
        $deliveryman = DeliveryMan::orderBy('created_at', 'DESC')->get();
       
        $pdf = PDF::loadView('pdf.deliveryman', compact('deliveryman'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte repartidores-' .time() . '.pdf';
        return $pdf->download($nombrePdf);
    }


}
