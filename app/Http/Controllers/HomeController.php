<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DeliveryMan;
use App\DetailOrder;
use App\Merchant;
use App\Order;
use App\RequestForm;
use App\RequestFormDeliveryMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'ASC')->get(['id']);
        $orders = Order::orderBy('id', 'ASC')->get(['id']);
        $deliverymen = DeliveryMan::where('status', 'aprobado')->get(['id']);
        $merchants = Merchant::where('status', 'aprobado')->get(['id']);
        $merchants_lasted = Merchant::latest()
            ->take(5)
            ->get();
        $deliverymen_lasted = DeliveryMan::latest()
            ->take(5)
            ->get();
        $request_deliverymen = RequestFormDeliveryMan::where('status', 'revision')->orderBy('created_at', 'ASC')
            ->latest()
            ->take(5)
            ->get();
        $request_merchants = RequestForm::where('status', 'revision')->orderBy('created_at', 'ASC')
            ->latest()
            ->take(5)
            ->get();


        $orders_customers = DB::table('orders')
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
            ->paginate(10);

        return view('admin.dashboard.index',
            compact('customers',
                'merchants',
                'orders',
                'deliverymen',
                'merchants_lasted',
                'deliverymen_lasted',
                'request_deliverymen',
                'request_merchants',
                'orders_customers'
            ));
    }

     public function downloadapk()
    {
       $url_apk= "apk/tiendavirtualutc.apk";
       $name_pdf = "tiendavirtualutc";
        return response()->download($url_apk, $name_pdf . ".apk");
        
       
    }
}
