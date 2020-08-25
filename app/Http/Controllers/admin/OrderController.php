<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\Customer;
use App\DeliveryMan;
use App\DetailOrder;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Order;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all()->paginate(10);
    }

    public function orders()
    {
        $user = User::find(Auth::user()->id);
        $customer = Customer::where("id_user", $user->id)->first();
        $orders = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('companies', 'orders.id_company', '=', 'companies.id')
            ->join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.id_user',
                'orders.id_company',
                'orders.id_customer',
                'orders.id',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',
                'orders.created_at',
                'orders.total',
                'orders.status',
                'orders.longitude as longitude_order',
                'orders.latitude as latitude_order',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',
                'customers.ci', 'customers.address as address_cus', 'customers.phone as phone_cus', 'customers.email as email_cus',
                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com')
            ->where('orders.id_customer', $customer->id)
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function ordersDelivery()
    {
        $user = User::find(Auth::user()->id);
        $delivery = DeliveryMan::where('id_user', $user->id)->first();
        $orders = DB::table('order_delivery_requests')
            ->join('delivery_men', 'order_delivery_requests.id_delivery', '=', 'delivery_men.id')
            ->join('companies', 'orders.id_company', '=', 'companies.id')
            ->join('orders', 'order_delivery_requests.id_order', '=', 'orders.id')
            ->select(
                'orders.id_user',
                'orders.id_company',
                'orders.id_customer',
                'orders.id',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',
                'orders.created_at',
                'orders.total',
                'orders.status',
                'orders.longitude as longitude_order',
                'orders.latitude as latitude_order',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',
                'customers.ci', 'customers.address as address_cus', 'customers.phone as phone_cus', 'customers.email as email_cus',
                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com')
            ->where('orders.id_company', $delivery->id)
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function ordersMerchant($id)
    {
        $company = Company::find($id);
        $orders = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('companies', 'orders.id_company', '=', 'companies.id')
            ->join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.id_user',
                'orders.id_company',
                'orders.id_customer',
                'orders.id',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',
                'orders.created_at',
                'orders.updated_at',
                'orders.total',
                'orders.status',
                'orders.longitude as longitude_order',
                'orders.latitude as latitude_order',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',
                'customers.ci', 'customers.address as address_cus', 'customers.phone as phone_cus', 'customers.email as email_cus',
                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com')
            ->where('orders.id_company', $company->id)
            ->orderBy('orders.updated_at','DESC')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }

    public function getDetailOrder($id)
    {
        $details = DetailOrder::where('id_order', $id)->get();
        return response()->json([
            'success' => true,
            'details' => $details
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
    public function store(Request $request)
    {
        try {

            $user = User::find(Auth::user()->id);
            $customer = Customer::where('id_user', $user->id)->first();
            $company = Company::find($request->id_company);

            $date = Carbon::now()->toDateString();
            DB::beginTransaction();
            $order = new Order();
            $order->id_user = $user->id;
            $order->id_company = $company->id;
            $order->id_customer = $customer->id;
            $order->name_company = $company->company_name;
            $order->name_customer = $customer->name . " " . $customer->last_name;
            $order->order_number = "" . time();
            $order->latitude = $request->latitude;
            $order->longitude = $request->longitude;
            $order->date = $date;
            $order->total = $request->total_order;
            $order->save();

            $details = $request->detail_order;
            $data = json_decode($details, true);
            foreach ($data as $ep => $det) {
                $detail = new DetailOrder();
                $detail->id_order = $order->id;
                $detail->id_product = $det['id_product'];
                $detail->product_name = $det['name'];
                $detail->product_desc = $det['description'];
                $detail->quanty = $det['quanty'];
                $detail->price_total = $det['total_price'];
                $detail->price_unit = $det['price_unit'];
                $detail->save();

            }
            $order->url_order = "orders/orden-" . $order->id . '.pdf';
            $order->save();
            $this->savePdfStorage($order->id);
            DB::commit();

            return response()->json([
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e
            ], 422);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function savePdfStorage($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('companies', 'orders.id_company', '=', 'companies.id')
            ->join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.id_user',
                'orders.id_company',
                'orders.id_customer',
                'orders.id',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',
                'orders.created_at',
                'orders.total',
                'orders.status',
                'orders.name_company',
                'orders.name_customer',
                'customers.ci', 'customers.address as address_cus', 'customers.phone as phone_cus', 'customers.email as email_cus',
                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com')
            ->where('orders.id', $id)
            ->first();
        $details = DetailOrder::where('id_order', $id)->get();
        $pdf = PDF::loadView('pdf.pdf', compact('order', 'details'));
        $nombrePdf = 'orden-' . $order->id . '.pdf';
        $path = public_path('orders/');
        $pdf->save($path . '/' . $nombrePdf);
        //return $pdf->download($nombrePdf);
    }

    public function generatePDFOrder($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.id_customer', '=', 'customers.id')
            ->join('companies', 'orders.id_company', '=', 'companies.id')
            ->join('users', 'orders.id_user', '=', 'users.id')
            ->select(
                'orders.id_user',
                'orders.id_company',
                'orders.id_customer',
                'orders.id',
                'orders.order_number',
                'orders.latitude',
                'orders.longitude',
                'orders.date',
                'orders.created_at',
                'orders.total',
                'orders.status',
                'orders.name_company',
                'orders.name_customer',
                'orders.url_order',
                'customers.ci', 'customers.address as address_cus', 'customers.phone as phone_cus', 'customers.email as email_cus',
                'companies.company_address', 'companies.company_ruc', 'companies.company_phone',
                'companies.longitude as longitude_com', 'companies.latitude as latitude_com')
            ->where('orders.id', $id)
            ->first();
        $details = DetailOrder::where('id_order', $id)->get();
        //return view('pdf.pdf', compact('order', 'details'));
        $pdf = PDF::loadView('pdf.pdf', compact('order', 'details'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'orden-' . $order->id . '.pdf';
        return $pdf->download($nombrePdf);

    }

    public function downloadPdfOrder($id)
    {
        // $order =
    }

    public function DeativateOrder($id)
    {
        $order = Order::find($id);
        $order->status = "anulado";
        $order->save();

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }
}
